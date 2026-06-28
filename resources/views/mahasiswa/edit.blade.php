@extends('layouts.app')

@section('judul', 'Ubah Mahasiswa')

@section('konten')

    <x-kartu judul="Ubah Data Mahasiswa">
        <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->npm) }}">
            @csrf
            @method('PUT')

            <x-input-field nama="npm" label="NPM" :nilai="$mahasiswa->npm" disabled />
            <x-input-field nama="nama" label="Nama Mahasiswa" :nilai="$mahasiswa->nama" />

            <x-select-field
                nama="nidn"
                label="Dosen Wali"
                :pilihan="$dosens->pluck('nama', 'nidn')"
                :nilai-terpilih="$mahasiswa->nidn"
                placeholder-kosong="-- Pilih Dosen Wali --"
            />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Perbarui
                </x-tombol>
                <x-tombol href="{{ route('mahasiswa.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
