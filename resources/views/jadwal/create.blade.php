@extends('layouts.app')

@section('judul', 'Tambah Jadwal')

@section('konten')

    <x-kartu judul="Tambah Jadwal Kuliah" class="max-w-lg">
        <form method="POST" action="{{ route('jadwal.store') }}">
            @csrf

            <x-select-field
                nama="kode_matakuliah"
                label="Mata Kuliah"
                :pilihan="$matakuliahs->pluck('nama_matakuliah', 'kode_matakuliah')"
                placeholder-kosong="-- Pilih Mata Kuliah --"
            />

            <x-select-field
                nama="nidn"
                label="Dosen Pengajar"
                :pilihan="$dosens->pluck('nama', 'nidn')"
                placeholder-kosong="-- Pilih Dosen --"
            />

            <x-input-field nama="kelas" label="Kelas" maxlength="1" placeholder="A / B / C" />

            <x-select-field
                nama="hari"
                label="Hari"
                :pilihan="array_combine($hariOptions, $hariOptions)"
                placeholder-kosong="-- Pilih Hari --"
            />

            <x-input-field nama="jam" label="Jam" tipe="time" />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan
                </x-tombol>
                <x-tombol href="{{ route('jadwal.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
