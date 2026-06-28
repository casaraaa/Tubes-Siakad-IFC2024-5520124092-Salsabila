@extends('layouts.app')

@section('judul', 'Tambah Mata Kuliah')

@section('konten')

    <x-kartu judul="Tambah Mata Kuliah" class="max-w-lg">
        <form method="POST" action="{{ route('matakuliah.store') }}">
            @csrf

            <x-input-field nama="kode_matakuliah" label="Kode Mata Kuliah (maks. 8 karakter)" maxlength="8" placeholder="contoh: IF53105" />
            <x-input-field nama="nama_matakuliah" label="Nama Mata Kuliah" placeholder="contoh: Kecerdasan Buatan" />
            <x-input-field nama="sks" label="SKS" tipe="number" min="1" max="6" />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan
                </x-tombol>
                <x-tombol href="{{ route('matakuliah.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
