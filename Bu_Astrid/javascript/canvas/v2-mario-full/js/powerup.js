// ============================================================
// POWERUP (Berry)
// ------------------------------------------------------------
// Muncul dari question block ketika dipukul dari bawah. Begitu
// keluar, dia jalan pelan ke satu arah dan mantul balik kalau
// nabrak tembok — gak dibikin diam soalnya kesannya lebih hidup
// dan lebih enak buat dikejar player.
// ============================================================
class Powerup {
  constructor(x, y) {
    this.x = x;
    this.y = y;
    this.width = 24;
    this.height = 24;
    this.dir = 1; // arah jalan: 1 kanan, -1 kiri
    this.vy = 0;
    this.onGround = false;
    this.collected = false;
  }

  update(dt, level) {
    if (this.collected) return;

    // cek manual (bukan pakai resolveHorizontalCollision) soalnya
    // kita butuh tau PERSIS kapan nabrak buat balik arah — bukan cuma
    // berhenti di tembok kayak player/musuh
    const nextX = this.x + this.dir * 1 * dt;
    const edgeCol = this.dir > 0
      ? Math.floor((nextX + this.width - 1) / TILE)
      : Math.floor(nextX / TILE);
    const midRow = Math.floor((this.y + this.height / 2) / TILE);

    if (isSolidAt(level, edgeCol, midRow)) {
      this.dir *= -1;
    } else {
      this.x = nextX;
    }

    this.vy += GRAVITY * dt;
    if (this.vy > MAX_FALL_SPEED) this.vy = MAX_FALL_SPEED;
    this.y += this.vy * dt;
    this.onGround = false;
    resolveVerticalCollision(this, level);
  }

  draw(ctx, cameraX) {
    if (this.collected) return;
    drawSprite(ctx, BERRY_SPRITE, this.x, this.y, cameraX, false);
  }
}
