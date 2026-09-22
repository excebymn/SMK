// Konfigurasi Supabase
const SUPABASE_URL = "YOUR_SUPABASE_URL";
const SUPABASE_KEY = "YOUR_SUPABASE_ANON_KEY";
const supabase = supabase.createClient(SUPABASE_URL, SUPABASE_KEY);

let currentUserProfile = null;

// EventListener Cordova
document.addEventListener('deviceready', onDeviceReady, false);

function onDeviceReady() {  
    // Simulasi Splash Screen selama 2 detik
    setTimeout(() => {
        checkSession();
    }, 2000);

    // Event Listener Login & Logout
    document.getElementById('login-form').addEventListener('submit', handleLogin);
    document.getElementById('btn-logout').addEventListener('click', handleLogout);
}

// Navigasi Halaman
function showScreen(screenId) {
    document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
    document.getElementById(screenId).classList.add('active');
}

// Cek Sesi Pengguna
async function checkSession() {
    const { data: { session } } = await supabase.auth.getSession();
    if (session) {
        await loadUserData(session.user.id);
        showScreen('main-screen');
    } else {
        showScreen('login-screen');
    }
}

// Proses Login
async function handleLogin(e) {
    e.preventDefault();
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;

    const { data, error } = await supabase.auth.signInWithPassword({ email, password });

    if (error) {
        alert('Login Gagal: ' + error.message);
    } else {
        await loadUserData(data.user.id);
        showScreen('main-screen');
    }
}

// Load Data Profil Pengguna
async function loadUserData(userId) {
    const { data, error } = await supabase
        .from('profiles')
        .select('*')
        .eq('id', userId)
        .single();

    if (data) {
        currentUserProfile = data;
        document.getElementById('user-name').innerText = data.full_name;
        document.getElementById('user-role').innerText = data.role;
        document.getElementById('card-user-name').innerText = data.full_name;
        document.getElementById('card-user-id').innerText = 'ID: ' + data.id.substring(0, 8);
        
        if (data.photo_url) {
            document.getElementById('user-avatar').src = data.photo_url;
        }
    }
}

// Pengambilan Foto Menggunakan Cordova Camera Plugin & Upload ke Supabase
function takePhotoAndUpload() {
    if (!navigator.camera) {
        alert("Fitur kamera hanya tersedia di perangkat/emulator!");
        return;
    }

    const options = {
        quality: 50,
        destinationType: Camera.DestinationType.DATA_URL, // Ambil gambar format Base64
        sourceType: Camera.PictureSourceType.CAMERA,
        encodingType: Camera.EncodingType.JPEG,
        mediaType: Camera.MediaType.PICTURE,
        correctOrientation: true
    };

    navigator.camera.getPicture(async (base64Image) => {
        try {
            // Convert Base64 ke Blob
            const blob = base64ToBlob(base64Image, 'image/jpeg');
            const fileName = `${currentUserProfile.role}/${currentUserProfile.id}_${Date.now()}.jpg`;

            // 1. Upload ke Supabase Storage Bucket 'avatars'
            const { data, error } = await supabase.storage
                .from('avatars')
                .upload(fileName, blob, { contentType: 'image/jpeg', upsert: true });

            if (error) throw error;

            // 2. Dapatkan Public URL
            const { data: urlData } = supabase.storage
                .from('avatars')
                .getPublicUrl(fileName);

            const publicUrl = urlData.publicUrl;

            // 3. Update Kolom photo_url pada Tabel profiles
            const { error: updateError } = await supabase
                .from('profiles')
                .update({ photo_url: publicUrl })
                .eq('id', currentUserProfile.id);

            if (updateError) throw updateError;

            // Refresh Tampilan Foto Profil
            document.getElementById('user-avatar').src = publicUrl;
            alert("Foto profil berhasil diperbarui!");

        } catch (err) {
            alert("Gagal mengunggah foto: " + err.message);
        }
    }, (error) => {
        console.log("Kamera dibatalkan: " + error);
    }, options);
}

// Helper untuk konversi Base64 ke Blob
function base64ToBlob(base64, mimeType) {
    const byteCharacters = atob(base64);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    const byteArray = new Uint8Array(byteNumbers);
    return new Blob([byteArray], { type: mimeType });
}

// Proses Logout
async function handleLogout() {
    await supabase.auth.signOut();
    showScreen('login-screen');
}