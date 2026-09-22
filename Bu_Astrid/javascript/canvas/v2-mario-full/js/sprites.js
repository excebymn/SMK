// ============================================================
// PIXEL ART SPRITES
// ------------------------------------------------------------
// Semua karakter di game ini digambar dari grid angka, BUKAN
// dari file gambar. Tiap angka di grid = satu warna di PALETTE.
// 0 artinya transparan (gak digambar).
//
// Cara bacanya: tiap baris di array = satu baris pixel,
// dan tiap sprite di-scale up sebesar PIXEL_UNIT (lihat config.js)
// biar keliatan kayak pixel art chunky, bukan gambar kecil ngambang.
// ============================================================

const PALETTE = {
  1: "#141414", // outline / bagian gelap
  2: "#f4c28a", // warna kulit
  3: "#159c8f", // teal, buat topi & baju si player
  4: "#e8672b", // orange, buat overall/celana player
  5: "#ffffff", // putih mata
  6: "#5a3c1e", // coklat tua, buat sepatu
  7: "#8c5a2b", // coklat, badan musuh "Grumpy" (si walker)
  8: "#4fae52", // hijau, badan musuh "Hopper"
  9: "#ffd23f", // emas, buat coin
  10: "#ff4d6d", // pink-merah, buat berry power-up
  11: "#3fae52", // hijau daun kecil di atas berry
};

// Player versi kecil, berdiri diam
const PLAYER_SMALL_STAND = [
  [0, 0, 3, 3, 3, 3, 0, 0],
  [0, 3, 3, 3, 3, 3, 3, 0],
  [3, 3, 3, 3, 3, 3, 3, 3],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 2, 5, 2, 2, 5, 2, 0],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 4, 4, 4, 4, 4, 4, 0],
  [4, 4, 4, 4, 4, 4, 4, 4],
  [0, 4, 4, 0, 0, 4, 4, 0],
  [0, 6, 6, 0, 0, 6, 6, 0],
];

// Player versi kecil, lagi jalan (kaki lebih ngangkang)
const PLAYER_SMALL_WALK = [
  [0, 0, 3, 3, 3, 3, 0, 0],
  [0, 3, 3, 3, 3, 3, 3, 0],
  [3, 3, 3, 3, 3, 3, 3, 3],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 2, 5, 2, 2, 5, 2, 0],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 4, 4, 4, 4, 4, 4, 0],
  [4, 4, 4, 4, 4, 4, 4, 4],
  [4, 4, 0, 4, 4, 0, 4, 4],
  [6, 6, 0, 0, 0, 0, 6, 6],
];

// Player versi besar (habis makan berry), badannya 2 baris lebih tinggi
const PLAYER_BIG_STAND = [
  [0, 0, 3, 3, 3, 3, 0, 0],
  [0, 3, 3, 3, 3, 3, 3, 0],
  [3, 3, 3, 3, 3, 3, 3, 3],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 2, 5, 2, 2, 5, 2, 0],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 4, 4, 4, 4, 4, 4, 0],
  [4, 4, 4, 4, 4, 4, 4, 4],
  [4, 4, 4, 4, 4, 4, 4, 4],
  [0, 4, 4, 0, 0, 4, 4, 0],
  [0, 4, 4, 0, 0, 4, 4, 0],
  [0, 6, 6, 0, 0, 6, 6, 0],
];

const PLAYER_BIG_WALK = [
  [0, 0, 3, 3, 3, 3, 0, 0],
  [0, 3, 3, 3, 3, 3, 3, 0],
  [3, 3, 3, 3, 3, 3, 3, 3],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 2, 5, 2, 2, 5, 2, 0],
  [0, 2, 2, 2, 2, 2, 2, 0],
  [0, 4, 4, 4, 4, 4, 4, 0],
  [4, 4, 4, 4, 4, 4, 4, 4],
  [4, 4, 4, 4, 4, 4, 4, 4],
  [4, 4, 0, 4, 4, 0, 4, 4],
  [4, 4, 0, 0, 0, 0, 4, 4],
  [6, 6, 0, 0, 0, 0, 6, 6],
];

// Musuh "Grumpy" — jalan bolak-balik di tanah
const WALKER_SPRITE = [
  [0, 0, 7, 7, 7, 7, 0, 0],
  [0, 7, 7, 7, 7, 7, 7, 0],
  [7, 7, 5, 7, 7, 5, 7, 7],
  [7, 7, 1, 7, 7, 1, 7, 7],
  [7, 7, 7, 7, 7, 7, 7, 7],
  [7, 7, 7, 7, 7, 7, 7, 7],
  [0, 7, 0, 0, 0, 0, 7, 0],
];

// Musuh "Hopper" — bentuknya lebih bulat & suka loncat-loncat
const HOPPER_SPRITE = [
  [0, 8, 8, 8, 8, 8, 8, 0],
  [8, 8, 8, 8, 8, 8, 8, 8],
  [8, 8, 5, 8, 8, 5, 8, 8],
  [8, 8, 1, 8, 8, 1, 8, 8],
  [8, 8, 8, 8, 8, 8, 8, 8],
  [0, 8, 8, 0, 0, 8, 8, 0],
];

// Coin yang berkilau, bakal dipakein juga buat tampilan blok koin
const COIN_SPRITE = [
  [0, 0, 9, 9, 0, 0],
  [0, 9, 9, 9, 9, 0],
  [9, 9, 5, 9, 9, 9],
  [9, 9, 9, 5, 9, 9],
  [0, 9, 9, 9, 9, 0],
  [0, 0, 9, 9, 0, 0],
];

// Berry power-up, bikin player jadi gede
const BERRY_SPRITE = [
  [0, 0, 11, 0, 0, 0],
  [0, 10, 10, 10, 0, 0],
  [10, 10, 10, 10, 10, 0],
  [10, 10, 10, 10, 10, 0],
  [0, 10, 10, 10, 0, 0],
  [0, 0, 10, 0, 0, 0],
];

// ------------------------------------------------------------
// Fungsi buat gambar satu sprite ke canvas.
// flip = true kalau player/musuh lagi ngadep ke kiri (mirror sprite).
// ------------------------------------------------------------
function drawSprite(ctx, grid, worldX, worldY, cameraX, flip) {
  const rows = grid.length;
  const cols = grid[0].length;

  for (let r = 0; r < rows; r++) {
    for (let c = 0; c < cols; c++) {
      const code = grid[r][c];
      if (code === 0) continue; // transparan, gak usah digambar

      // kalau flip, kolomnya dibalik urutannya — ini cara paling
      // gampang buat "mirror" sprite tanpa perlu gambar versi kedua
      const drawCol = flip ? cols - 1 - c : c;
      const px = Math.round(worldX - cameraX + drawCol * PIXEL_UNIT);
      const py = Math.round(worldY + r * PIXEL_UNIT);

      ctx.fillStyle = PALETTE[code];
      ctx.fillRect(px, py, PIXEL_UNIT, PIXEL_UNIT);
    }
  }
}

// Helper biar main.js/player.js gak perlu mikirin frame index manual
function getPlayerSprite(power, animFrame, onGround, vx) {
  const walking = onGround && vx !== 0;
  if (power === "big") {
    return walking && animFrame === 1 ? PLAYER_BIG_WALK : PLAYER_BIG_STAND;
  }
  return walking && animFrame === 1 ? PLAYER_SMALL_WALK : PLAYER_SMALL_STAND;
}
