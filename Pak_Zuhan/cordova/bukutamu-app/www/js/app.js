// ====== KONFIGURASI SUPABASE (ISI DENGAN MILIK ANDA) ======
const SUPABASE_URL = "https://ohxuqufkevdngziekyoa.supabase.co";
const SUPABASE_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im9oeHVxdWZrZXZkbmd6aWVreW9hIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODkzMzM2NzMsImV4cCI6MjEwNDkwOTY3M30.NQSEQKENcPNl-u-A2wMSEi1gTDIGZzwSh_NQMPeKtII";
// Catatan: jangan namai variabel "supabase", nama itu sudah dipakai library CDN
const sb = window.supabase.createClient(SUPABASE_URL, SUPABASE_KEY);

const PHOTO_PLACEHOLDER =
    "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='150' height='150'><rect width='100%' height='100%' fill='%23e5e7eb'/><text x='50%' y='50%' text-anchor='middle' fill='%23666' font-size='14' font-family='sans-serif'>Ambil Foto Tamu</text></svg>";

let currentBase64Photo = null;   // foto sementara
let activeSecurityUser = null;   // petugas jaga yang login (jika ada)

document.addEventListener('deviceready', onDeviceReady, false);

function onDeviceReady() {
    document.getElementById('photo-preview').src = PHOTO_PLACEHOLDER;
    initApp();
    document.getElementById('guest-form').addEventListener('submit', handleCheckIn);
}

async function initApp() {
    const { data: { session } } = await sb.auth.getSession();
    if (session) {
        activeSecurityUser = session.user;
        document.getElementById('staff-name').innerText = session.user.email;
    } else {
        document.getElementById('staff-name').innerText = "Petugas Non-Login";
    }
    await loadDropdownOptions();
}

async function loadDropdownOptions() {
    const { data: categories, error: e1 } = await sb.from('guest_categories').select('*');
    if (e1) console.error(e1);
    populateSelect('select-category', categories, 'id', 'name', '-- Pilih Kategori --');

    const { data: purposes } = await sb.from('visit_purposes').select('*');
    populateSelect('select-purpose', purposes, 'id', 'name', '-- Pilih Tujuan --');

    const { data: locations } = await sb.from('locations').select('*');
    const locationOptions = locations?.map(l => ({ id: l.id, text: `${l.building_name} - ${l.room_name}` }));
    populateSelect('select-location', locationOptions, 'id', 'text', '-- Pilih Lokasi --');

    const { data: hosts } = await sb.from('profiles').select('id, full_name');
    populateSelect('select-host', hosts, 'id', 'full_name', '-- Pilih Staf --');

    const { data: badges } = await sb.from('guest_badges').select('*').eq('status', 'tersedia');
    populateSelect('select-badge', badges, 'id', 'badge_code', '-- Tanpa Badge / Pilih Badge --');
}

function populateSelect(elementId, items, valueKey, textKey, defaultText) {
    const select = document.getElementById(elementId);
    select.innerHTML = `<option value="">${defaultText}</option>`;
    if (items) {
        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item[valueKey];
            option.textContent = item[textKey];
            select.appendChild(option);
        });
    }
}

function takeGuestPhoto() {
    if (!navigator.camera) {
        alert("Fitur kamera hanya berjalan pada perangkat mobile/emulator.");
        return;
    }
    const options = {
        quality: 60,
        destinationType: Camera.DestinationType.DATA_URL,
        sourceType: Camera.PictureSourceType.CAMERA,
        encodingType: Camera.EncodingType.JPEG,
        targetWidth: 600,
        targetHeight: 600,
        correctOrientation: true
    };
    navigator.camera.getPicture((base64Image) => {
        currentBase64Photo = base64Image;
        document.getElementById('photo-preview').src = "data:image/jpeg;base64," + base64Image;
    }, (error) => {
        console.log("Pengambilan foto dibatalkan: " + error);
    }, options);
}

async function handleCheckIn(e) {
    e.preventDefault();

    const btnSubmit = document.getElementById('btn-submit');
    btnSubmit.disabled = true;
    btnSubmit.innerText = "Proses Menyimpan...";

    try {
        let photoPublicUrl = null;

        // 1. Upload foto (jika ada)
        if (currentBase64Photo) {
            const blob = base64ToBlob(currentBase64Photo, 'image/jpeg');
            const fileName = `guests/guest_${Date.now()}.jpg`;
            const { error: uploadErr } = await sb.storage
                .from('avatars')
                .upload(fileName, blob, { contentType: 'image/jpeg' });
            if (uploadErr) throw uploadErr;

            const { data: urlData } = sb.storage.from('avatars').getPublicUrl(fileName);
            photoPublicUrl = urlData.publicUrl;
        }

        // 2. Simpan kunjungan
        const badgeId = document.getElementById('select-badge').value || null;
        const visitPayload = {
            category_id: document.getElementById('select-category').value,
            purpose_id: document.getElementById('select-purpose').value,
            location_id: document.getElementById('select-location').value,
            host_id: document.getElementById('select-host').value,
            security_id: activeSecurityUser ? activeSecurityUser.id : null,
            badge_id: badgeId,
            guest_name: document.getElementById('guest-name').value,
            guest_phone: document.getElementById('guest-phone').value,
            guest_company: document.getElementById('guest-company').value,
            photo_url: photoPublicUrl,
            notes: document.getElementById('guest-notes').value,
            status: 'aktif'
        };

        const { data: visitData, error: visitErr } = await sb
            .from('visits')
            .insert([visitPayload])
            .select()
            .single();
        if (visitErr) throw visitErr;

        // 3. Update status badge
        if (badgeId) {
            await sb.from('guest_badges').update({ status: 'dipakai' }).eq('id', badgeId);
        }

        // 4. Barang bawaan
        const itemName = document.getElementById('item-name').value;
        if (itemName) {
            await sb.from('guest_belongings').insert([{
                visit_id: visitData.id,
                item_name: itemName,
                locker_number: document.getElementById('locker-number').value
            }]);
        }

        // 5. Notifikasi untuk host
        await sb.from('notifications').insert([{
            recipient_id: visitPayload.host_id,
            visit_id: visitData.id,
            message: `Tamu baru (${visitPayload.guest_name}) telah check-in untuk menemui Anda.`
        }]);

        alert("Check-in Tamu Berhasil!");
        resetForm();
    } catch (err) {
        alert("Gagal memproses check-in: " + err.message);
    } finally {
        btnSubmit.disabled = false;
        btnSubmit.innerText = "PROSES CHECK-IN TAMU";
    }
}

function resetForm() {
    document.getElementById('guest-form').reset();
    document.getElementById('photo-preview').src = PHOTO_PLACEHOLDER;
    currentBase64Photo = null;
    loadDropdownOptions(); // refresh ketersediaan badge
}

function base64ToBlob(base64, mimeType) {
    const byteCharacters = atob(base64);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    return new Blob([new Uint8Array(byteNumbers)], { type: mimeType });
}
