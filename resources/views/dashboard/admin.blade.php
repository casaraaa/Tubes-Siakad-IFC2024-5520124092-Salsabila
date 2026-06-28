@extends('layouts.app')

@section('judul', 'Dashboard Admin')

@section('konten')

    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-800">Selamat datang, Admin 👋</h2>
        <p class="text-sm text-slate-500 mt-1">Berikut ringkasan data akademik saat ini.</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <x-kartu-statistik label="Dosen" :nilai="$statistik['total_dosen']" ikon="user-round" warna="indigo" />
        <x-kartu-statistik label="Mahasiswa" :nilai="$statistik['total_mahasiswa']" ikon="users" warna="emerald" />
        <x-kartu-statistik label="Mata Kuliah" :nilai="$statistik['total_matakuliah']" ikon="book-open" warna="amber" />
        <x-kartu-statistik label="Jadwal" :nilai="$statistik['total_jadwal']" ikon="calendar-clock" warna="sky" />
        <x-kartu-statistik label="Total KRS" :nilai="$statistik['total_krs']" ikon="clipboard-list" warna="rose" />
    </div>

@endsection
