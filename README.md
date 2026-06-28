# SIAKAD Akademik — Tugas Besar Pemrograman Web

## Nama: Salsabila Rahmah Al-fikriyah
## Kelas: IF-C 24
## npm: 5520124092

## 1. Tentang Aplikasi

SIAKAD Akademik mensimulasikan proses akademik sederhana di sebuah kampus: pengelolaan data dosen, mahasiswa, mata kuliah, jadwal kuliah, dan Kartu Rencana Studi (KRS).

Terdapat dua peran pengguna:

Admin: Mengelola seluruh data master (dosen, mahasiswa, mata kuliah, jadwal) dan memantau rekap KRS seluruh mahasiswa. 
Mahasiswa: Mengambil (menambah) atau men-drop (menghapus) mata kuliah miliknya sendiri, serta melihat jadwal kuliah pribadi. 

## 2. Peta Halaman

`/login` -> Form masuk berbasis session (Laravel Auth) 
`/dashboard` -> Statistik ringkas (admin) atau info akademik pribadi (mahasiswa) 
`/dosen` -> CRUD data dosen — khusus admin 
`/mahasiswa` -> CRUD data mahasiswa, sekaligus membuat akun login mahasiswa secara otomatis — khusus admin 
`/matakuliah` -> CRUD data mata kuliah — khusus admin 
`/jadwal` -> CRUD jadwal perkuliahan (terhubung ke dosen & mata kuliah) — khusus admin 
`/krs` -> Rekap seluruh entri KRS semua mahasiswa — khusus admin 
`/krs-saya` -> Mahasiswa mengambil / men-drop mata kuliah miliknya sendiri 

## 3. Fitur Utama

- Autentikasi & otorisasi berbasis peran (middleware `peran:admin`, `peran:mahasiswa`)
- CRUD lengkap: Dosen, Mahasiswa, Mata Kuliah, Jadwal, KRS
- Validasi input melalui Form Request class tersendiri (bukan inline di controller)
- Pembuatan akun mahasiswa otomatis dibungkus DB Transaction agar konsisten
- Pencarian data pada setiap halaman index
- Antarmuka responsif menggunakan Tailwind CSS + ikon Lucide

## 5. Akun Demo (hasil seeder)
user: gmail (password)
Admin: admin@siakad.test (password)
Mahasiswa: jaki@gmail.com (password)
Mahasiswa: jay@gmail.com (password)
Mahasiswa: farrel@gmail.com (password)
Mahasiswa: salsabila@gmail.com (password)

## 6. Struktur Basis Data

- dosens (`nidn` PK, `nama`)
- mahasiswas (`npm` PK, `nidn` FK → dosens, `nama`)
- matakuliahs (`kode_matakuliah` PK, `nama_matakuliah`, `sks`)
- jadwals (`id`, `kode_matakuliah` FK, `nidn` FK, `kelas`, `hari`, `jam`)
- krs (`id`, `npm` FK, `kode_matakuliah` FK, unik per pasangan)

