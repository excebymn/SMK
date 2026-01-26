let button = document.getElementById("btn");
let bulb = document.getElementById("bulb");
let text = document.getElementById("text");
let tambah = document.getElementById("tambah");
let kurang = document.getElementById("kurang");


function change() {
  const img = document.getElementById("bulb");
  const status = img.dataset.status;
  if (status == "off") {
    img.src = "pic_bulbon.gif";
    img.dataset.status = "on";
  } else {
    img.src = "pic_bulboff.gif";
    img.dataset.status = "off";
  }
}

let angka = 0;
text.textContent = angka;

function tombol(pencet) {
  if (pencet == "tambah") {
    angka++;
  } else {
    angka--;
  }

  if (angka > 0) {
    kurang.style.display = "block";
  } else {
    kurang.style.display = "none";
  }

  text.textContent = angka;
}