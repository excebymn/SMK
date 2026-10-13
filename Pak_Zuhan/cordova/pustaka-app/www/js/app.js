// ====== KONFIGURASI SUPABASE (ISI DENGAN MILIK ANDA) ======
const SUPABASE_URL = "https://ohxuqufkevdngziekyoa.supabase.co";
const SUPABASE_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im9oeHVxdWZrZXZkbmd6aWVreW9hIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODkzMzM2NzMsImV4cCI6MjEwNDkwOTY3M30.NQSEQKENcPNl-u-A2wMSEi1gTDIGZzwSh_NQMPeKtII";
// Catatan: jangan namai variabel "supabase", nama itu sudah dipakai library CDN
const sb = window.supabase.createClient(SUPABASE_URL, SUPABASE_KEY);

const AVATAR_PLACEHOLDER =
    "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='60' height='60'><rect width='100%' height='100%' fill='%23b3e5fc'/><text x='50%' y='58%' text-anchor='middle' font-size='28'>👤</text></svg>";

let currentUserProfile = null;

document.addEventListener('deviceready', onDeviceReady, false);

function onDeviceReady() {
    document.getElementById('user-avatar').src = AVATAR_PLACEHOLDER;

    // Splash screen 2 detik
    setTimeout(checkSession, 2000);

    document.getElementById('login-form').addEventListener('submit', handleLogin);
    document.getElementById('btn-logout').addEventListener('click', handleLogout);
}

function showScreen(screenId) {
    document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
    document.getElementById(screenId).classList.add('active');
}

async function checkSession() {
    const { data: { session } } = await sb.auth.getSession();
    if (session) {
        await loadUserData(session.user.id);
        showScreen('main-screen');
    } else {
        showScreen('login-screen');
    }
}

async function handleLogin(e) {
    e.preventDefault();
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;

    const { data, error } = await sb.auth.signInWithPassword({ email, password });
    if (error) {
        alert('Login Gagal: ' + error.message);
    } else {
        await loadUserData(data.user.id);
        showScreen('main-screen');
    }
}

async function loadUserData(userId) {
    const { data, error } = await sb.from('profiles').select('*').eq('id', userId).single();
    if (error) {
        alert('Gagal memuat profil: ' + error.message);
        return;
    }
    if (data) {
        currentUserProfile = data;
        document.getElementById('user-name').innerText = data.full_name || '-';
        document.getElementById('user-role').innerText = data.role || '-';
        document.getElementById('card-user-name').innerText = data.full_name || '-';
        document.getElementById('card-user-id').innerText = 'ID: ' + data.id.substring(0, 8);
        if (data.photo_url) {
            document.getElementById('user-avatar').src = data.photo_url;
        }
    }
}

function takePhotoAndUpload() {
    if (!navigator.camera) {
        alert("Fitur kamera hanya tersedia di perangkat/emulator!");
        return;
    }
    const options = {
        quality: 50,
        destinationType: Camera.DestinationType.DATA_URL,
        sourceType: Camera.PictureSourceType.CAMERA,
        encodingType: Camera.EncodingType.JPEG,
        mediaType: Camera.MediaType.PICTURE,
        correctOrientation: true
    };

    navigator.camera.getPicture(async (base64Image) => {
        try {
            const blob = base64ToBlob(base64Image, 'image/jpeg');
            const fileName = `${currentUserProfile.role || 'user'}/${currentUserProfile.id}_${Date.now()}.jpg`;

            const { error } = await sb.storage
                .from('avatars')
                .upload(fileName, blob, { contentType: 'image/jpeg', upsert: true });
            if (error) throw error;

            const { data: urlData } = sb.storage.from('avatars').getPublicUrl(fileName);
            const publicUrl = urlData.publicUrl;

            const { error: updateError } = await sb
                .from('profiles')
                .update({ photo_url: publicUrl })
                .eq('id', currentUserProfile.id);
            if (updateError) throw updateError;

            document.getElementById('user-avatar').src = publicUrl;
            alert("Foto profil berhasil diperbarui!");
        } catch (err) {
            alert("Gagal mengunggah foto: " + err.message);
        }
    }, (error) => {
        console.log("Kamera dibatalkan: " + error);
    }, options);
}

function base64ToBlob(base64, mimeType) {
    const byteCharacters = atob(base64);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    return new Blob([new Uint8Array(byteNumbers)], { type: mimeType });
}

async function handleLogout() {
    await sb.auth.signOut();
    currentUserProfile = null;
    showScreen('login-screen');
}
