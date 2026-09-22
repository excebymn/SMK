// ============================================================
// MAIN — game loop & state management
// ------------------------------------------------------------
// File ini yang "menyatukan" semua bagian: level, player, musuh,
// powerup, kamera, dan HUD. Sengaja ditaruh paling akhir di antara
// <script> tags soalnya dia butuh semua class/fungsi dari file lain.
// ============================================================

const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

// --- state global game ---
const game = {
  state: "playing", // "playing" | "levelcomplete" | "gameover" | "victory"
  levelIndex: 0,
  level: null,
  player: null,
  enemies: [],
  powerups: [],
  score: 0,
  coinsCollected: 0,
  lives: STARTING_LIVES,
  timeLeft: LEVEL_TIME_LIMIT,
  highScore: loadHighscore(),
};

const keys = { left: false, right: false, jump: false };

window.addEventListener("keydown", (e) => {
  if (e.key === "ArrowLeft" || e.key === "a" || e.key === "A") keys.left = true;
  if (e.key === "ArrowRight" || e.key === "d" || e.key === "D") keys.right = true;
  if (e.key === " " || e.key === "ArrowUp") keys.jump = true;

  if (e.key === "Enter" && game.state === "levelcomplete") {
    advanceToNextLevel();
  }
  if ((e.key === "r" || e.key === "R") && (game.state === "gameover" || game.state === "victory")) {
    startNewGame();
  }
});

window.addEventListener("keyup", (e) => {
  if (e.key === "ArrowLeft" || e.key === "a" || e.key === "A") keys.left = false;
  if (e.key === "ArrowRight" || e.key === "d" || e.key === "D") keys.right = false;
  if (e.key === " " || e.key === "ArrowUp") keys.jump = false;
});

// ------------------------------------------------------------
// SETUP LEVEL
// ------------------------------------------------------------
function loadLevel(index) {
  const data = cloneLevelData(index);

  game.level = data;
  game.player = new Player(data.playerStart.col * TILE, data.playerStart.row * TILE);
  game.enemies = data.enemySpawns.map((e) => new Enemy(e.type, e.col * TILE, e.row * TILE));
  game.powerups = [];
  game.timeLeft = LEVEL_TIME_LIMIT;
  game.state = "playing";
  resetCamera();
}

function startNewGame() {
  game.score = 0;
  game.coinsCollected = 0;
  game.lives = STARTING_LIVES;
  game.levelIndex = 0;
  loadLevel(0);
}

function advanceToNextLevel() {
  if (game.levelIndex + 1 < LEVEL_BUILDERS.length) {
    game.levelIndex++;
    loadLevel(game.levelIndex);
  } else {
    game.state = "victory";
    if (game.score > game.highScore) {
      game.highScore = game.score;
      saveHighscore(game.highScore);
    }
  }
}

// player kehabisan nyawa/waktu/jatuh ke jurang
function handlePlayerDeath() {
  game.lives -= 1;
  if (game.lives <= 0) {
    game.state = "gameover";
    if (game.score > game.highScore) {
      game.highScore = game.score;
      saveHighscore(game.highScore);
    }
  } else {
    // level di-reset total (bukan cuma posisi player) — lebih simpel
    // dan cukup fair, resiko utamanya cuma harus ngumpulin ulang coin
    // yang udah keambil, tapi skor yang udah didapat tetep aman
    loadLevel(game.levelIndex);
  }
}

// dipanggil dari resolveVerticalCollision pas player kepalanya
// nabrak question block dari bawah
function handleBlockHit(col, row) {
  const level = game.level;
  if (level.grid[row][col] !== "Q") return; // udah pernah kepake / bukan question block

  level.grid[row][col] = "U"; // sekarang jadi blok kosong, gak bisa dipukul lagi
  const key = `${col},${row}`;
  const content = level.blockContents[key];

  if (content === "powerup") {
    game.powerups.push(new Powerup(col * TILE, row * TILE - TILE));
  } else {
    // koin yang "muncul" dari blok, langsung nambah skor tanpa perlu diambil lagi
    game.score += 50;
  }
}

// ------------------------------------------------------------
// UPDATE
// ------------------------------------------------------------
let lastTimestamp = 0;

function update(dt, elapsedMs) {
  if (game.state !== "playing") return;

  const level = game.level;
  const player = game.player;

  // hitung waktu tersisa berdasarkan waktu ASLI (ms), bukan dt yang
  // udah dinormalisasi — dt itu buat physics, ini buat jam sungguhan
  game.timeLeft -= elapsedMs / 1000;
  if (game.timeLeft <= 0) {
    game.timeLeft = 0;
    handlePlayerDeath();
    return;
  }

  player.update(dt, keys, level, handleBlockHit);

  // jatuh ke jurang = mati
  if (player.y > level.rows * TILE + 100) {
    handlePlayerDeath();
    return;
  }

  // --- update musuh, buang yang udah kelar animasi squash-nya ---
  game.enemies.forEach((e) => e.update(dt, level));
  game.enemies = game.enemies.filter((e) => e.alive || e.squashTimer > 0);

  // --- update powerup ---
  game.powerups.forEach((p) => p.update(dt, level));

  // --- player vs coin ---
  level.coins.forEach((coin) => {
    if (coin.collected) return;
    if (aabbOverlap(player, tileRect(coin.col, coin.row), 8)) {
      coin.collected = true;
      game.score += 10;
      game.coinsCollected += 1;
      if (game.coinsCollected % COINS_PER_EXTRA_LIFE === 0) {
        game.lives += 1;
      }
    }
  });

  // --- player vs powerup ---
  game.powerups.forEach((p) => {
    if (p.collected) return;
    if (aabbOverlap(player, p, 4)) {
      p.collected = true;
      player.grow();
      game.score += 200;
    }
  });

  // --- player vs enemy ---
  game.enemies.forEach((enemy) => {
    if (!enemy.alive) return;
    if (!aabbOverlap(player, enemy, 4)) return;

    const playerFeet = player.y + player.height;
    const stomping = player.vy > 0 && playerFeet - enemy.y < 14;

    if (stomping) {
      enemy.squash();
      player.vy = -6; // pantulan kecil, kayak nginjek trampolin mini
      game.score += 100;
    } else if (player.invulnTimer <= 0) {
      player.shrink();
      if (player.dead) {
        handlePlayerDeath();
        return;
      }
      // dorong player sedikit menjauh dari musuh biar gak langsung kena lagi
      player.vx = player.x < enemy.x ? -3 : 3;
    }
  });

  // --- player vs goal ---
  const goalPx = level.goal.col * TILE;
  if (player.x + player.width >= goalPx) {
    const bonus = Math.floor(game.timeLeft) * 5;
    game.score += bonus;
    game.state = "levelcomplete";
  }

  updateCamera(player, level.cols * TILE, CANVAS_WIDTH);
}

function aabbOverlap(a, b, shrink) {
  const s = shrink || 0;
  return (
    a.x + s < b.x + b.width - s &&
    a.x + a.width - s > b.x + s &&
    a.y + s < b.y + b.height - s &&
    a.y + a.height - s > b.y + s
  );
}

function tileRect(col, row) {
  return { x: col * TILE, y: row * TILE, width: TILE, height: TILE };
}

// ------------------------------------------------------------
// DRAW
// ------------------------------------------------------------
function drawBackground(cameraX) {
  // langit gradasi simpel
  const sky = ctx.createLinearGradient(0, 0, 0, CANVAS_HEIGHT);
  sky.addColorStop(0, "#4a7ec9");
  sky.addColorStop(1, "#8fc7e8");
  ctx.fillStyle = sky;
  ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

  // awan parallax — geser lebih pelan dari kamera biar kesan jauh
  ctx.fillStyle = "rgba(255,255,255,0.8)";
  for (let i = 0; i < 6; i++) {
    const baseX = i * 260 - (cameraX * 0.3) % 260;
    ctx.beginPath();
    ctx.ellipse(baseX, 50 + (i % 3) * 20, 28, 14, 0, 0, Math.PI * 2);
    ctx.ellipse(baseX + 24, 45 + (i % 3) * 20, 20, 12, 0, 0, Math.PI * 2);
    ctx.fill();
  }
}

function drawLevel(level, cameraX) {
  const colStart = Math.max(0, Math.floor(cameraX / TILE) - 1);
  const colEnd = Math.min(level.cols - 1, colStart + Math.ceil(CANVAS_WIDTH / TILE) + 2);

  for (let row = 0; row < level.rows; row++) {
    for (let col = colStart; col <= colEnd; col++) {
      const t = level.grid[row][col];
      if (t === ".") continue;

      const px = col * TILE - cameraX;
      const py = row * TILE;

      if (t === "#") {
        ctx.fillStyle = "#8a5a2b";
        ctx.fillRect(px, py, TILE, TILE);
        ctx.fillStyle = "#6e4520";
        ctx.fillRect(px, py, TILE, 4);
      } else if (t === "B") {
        ctx.fillStyle = "#b5651d";
        ctx.fillRect(px, py, TILE, TILE);
        ctx.strokeStyle = "#7a3d10";
        ctx.lineWidth = 2;
        ctx.strokeRect(px + 1, py + 1, TILE - 2, TILE - 2);
      } else if (t === "Q") {
        ctx.fillStyle = "#ffce4a";
        ctx.fillRect(px, py, TILE, TILE);
        ctx.strokeStyle = "#a8790b";
        ctx.lineWidth = 2;
        ctx.strokeRect(px + 1, py + 1, TILE - 2, TILE - 2);
        ctx.fillStyle = "#a8790b";
        ctx.font = "bold 18px Arial";
        ctx.textAlign = "center";
        ctx.fillText("?", px + TILE / 2, py + TILE / 2 + 6);
        ctx.textAlign = "left";
      } else if (t === "U") {
        ctx.fillStyle = "#9a8b7a";
        ctx.fillRect(px, py, TILE, TILE);
      }
    }
  }

  // koin yang belum diambil
  level.coins.forEach((coin) => {
    if (coin.collected) return;
    drawSprite(ctx, COIN_SPRITE, coin.col * TILE + 4, coin.row * TILE + 4, cameraX, false);
  });

  // tiang bendera di garis akhir
  const flagX = level.goal.col * TILE - cameraX;
  ctx.fillStyle = "#c0c0c0";
  ctx.fillRect(flagX + 14, 0, 4, level.rows * TILE);
  ctx.fillStyle = "#4caf50";
  ctx.beginPath();
  ctx.moveTo(flagX + 18, 20);
  ctx.lineTo(flagX + 46, 32);
  ctx.lineTo(flagX + 18, 44);
  ctx.closePath();
  ctx.fill();
}

function drawHUD() {
  ctx.fillStyle = "rgba(0,0,0,0.35)";
  ctx.fillRect(0, 0, CANVAS_WIDTH, 30);

  ctx.fillStyle = "#ffffff";
  ctx.font = "bold 14px Arial";
  ctx.textAlign = "left";
  ctx.fillText(`SCORE: ${game.score}`, 12, 20);
  ctx.fillText(`BEST: ${game.highScore}`, 160, 20);
  ctx.fillText(`LIVES: ${game.lives}`, 300, 20);
  ctx.fillText(`LEVEL: ${game.levelIndex + 1}/${LEVEL_BUILDERS.length}`, 420, 20);
  ctx.fillText(`TIME: ${Math.ceil(game.timeLeft)}`, 620, 20);
}

function drawOverlayBox(lines) {
  ctx.fillStyle = "rgba(0,0,0,0.65)";
  ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

  ctx.fillStyle = "#ffffff";
  ctx.textAlign = "center";
  lines.forEach((line, i) => {
    ctx.font = line.big ? "bold 28px Arial" : "16px Arial";
    ctx.fillText(line.text, CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 - 30 + i * 30);
  });
  ctx.textAlign = "left";
}

function draw() {
  const cameraX = camera.x;
  drawBackground(cameraX);

  if (game.level) {
    drawLevel(game.level, cameraX);
    game.powerups.forEach((p) => p.draw(ctx, cameraX));
    game.enemies.forEach((e) => e.draw(ctx, cameraX));
    game.player.draw(ctx, cameraX);
  }

  drawHUD();

  if (game.state === "levelcomplete") {
    drawOverlayBox([
      { text: `LEVEL ${game.levelIndex + 1} COMPLETE!`, big: true },
      { text: "Press ENTER to continue" },
    ]);
  } else if (game.state === "gameover") {
    drawOverlayBox([
      { text: "GAME OVER", big: true },
      { text: `Score: ${game.score}   Best: ${game.highScore}` },
      { text: "Press R to play again" },
    ]);
  } else if (game.state === "victory") {
    drawOverlayBox([
      { text: "YOU WIN!", big: true },
      { text: `Final Score: ${game.score}   Best: ${game.highScore}` },
      { text: "Press R to play again" },
    ]);
  }
}

// ------------------------------------------------------------
// LOOP
// ------------------------------------------------------------
function gameLoop(timestamp) {
  const elapsedMs = lastTimestamp ? timestamp - lastTimestamp : 16.67;
  lastTimestamp = timestamp;

  // dt dinormalisasi ke "kelipatan dari 60fps" biar physics gak jadi
  // lebih cepat/lambat cuma gara-gara refresh rate monitor beda-beda.
  // di-cap max 2 biar kalau sempet lag parah, player gak "teleport"
  // nembus tembok gara-gara loncat beberapa frame sekaligus.
  const dt = Math.min(elapsedMs / 16.67, 2);

  update(dt, elapsedMs);
  draw();

  requestAnimationFrame(gameLoop);
}

startNewGame();
requestAnimationFrame(gameLoop);
