// ============================================================
// KAMERA
// ------------------------------------------------------------
// Idenya simpel: kamera pengen player selalu ada di tengah layar
// secara horizontal. Tapi kalau kita langsung "snap" kamera pas
// ke posisi itu, gerakannya bakal kaku/gerak-gerak kalau player
// jalan gak rata. Makanya dikasih sedikit "lerp" (interpolasi) —
// kamera cuma bergerak sebagian kecil ke arah target tiap frame,
// jadi kesannya ngikutin dengan halus, bukan nempel kaku.
// ============================================================

const camera = { x: 0 };

function resetCamera() {
  camera.x = 0;
}

function updateCamera(player, levelWidthPx, viewportWidth) {
  const target = player.x + player.width / 2 - viewportWidth / 2;
  const clampedTarget = Math.max(0, Math.min(target, Math.max(0, levelWidthPx - viewportWidth)));

  camera.x += (clampedTarget - camera.x) * 0.12;

  // biar gak ada sisa desimal kecil yang bikin kamera "ngambang" pas diem
  if (Math.abs(clampedTarget - camera.x) < 0.5) camera.x = clampedTarget;

  return camera.x;
}
