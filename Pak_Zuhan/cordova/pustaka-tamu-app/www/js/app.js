/* ==========================================================
   Pustaka dan Tamu - satu aplikasi, dua layanan
   Alur: Splash -> Login -> Hub (pilih layanan) -> Perpustakaan / Buku Tamu
   ========================================================== */

// ---------- Supabase ----------
const cfg = window.APP_CONFIG || {};
const CONFIGURED = !!cfg.SUPABASE_URL && !String(cfg.SUPABASE_URL).startsWith('YOUR_');
// Jangan namai variabel "supabase": nama itu sudah dipakai library CDN
const sb = CONFIGURED ? window.supabase.createClient(cfg.SUPABASE_URL, cfg.SUPABASE_KEY) : null;

// ---------- State ----------
let currentUser = null;
let currentProfile = null;
let base64Photo = null;
const navStack = ['splash-screen'];

const $ = (id) => document.getElementById(id);

// ---------- Startup ----------
document.addEventListener('deviceready', onDeviceReady, false);

function onDeviceReady() {
    $('login-form').addEventListener('submit', handleLogin);
    $('btn-logout').addEventListener('click', handleLogout);
    $('toggle-pw').addEventListener('click', togglePassword);
    $('btn-update-photo').addEventListener('click', updateProfilePhoto);
    $('photo-box').addEventListener('click', takeGuestPhoto);
    $('btn-take-photo').addEventListener('click', takeGuestPhoto);
    $('guest-form').addEventListener('submit', handleCheckIn);

    // Navigasi lewat atribut data-*
    document.addEventListener('click', (e) => {
        const goBtn = e.target.closest('[data-go]');
        if (goBtn) return go(goBtn.dataset.go);
        if (e.target.closest('[data-back]')) return goBack();
        const soon = e.target.closest('[data-soon]');
        if (soon) showToast(soon.dataset.soon + ' segera hadir');
    });

    // Tombol back fisik Android
    document.addEventListener('backbutton', onBackButton, false);

    setTimeout(checkSession, 1800); // splash
}

// ---------- Router sederhana ----------
function show(id) {
    document.querySelectorAll('.screen').forEach((s) => s.classList.toggle('active', s.id === id));
    window.scrollTo(0, 0);
}
function go(id) {
    navStack.push(id);
    show(id);
    onEnter(id);
}
function resetTo(id) {          // ganti seluruh riwayat (login / hub)
    navStack.length = 0;
    go(id);
}
function goBack() {
    if (navStack.length > 1) {
        navStack.pop();
        const id = navStack[navStack.length - 1];
        show(id);
        onEnter(id);
    }
}
function onBackButton() {
    if (navStack.length > 1) goBack();
    else if (navigator.app && navigator.app.exitApp) navigator.app.exitApp();
}
function onEnter(id) {
    if (id === 'guest-screen') prepareGuestScreen();
}

// ---------- UI helpers ----------
let toastTimer = null;
function showToast(message, type = 'info', ms = 3000) {
    const t = $('toast');
    t.textContent = message;
    t.className = 'toast show ' + type;
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => { t.className = 'toast'; }, ms);
}

function setBusy(btn, busy, busyText) {
    if (busy) {
        btn.dataset.label = btn.textContent;
        btn.textContent = busyText || 'Memproses...';
        btn.disabled = true;
    } else {
        if (btn.dataset.label) btn.textContent = btn.dataset.label;
        btn.disabled = false;
    }
}

function setAvatar(el, url, name) {
    if (url) {
        el.style.backgroundImage = `url("${url}")`;
        el.textContent = '';
    } else {
        el.style.backgroundImage = '';
        el.textContent = (name || '?').trim().charAt(0).toUpperCase();
    }
}

function greeting() {
    const h = new Date().getHours();
    if (h < 11) return 'Selamat pagi';
    if (h < 15) return 'Selamat siang';
    if (h < 18) return 'Selamat sore';
    return 'Selamat malam';
}

function togglePassword() {
    const input = $('login-password');
    const hidden = input.type === 'password';
    input.type = hidden ? 'text' : 'password';
    $('toggle-pw').textContent = hidden ? 'Sembunyi' : 'Lihat';
}

// ---------- Auth ----------
async function checkSession() {
    if (!sb) {
        resetTo('login-screen');
        showToast('Isi kredensial Supabase di www/js/config.js dulu', 'error', 6000);
        return;
    }
    try {
        const { data: { session } } = await sb.auth.getSession();
        if (session) {
            currentUser = session.user;
            await loadProfile();
            resetTo('hub-screen');
        } else {
            resetTo('login-screen');
        }
    } catch (err) {
        resetTo('login-screen');
        showToast('Gagal memeriksa sesi: ' + err.message, 'error');
    }
}

async function handleLogin(e) {
    e.preventDefault();
    if (!sb) return showToast('Isi kredensial Supabase di www/js/config.js dulu', 'error', 5000);

    const btn = $('btn-login');
    setBusy(btn, true, 'Memproses...');
    try {
        const { data, error } = await sb.auth.signInWithPassword({
            email: $('login-email').value.trim(),
            password: $('login-password').value
        });
        if (error) throw error;
        currentUser = data.user;
        await loadProfile();
        $('login-form').reset();
        resetTo('hub-screen');
    } catch (err) {
        showToast('Login gagal: ' + err.message, 'error');
    } finally {
        setBusy(btn, false);
    }
}

async function handleLogout() {
    try { await sb.auth.signOut(); } catch (e) { console.log(e); }
    currentUser = null;
    currentProfile = null;
    resetTo('login-screen');
}

async function loadProfile() {
    const { data, error } = await sb.from('profiles').select('*').eq('id', currentUser.id).single();
    if (error) {
        showToast('Gagal memuat profil: ' + error.message, 'error');
        currentProfile = { id: currentUser.id, full_name: currentUser.email, role: 'anggota', photo_url: null };
    } else {
        currentProfile = data;
    }
    renderUser();
}

function renderUser() {
    const p = currentProfile;
    const name = p.full_name || currentUser.email || '-';
    const role = p.role || 'anggota';

    $('hub-greet').textContent = greeting() + ',';
    $('hub-name').textContent = name;
    $('hub-role').textContent = role;
    setAvatar($('hub-avatar'), p.photo_url, name);

    $('card-user-name').textContent = name;
    $('card-user-id').textContent = 'ID: ' + String(p.id).substring(0, 8);
    $('lib-role').textContent = role;
    setAvatar($('lib-avatar'), p.photo_url, name);

    $('staff-name').textContent = currentUser.email || name;
}

// ---------- Kamera ----------
function capturePhoto(extra) {
    return new Promise((resolve, reject) => {
        if (!navigator.camera) return reject(new Error('NO_CAMERA'));
        const options = Object.assign({
            quality: 60,
            destinationType: Camera.DestinationType.DATA_URL,
            sourceType: Camera.PictureSourceType.CAMERA,
            encodingType: Camera.EncodingType.JPEG,
            mediaType: Camera.MediaType.PICTURE,
            targetWidth: 600,
            targetHeight: 600,
            correctOrientation: true
        }, extra || {});
        navigator.camera.getPicture(resolve, (msg) => reject(new Error(msg || 'CANCELLED')), options);
    });
}

function handleCaptureError(err) {
    if (err.message === 'NO_CAMERA') {
        showToast('Kamera hanya tersedia di perangkat atau emulator', 'error');
    } else {
        console.log('Pengambilan foto dibatalkan: ' + err.message);
    }
}

function base64ToBlob(base64, mimeType) {
    const byteCharacters = atob(base64);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) byteNumbers[i] = byteCharacters.charCodeAt(i);
    return new Blob([new Uint8Array(byteNumbers)], { type: mimeType });
}

// ---------- Perpustakaan: update foto profil ----------
async function updateProfilePhoto() {
    let b64;
    try {
        b64 = await capturePhoto({ quality: 50 });
    } catch (err) {
        return handleCaptureError(err);
    }

    showToast('Mengunggah foto...');
    try {
        const blob = base64ToBlob(b64, 'image/jpeg');
        const fileName = `${currentProfile.role || 'user'}/${currentProfile.id}_${Date.now()}.jpg`;

        const { error } = await sb.storage
            .from('avatars')
            .upload(fileName, blob, { contentType: 'image/jpeg', upsert: true });
        if (error) throw error;

        const { data: urlData } = sb.storage.from('avatars').getPublicUrl(fileName);
        const publicUrl = urlData.publicUrl;

        const { error: updateError } = await sb
            .from('profiles')
            .update({ photo_url: publicUrl })
            .eq('id', currentProfile.id);
        if (updateError) throw updateError;

        currentProfile.photo_url = publicUrl;
        renderUser();
        showToast('Foto profil berhasil diperbarui', 'success');
    } catch (err) {
        showToast('Gagal mengunggah foto: ' + err.message, 'error', 5000);
    }
}

// ---------- Buku Tamu ----------
async function prepareGuestScreen() {
    await loadDropdownOptions();
}

async function loadDropdownOptions() {
    try {
        const [cat, pur, loc, host, badge] = await Promise.all([
            sb.from('guest_categories').select('*').order('name'),
            sb.from('visit_purposes').select('*').order('name'),
            sb.from('locations').select('*').order('building_name'),
            sb.from('profiles').select('id, full_name').order('full_name'),
            sb.from('guest_badges').select('*').eq('status', 'tersedia').order('badge_code')
        ]);
        const failed = [cat, pur, loc, host, badge].find((r) => r.error);
        if (failed) throw failed.error;

        populateSelect('select-category', cat.data, 'id', 'name', '-- Pilih Kategori --');
        populateSelect('select-purpose', pur.data, 'id', 'name', '-- Pilih Tujuan --');
        populateSelect(
            'select-location',
            (loc.data || []).map((l) => ({ id: l.id, text: `${l.building_name} - ${l.room_name}` })),
            'id', 'text', '-- Pilih Lokasi --'
        );
        populateSelect('select-host', host.data, 'id', 'full_name', '-- Pilih Staf --');
        populateSelect('select-badge', badge.data, 'id', 'badge_code', '-- Tanpa Badge --');
    } catch (err) {
        showToast('Gagal memuat data: ' + err.message, 'error', 5000);
    }
}

function populateSelect(elementId, items, valueKey, textKey, defaultText) {
    const select = $(elementId);
    const previous = select.value;
    select.innerHTML = '';
    const first = document.createElement('option');
    first.value = '';
    first.textContent = defaultText;
    select.appendChild(first);
    (items || []).forEach((item) => {
        const option = document.createElement('option');
        option.value = item[valueKey];
        option.textContent = item[textKey];
        select.appendChild(option);
    });
    if (previous && [...select.options].some((o) => o.value === previous)) select.value = previous;
}

async function takeGuestPhoto() {
    try {
        base64Photo = await capturePhoto({ quality: 60 });
        $('photo-preview').src = 'data:image/jpeg;base64,' + base64Photo;
        $('photo-box').classList.add('has-photo');
    } catch (err) {
        handleCaptureError(err);
    }
}

async function handleCheckIn(e) {
    e.preventDefault();
    const btn = $('btn-submit');
    setBusy(btn, true, 'Menyimpan...');

    try {
        let photoPublicUrl = null;

        // 1. Upload foto (jika diambil)
        if (base64Photo) {
            const blob = base64ToBlob(base64Photo, 'image/jpeg');
            const fileName = `guests/guest_${Date.now()}.jpg`;
            const { error: uploadErr } = await sb.storage
                .from('avatars')
                .upload(fileName, blob, { contentType: 'image/jpeg' });
            if (uploadErr) throw uploadErr;
            photoPublicUrl = sb.storage.from('avatars').getPublicUrl(fileName).data.publicUrl;
        }

        // 2. Simpan kunjungan
        const badgeId = $('select-badge').value || null;
        const visitPayload = {
            category_id: $('select-category').value,
            purpose_id: $('select-purpose').value,
            location_id: $('select-location').value,
            host_id: $('select-host').value,
            security_id: currentUser ? currentUser.id : null,
            badge_id: badgeId,
            guest_name: $('guest-name').value.trim(),
            guest_phone: $('guest-phone').value.trim(),
            guest_company: $('guest-company').value.trim(),
            photo_url: photoPublicUrl,
            notes: $('guest-notes').value.trim(),
            status: 'aktif'
        };
        const { data: visitData, error: visitErr } = await sb
            .from('visits').insert([visitPayload]).select().single();
        if (visitErr) throw visitErr;

        // 3. Badge jadi "dipakai"
        if (badgeId) {
            await sb.from('guest_badges').update({ status: 'dipakai' }).eq('id', badgeId);
        }

        // 4. Barang titipan
        const itemName = $('item-name').value.trim();
        if (itemName) {
            await sb.from('guest_belongings').insert([{
                visit_id: visitData.id,
                item_name: itemName,
                locker_number: $('locker-number').value.trim()
            }]);
        }

        // 5. Notifikasi untuk host
        await sb.from('notifications').insert([{
            recipient_id: visitPayload.host_id,
            visit_id: visitData.id,
            message: `Tamu baru (${visitPayload.guest_name}) telah check-in untuk menemui Anda.`
        }]);

        showToast('Check-in tamu berhasil', 'success');
        resetGuestForm();
    } catch (err) {
        showToast('Gagal check-in: ' + err.message, 'error', 5000);
    } finally {
        setBusy(btn, false);
    }
}

function resetGuestForm() {
    $('guest-form').reset();
    base64Photo = null;
    $('photo-preview').removeAttribute('src');
    $('photo-box').classList.remove('has-photo');
    window.scrollTo(0, 0);
    loadDropdownOptions(); // segarkan ketersediaan badge
}
