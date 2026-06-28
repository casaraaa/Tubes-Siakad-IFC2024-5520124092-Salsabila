@extends('layouts.app')

@section('judul', 'Ubah Dosen')

@section('konten')

    <x-kartu judul="Ubah Data Dosen" class="max-w-lg">
        <form method="POST" action="{{ route('dosen.update', $dosen->nidn) }}">
            @csrf
            @method('PUT')

            <x-input-field nama="nidn" label="NIDN" :nilai="$dosen->nidn" disabled />
            <x-input-field nama="nama" label="Nama Dosen" :nilai="$dosen->nama" />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Perbarui
                </x-tombol>
                <x-tombol href="{{ route('dosen.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
