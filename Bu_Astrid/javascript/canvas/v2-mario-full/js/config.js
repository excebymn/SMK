// ============================================================
// KONFIGURASI GLOBAL
// ------------------------------------------------------------
// Semua angka "rasa" gameplay dikumpulin di satu tempat ini,
// biar gampang di-tweak tanpa harus buka satu-satu file lain.
// File ini WAJIB di-load paling pertama, karena file lain
// (player.js, enemy.js, dll) pakai konstanta dari sini tanpa
// deklarasi ulang.
// ============================================================

const TILE = 32;        // ukuran satu petak grid, dalam pixel
const PIXEL_UNIT = 4;    // ukuran satu "pixel" di sprite pixel-art

const GRAVITY = 0.55;
const MAX_FALL_SPEED = 14;

const PLAYER_SPEED = 3.2;
const JUMP_VELOCITY = -11;

const ENEMY_SPEED = 1.2;
const HOPPER_JUMP_INTERVAL = 90; // makin kecil = makin sering loncat
const HOPPER_JUMP_VELOCITY = -7;

const LEVEL_TIME_LIMIT = 200; // detik per level, gaya classic platformer
const STARTING_LIVES = 3;
const COINS_PER_EXTRA_LIFE = 50;

const CANVAS_WIDTH = 800;
const CANVAS_HEIGHT = 320;

const HIGHSCORE_KEY = "marioFullHighscore";

// ------------------------------------------------------------
// Highscore, sama kayak di v1 — dibungkus try/catch soalnya
// localStorage bisa aja diblokir browser.
// ------------------------------------------------------------
function loadHighscore() {
  try {
    const saved = localStorage.getItem(HIGHSCORE_KEY);
    return saved ? parseInt(saved, 10) : 0;
  } catch (e) {
    return 0;
  }
}

function saveHighscore(value) {
  try {
    localStorage.setItem(HIGHSCORE_KEY, String(value));
  } catch (e) {
    // storage diblokir, ya udah, game tetep jalan tanpa nyimpen
  }
}
