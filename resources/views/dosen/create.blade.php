@extends('layouts.app')

@section('judul', 'Tambah Dosen')

@section('konten')

    <x-kartu judul="Tambah Data Dosen" class="max-w-lg">
        <form method="POST" action="{{ route('dosen.store') }}">
            @csrf

            <x-input-field nama="nidn" label="NIDN (10 digit)" maxlength="10" placeholder="contoh: 1001000004" />
            <x-input-field nama="nama" label="Nama Dosen" placeholder="contoh: Dr. Andi Wijaya, M.Kom" />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan
                </x-tombol>
                <x-tombol href="{{ route('dosen.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
