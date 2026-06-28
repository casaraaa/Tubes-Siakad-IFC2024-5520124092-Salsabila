@extends('layouts.app')

@section('judul', 'Ubah Mata Kuliah')

@section('konten')

    <x-kartu judul="Ubah Mata Kuliah" class="max-w-lg">
        <form method="POST" action="{{ route('matakuliah.update', $matakuliah->kode_matakuliah) }}">
            @csrf
            @method('PUT')

            <x-input-field nama="kode_matakuliah" label="Kode Mata Kuliah" :nilai="$matakuliah->kode_matakuliah" disabled />
            <x-input-field nama="nama_matakuliah" label="Nama Mata Kuliah" :nilai="$matakuliah->nama_matakuliah" />
            <x-input-field nama="sks" label="SKS" tipe="number" min="1" max="6" :nilai="$matakuliah->sks" />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Perbarui
                </x-tombol>
                <x-tombol href="{{ route('matakuliah.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
