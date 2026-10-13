#!/usr/bin/env bash
# Membuat dua project Cordova dari nol di ~/cordova lalu menyalin www/ dari folder ini.
set -e
ROOT="$(cd "$(dirname "$0")" && pwd)"
TARGET="$HOME/cordova"
mkdir -p "$TARGET"
cd "$TARGET"

create_app() {
  local name="$1" id="$2" title="$3"
  if [ -d "$name" ]; then
    echo ">> $name sudah ada, dilewati pembuatannya"
  else
    cordova create "$name" "$id" "$title"
  fi
  cd "$name"
  rm -rf www
  cp -r "$ROOT/$name/www" www
  cordova plugin add cordova-plugin-camera
  cordova platform add browser || true
  cordova platform add android || true
  cd ..
}

create_app pustaka-app  com.pustaka.app  PustakaApp
create_app bukutamu-app com.bukutamu.app BukuTamuApp

echo
echo "Selesai. Project ada di $TARGET"
echo "Langkah berikutnya: isi SUPABASE_URL & SUPABASE_KEY di www/js/app.js masing-masing project."
