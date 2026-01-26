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





function operasiMatematika(a, b, op) {
    switch (op) {
        case 'tambah': return a + b;
        case 'kurang': return a - b;
        case 'kali':   return a * b;
        case 'bagi':   return b !== 0 ? a / b : 'Error';
        default:       return '';
    }
}

function hitung(mode) {
    let angka1 = parseFloat(document.getElementById('angka1').value);
    let angka2 = parseFloat(document.getElementById('angka2').value);

    if (isNaN(angka1) || isNaN(angka2)) {
        document.getElementById('hasil').value = 'Masukkan angka';
        return;
    }

    document.getElementById('hasil').value = operasiMatematika(angka1, angka2, mode);
}




function clearAll() {
    document.getElementById('angka1').value = '';
    document.getElementById('angka2').value = '';
    document.getElementById('hasil').value = '';
}


function tampan() {
  const msg = document.querySelector(".admintampan");
  msg.style.display = "block";
  msg.innerText = "Terima kasih sudah menjawab yaa, saya memang sangat tampan!!";
}

function tidak() {
  const msg = document.querySelector(".admintampan");
  msg.style.display = "block";
  msg.innerText = "Terima kasih sudah menjawab yaa, saya memang sangat tampan!!";
}
function clearJawaban() {
  const msg = document.querySelector(".admintampan");
  msg.style.display = "none";
  msg.innerText = ""; 
}
