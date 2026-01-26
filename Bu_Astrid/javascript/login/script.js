document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  if (!form) {
    console.error("Form tidak ditemukan!");
    return;
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const nama = document.getElementById('nama')?.value.trim().toLowerCase() || '';
    const email = document.getElementById('email')?.value.trim().toLowerCase() || '';
    const password = document.getElementById('pw')?.value || '';

    const textbox = document.getElementById('textbox');


    textbox.className = 'textbox';

    if (nama === 'bima' && email === 'email@gmail.com' && password === 'admin1234') {
      textbox.textContent = 'Login berhasil! Mengalihkan...';
      textbox.classList.add('show', 'success');
      console.log('Login sukses! Akan redirect ke javascript2.html');
      setTimeout(() => {
        window.location.href = 'javascript2.html';
      }, 1000);
    } else {
      textbox.textContent = 'Nama, email, atau password salah!';
      textbox.classList.add('show', 'error');
    }
  });
});