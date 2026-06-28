@extends('layouts.app')

@section('judul', 'Ubah Jadwal')

@section('konten')

    <x-kartu judul="Ubah Jadwal Kuliah" class="max-w-lg">
        <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}">
            @csrf
            @method('PUT')

            <x-select-field
                nama="kode_matakuliah"
                label="Mata Kuliah"
                :pilihan="$matakuliahs->pluck('nama_matakuliah', 'kode_matakuliah')"
                :nilai-terpilih="$jadwal->kode_matakuliah"
            />

            <x-select-field
                nama="nidn"
                label="Dosen Pengajar"
                :pilihan="$dosens->pluck('nama', 'nidn')"
                :nilai-terpilih="$jadwal->nidn"
            />

            <x-input-field nama="kelas" label="Kelas" maxlength="1" :nilai="$jadwal->kelas" />

            <x-select-field
                nama="hari"
                label="Hari"
                :pilihan="array_combine($hariOptions, $hariOptions)"
                :nilai-terpilih="$jadwal->hari"
            />

            <x-input-field
                nama="jam"
                label="Jam"
                tipe="time"
                :nilai="\Illuminate\Support\Carbon::parse($jadwal->jam)->format('H:i')"
            />

            <div class="flex gap-2 pt-2">
                <x-tombol tipe="submit" varian="utama">
                    <i data-lucide="save" class="w-4 h-4"></i> Perbarui
                </x-tombol>
                <x-tombol href="{{ route('jadwal.index') }}" varian="netral">Batal</x-tombol>
            </div>
        </form>
    </x-kartu>

@endsection
