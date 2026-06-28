@extends('layouts.app')

@section('judul', 'Tambah Mahasiswa')

@section('konten')

    <x-kartu judul="Tambah Data Mahasiswa">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf

            <x-input-field nama="npm" label="NPM (10 digit)" maxlength="10" placeholder="contoh: 2024001004" />
            <x-input-field nama="nama" label="Nama Mahasiswa" placeholder="contoh: Andika Pratama" />

            <x-select-field
                nama="nidn"
                label="Dosen Wali"
                :pilihan="$dosens->pluck('nama', 'nidn')"
                placeholder-kosong="-- Pilih Dosen Wali --"
            />

            <hr class="my-5 border-slate-100">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-3">Akun Login Mahasiswa</p>

            <x-input-field nama="email" label="Email" tipe="email" placeholder="contoh: andika@siakad.test" />
            <x-input-field nama="password" label="Kata Sandi" tipe="password" placeholder="minimal 6 karakter" />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan
                </x-tombol>
                <x-tombol href="{{ route('mahasiswa.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
