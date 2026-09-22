// ============================================================
// PLAYER
// ============================================================
class Player {
  constructor(x, y) {
    this.x = x;
    this.y = y;
    this.vx = 0;
    this.vy = 0;

    this.power = "small"; // "small" | "big"
    this.facing = 1;      // 1 = ngadep kanan, -1 = ngadep kiri
    this.onGround = false;

    this.animTimer = 0;
    this.animFrame = 0;

    this.invulnTimer = 0; // kebal sesaat setelah kena hit
    this.dead = false;
  }

  get width() {
    return 32;
  }
  get height() {
    return this.power === "big" ? 48 : 40;
  }

  grow() {
    if (this.power === "small") {
      this.power = "big";
      this.y -= 8; // biar posisi kaki gak berubah pas badan jadi lebih tinggi
    }
  }

  // kena hit: kalau masih besar, cuma balik jadi kecil (gak mati).
  // kalau udah kecil dan kena lagi, baru bener-bener mati.
  shrink() {
    if (this.power === "big") {
      this.power = "small";
      this.invulnTimer = 90; // sekitar 1.5 detik kebal biar gak double-kena
    } else {
      this.dead = true;
    }
  }

  update(dt, keys, level, onBlockHit) {
    if (this.invulnTimer > 0) this.invulnTimer -= dt;

    // --- gerak horizontal ---
    if (keys.left) {
      this.vx = -PLAYER_SPEED;
      this.facing = -1;
    } else if (keys.right) {
      this.vx = PLAYER_SPEED;
      this.facing = 1;
    } else {
      this.vx = 0;
    }

    // animasi jalan cuma nyala kalau lagi gerak DAN nempel tanah —
    // biar pas lompat gak keliatan "jalan di udara"
    if (this.vx !== 0 && this.onGround) {
      this.animTimer += dt;
      if (this.animTimer > 8) {
        this.animTimer = 0;
        this.animFrame = 1 - this.animFrame;
      }
    } else {
      this.animFrame = 0;
    }

    this.x += this.vx * dt;
    resolveHorizontalCollision(this, level);

    // --- lompat, cuma bisa kalau nempel tanah ---
    if (keys.jump && this.onGround) {
      this.vy = JUMP_VELOCITY;
      this.onGround = false;
    }

    // --- gravity & gerak vertikal ---
    this.vy += GRAVITY * dt;
    if (this.vy > MAX_FALL_SPEED) this.vy = MAX_FALL_SPEED;
    this.y += this.vy * dt;
    this.onGround = false;
    resolveVerticalCollision(this, level, onBlockHit);
  }

  draw(ctx, cameraX) {
    // pas kebal, sprite-nya kedip-kedip (setengah frame gak digambar)
    // biar keliatan lagi invulnerable
    if (this.invulnTimer > 0 && Math.floor(this.invulnTimer / 6) % 2 === 0) return;

    const grid = getPlayerSprite(this.power, this.animFrame, this.onGround, this.vx);
    drawSprite(ctx, grid, this.x, this.y, cameraX, this.facing === -1);
  }
}
