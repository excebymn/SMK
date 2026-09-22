// ============================================================
// ENEMY
// ------------------------------------------------------------
// Dua jenis musuh:
//  - "walker"  : jalan bolak-balik di tanah, belok kalau ketemu
//                tembok atau ketemu jurang di depannya
//  - "hopper"  : mirip walker tapi loncat-loncat secara berkala
// ============================================================
class Enemy {
  constructor(type, x, y) {
    this.type = type;
    this.x = x;
    this.y = y;
    this.width = 32;
    this.height = type === "hopper" ? 24 : 28;

    this.vx = -ENEMY_SPEED * (type === "hopper" ? 0.7 : 1);
    this.vy = 0;
    this.onGround = false;

    this.alive = true;
    this.squashTimer = 0; // beberapa frame terakhir sebelum bener2 hilang
    this.hopTimer = HOPPER_JUMP_INTERVAL;
  }

  update(dt, level) {
    if (!this.alive) {
      this.squashTimer -= dt;
      return;
    }

    if (this.type === "hopper") {
      this.hopTimer -= dt;
      if (this.hopTimer <= 0 && this.onGround) {
        this.vy = HOPPER_JUMP_VELOCITY;
        this.hopTimer = HOPPER_JUMP_INTERVAL;
      }
    }

    // --- deteksi jurang di depan ---
    // ini yang bikin musuh gak asal jalan lompat ke lubang kayak
    // orang buta: cek petak di depan-bawah, kalau kosong (gak ada
    // tanah), langsung belok balik SEBELUM kejeblos.
    if (this.onGround) {
      const aheadX = this.vx > 0 ? this.x + this.width + 1 : this.x - 1;
      const aheadCol = Math.floor(aheadX / TILE);
      const belowRow = Math.floor((this.y + this.height + 1) / TILE);
      if (!isSolidAt(level, aheadCol, belowRow)) {
        this.vx *= -1;
      }
    }

    this.x += this.vx * dt;
    resolveHorizontalCollision(this, level);
    // kalau abis nabrak tembok vx jadi 0 (efek dari resolveHorizontalCollision),
    // musuhnya harus tetep gerak — jadi kasih dorongan ke arah sebaliknya
    if (this.vx === 0) {
      this.vx = (Math.random() < 0.5 ? -1 : 1) * ENEMY_SPEED * (this.type === "hopper" ? 0.7 : 1);
    }

    this.vy += GRAVITY * dt;
    if (this.vy > MAX_FALL_SPEED) this.vy = MAX_FALL_SPEED;
    this.y += this.vy * dt;
    this.onGround = false;
    resolveVerticalCollision(this, level);
  }

  // diinjek dari atas oleh player
  squash() {
    this.alive = false;
    this.squashTimer = 15;
  }

  draw(ctx, cameraX) {
    if (!this.alive && this.squashTimer <= 0) return;

    // pas baru keinjek, kasih efek kedip transparan sebentar
    // sebelum bener-bener hilang dari layar
    if (!this.alive) ctx.globalAlpha = 0.4;

    const grid = this.type === "hopper" ? HOPPER_SPRITE : WALKER_SPRITE;
    drawSprite(ctx, grid, this.x, this.y, cameraX, this.vx < 0);

    ctx.globalAlpha = 1;
  }
}
