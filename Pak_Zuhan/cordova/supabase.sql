-- ===== PROFIL (dipakai Perpustakaan & Buku Tamu) =====
create table profiles (
  id uuid primary key references auth.users on delete cascade,
  full_name text,
  role text default 'anggota',
  photo_url text
);

create function handle_new_user() returns trigger as $$
begin
  insert into profiles (id, full_name) values (new.id, new.email);
  return new;
end; $$ language plpgsql security definer;

create trigger on_auth_user_created after insert on auth.users
for each row execute function handle_new_user();

-- ===== BUKU TAMU =====
create table guest_categories (id uuid primary key default gen_random_uuid(), name text not null);
create table visit_purposes   (id uuid primary key default gen_random_uuid(), name text not null);
create table locations (id uuid primary key default gen_random_uuid(), building_name text, room_name text);
create table guest_badges (id uuid primary key default gen_random_uuid(), badge_code text, status text default 'tersedia');

create table visits (
  id uuid primary key default gen_random_uuid(),
  category_id uuid references guest_categories,
  purpose_id uuid references visit_purposes,
  location_id uuid references locations,
  host_id uuid references profiles,
  security_id uuid references profiles,
  badge_id uuid references guest_badges,
  guest_name text, guest_phone text, guest_company text,
  photo_url text, notes text,
  status text default 'aktif',
  created_at timestamptz default now()
);
create table guest_belongings (
  id uuid primary key default gen_random_uuid(),
  visit_id uuid references visits on delete cascade,
  item_name text, locker_number text
);
create table notifications (
  id uuid primary key default gen_random_uuid(),
  recipient_id uuid references profiles,
  visit_id uuid references visits,
  message text, created_at timestamptz default now()
);

-- Data contoh untuk dropdown
insert into guest_categories (name) values ('Tamu Umum'),('Vendor'),('Kurir');
insert into visit_purposes (name) values ('Rapat'),('Pengiriman Barang'),('Wawancara');
insert into locations (building_name, room_name) values ('Gedung A','Lobi'),('Gedung A','Ruang Rapat 1');
insert into guest_badges (badge_code) values ('V-001'),('V-002'),('V-003');

-- ===== RLS: VERSI LONGGAR UNTUK BELAJAR (JANGAN UNTUK PRODUKSI) =====
do $$
declare t text;
begin
  foreach t in array array['profiles','guest_categories','visit_purposes','locations',
    'guest_badges','visits','guest_belongings','notifications'] loop
    execute format('alter table %I enable row level security', t);
    execute format('create policy "dev_all_%s" on %I for all to anon, authenticated using (true) with check (true)', t, t);
  end loop;
end $$;

-- ===== STORAGE: bucket publik "avatars" =====
insert into storage.buckets (id, name, public) values ('avatars','avatars',true)
on conflict do nothing;

create policy "dev avatars rw" on storage.objects for all to anon, authenticated
using (bucket_id = 'avatars') with check (bucket_id = 'avatars');
