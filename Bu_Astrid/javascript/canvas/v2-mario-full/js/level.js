// ============================================================
// LEVEL & TILE COLLISION
// ------------------------------------------------------------
// Level di sini bukan disimpen sebagai gambar ASCII yang diketik
// manual (rawan salah ketik/kegeser), tapi dibangun lewat kode:
// bikin grid kosong, terus "gambar" tanahnya, lubangnya, platform,
// coin, musuh, dst pakai koordinat kolom/baris. Lebih gampang
// dikontrol dan lebih gampang di-debug kalau ada yang aneh.
//
// Legenda tile di grid:
//   '.'  = kosong (langit / bisa dilewatin)
//   '#'  = tanah solid
//   'B'  = platform bata solid
//   'Q'  = question block (belum kepake, bisa dipukul dari bawah)
//   'U'  = question block yang udah kepake (solid tapi gak ngapa2in lagi)
// ============================================================

function isSolidTile(t) {
  return t === "#" || t === "B" || t === "Q" || t === "U";
}

function isSolidAt(level, col, row) {
  if (row < 0 || row >= level.rows || col < 0 || col >= level.cols) return false;
  return isSolidTile(level.grid[row][col]);
}

// --- helper buat "membangun" level ---
function makeEmptyGrid(cols, rows) {
  const grid = [];
  for (let r = 0; r < rows; r++) grid.push(new Array(cols).fill("."));
  return grid;
}

function fillGround(grid, fromCol, toCol, groundRowStart) {
  const rows = grid.length;
  for (let c = fromCol; c <= toCol; c++) {
    for (let r = groundRowStart; r < rows; r++) grid[r][c] = "#";
  }
}

// bikin jurang/lubang dengan cara "membolongi" tanah yang udah diisi
function carvePit(grid, fromCol, toCol) {
  const rows = grid.length;
  for (let c = fromCol; c <= toCol; c++) {
    for (let r = 0; r < rows; r++) grid[r][c] = ".";
  }
}

function placePlatform(grid, col, row, length, tile) {
  for (let i = 0; i < length; i++) grid[row][col + i] = tile || "B";
}

function scatterCoins(positions) {
  return positions.map(([col, row]) => ({ col, row, collected: false }));
}

// ------------------------------------------------------------
// LEVEL 1 — pemanasan: satu lubang gampang, dua musuh jalan,
// dan dua question block buat kenalan sama mekanismenya.
// ------------------------------------------------------------
function buildLevel1() {
  const cols = 50, rows = 10;
  const grid = makeEmptyGrid(cols, rows);
  fillGround(grid, 0, cols - 1, 8);
  carvePit(grid, 14, 16);
  carvePit(grid, 35, 36);

  placePlatform(grid, 20, 6, 4);
  placePlatform(grid, 28, 5, 3);

  grid[6][10] = "Q";
  grid[4][29] = "Q";

  return {
    grid, cols, rows,
    coins: scatterCoins([
      [8, 7], [9, 7],
      [21, 5], [22, 5],
      [45, 7], [46, 7],
    ]),
    enemySpawns: [
      { type: "walker", col: 25, row: 7 },
      { type: "walker", col: 41, row: 7 },
    ],
    blockContents: { "10,6": "coin", "29,4": "powerup" },
    goal: { col: 47, row: 7 },
    playerStart: { col: 1, row: 7 },
  };
}

// ------------------------------------------------------------
// LEVEL 2 — lebih panjang: tangga platform, satu hopper baru,
// dan lompatan yang perlu diperhitungkan.
// ------------------------------------------------------------
function buildLevel2() {
  const cols = 55, rows = 10;
  const grid = makeEmptyGrid(cols, rows);
  fillGround(grid, 0, cols - 1, 8);
  carvePit(grid, 10, 11);
  carvePit(grid, 24, 26);
  carvePit(grid, 40, 41);

  // tangga naik
  placePlatform(grid, 18, 7, 2);
  placePlatform(grid, 20, 6, 2);
  placePlatform(grid, 22, 5, 2);
  // platform panjang di atas lubang kedua
  placePlatform(grid, 30, 5, 6);

  grid[5][15] = "Q";
  grid[4][33] = "Q";

  return {
    grid, cols, rows,
    coins: scatterCoins([
      [18, 6], [20, 5], [22, 4],
      [31, 4], [32, 4], [33, 4], [34, 4],
      [48, 7], [49, 7],
    ]),
    enemySpawns: [
      { type: "walker", col: 14, row: 7 },
      { type: "hopper", col: 28, row: 7 },
      { type: "walker", col: 45, row: 7 },
    ],
    blockContents: { "15,5": "coin", "33,4": "powerup" },
    goal: { col: 52, row: 7 },
    playerStart: { col: 1, row: 7 },
  };
}

// ------------------------------------------------------------
// LEVEL 3 — paling ramai: banyak lubang, platform melayang
// bertingkat, dan campuran walker + hopper.
// ------------------------------------------------------------
function buildLevel3() {
  const cols = 65, rows = 10;
  const grid = makeEmptyGrid(cols, rows);
  fillGround(grid, 0, cols - 1, 8);
  carvePit(grid, 8, 9);
  carvePit(grid, 20, 22);
  carvePit(grid, 34, 36);
  carvePit(grid, 50, 52);

  placePlatform(grid, 12, 6, 3);
  placePlatform(grid, 16, 4, 3);
  placePlatform(grid, 24, 6, 4);
  placePlatform(grid, 28, 3, 2);
  placePlatform(grid, 38, 5, 6);
  placePlatform(grid, 42, 2, 2);
  placePlatform(grid, 55, 6, 4);

  grid[4][17] = "Q";
  grid[6][13] = "Q";
  grid[2][43] = "Q";

  return {
    grid, cols, rows,
    coins: scatterCoins([
      [12, 5], [13, 5], [14, 5],
      [24, 5], [25, 5],
      [38, 4], [39, 4], [40, 4], [41, 4],
      [55, 5], [56, 5], [57, 5],
    ]),
    enemySpawns: [
      { type: "walker", col: 10, row: 7 },
      { type: "hopper", col: 26, row: 7 },
      { type: "walker", col: 40, row: 4 },
      { type: "hopper", col: 56, row: 7 },
    ],
    blockContents: { "17,4": "powerup", "13,6": "coin", "43,2": "coin" },
    goal: { col: 62, row: 7 },
    playerStart: { col: 1, row: 7 },
  };
}

const LEVEL_BUILDERS = [buildLevel1, buildLevel2, buildLevel3];

// Setiap kali level di-load/reload, kita bikin salinan fresh-nya.
// Ini penting soalnya grid berubah pas main (question block kepake),
// jadi kalau player mati dan level di-reload, harus balik ke kondisi awal.
function cloneLevelData(index) {
  const data = LEVEL_BUILDERS[index]();
  return JSON.parse(JSON.stringify(data));
}

// ------------------------------------------------------------
// Collision generik terhadap tile. Dipakai bareng-bareng sama
// player, enemy, dan powerup — makanya taruh di sini, bukan
// diduplikat di masing-masing file.
// ------------------------------------------------------------
function resolveHorizontalCollision(entity, level) {
  const col1 = Math.floor(entity.x / TILE);
  const col2 = Math.floor((entity.x + entity.width - 1) / TILE);
  const row1 = Math.floor(entity.y / TILE);
  const row2 = Math.floor((entity.y + entity.height - 1) / TILE);

  for (let row = row1; row <= row2; row++) {
    for (let col = col1; col <= col2; col++) {
      if (isSolidAt(level, col, row)) {
        if (entity.vx > 0) entity.x = col * TILE - entity.width;
        else if (entity.vx < 0) entity.x = (col + 1) * TILE;
        entity.vx = 0;
        return; // satu tembok ketemu udah cukup buat berhenti
      }
    }
  }
}

// onBlockHit dipanggil kalau entity nabrak tile dari BAWAH (lompat ke
// atas dan kepalanya kena blok) — dipakai buat trigger question block.
function resolveVerticalCollision(entity, level, onBlockHit) {
  const col1 = Math.floor(entity.x / TILE);
  const col2 = Math.floor((entity.x + entity.width - 1) / TILE);
  const row1 = Math.floor(entity.y / TILE);
  const row2 = Math.floor((entity.y + entity.height - 1) / TILE);

  for (let row = row1; row <= row2; row++) {
    for (let col = col1; col <= col2; col++) {
      if (isSolidAt(level, col, row)) {
        if (entity.vy > 0) {
          // jatuh dan nempel ke lantai/platform dari atas
          entity.y = row * TILE - entity.height;
          entity.vy = 0;
          entity.onGround = true;
        } else if (entity.vy < 0) {
          // lompat dan kepala nabrak blok dari bawah
          entity.y = (row + 1) * TILE;
          entity.vy = 0;
          if (onBlockHit) onBlockHit(col, row);
        }
        return;
      }
    }
  }
}
