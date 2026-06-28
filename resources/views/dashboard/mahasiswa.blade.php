@extends('layouts.app')

@section('judul', 'Dashboard Mahasiswa')

@section('konten')

    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-800">Selamat datang, {{ $mahasiswa->nama }} 👋</h2>
        <p class="text-sm text-slate-500 mt-1">Berikut ringkasan informasi akademik Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <x-kartu-statistik label="NPM" :nilai="$mahasiswa->npm" ikon="id-card" warna="indigo" />
        <x-kartu-statistik label="Dosen Wali" :nilai="$mahasiswa->dosenWali->nama ?? '-'" ikon="user-round" warna="emerald" />
        <x-kartu-statistik label="Total SKS Diambil" :nilai="$mahasiswa->total_sks" ikon="layers" warna="amber" />
    </div>

    <x-kartu judul="Jadwal Kuliah Anda">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="py-2.5 pr-4 font-medium">Mata Kuliah</th>
                        <th class="py-2.5 pr-4 font-medium">Dosen</th>
                        <th class="py-2.5 pr-4 font-medium">Kelas</th>
                        <th class="py-2.5 pr-4 font-medium">Hari</th>
                        <th class="py-2.5 pr-4 font-medium">Jam</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jadwalKuliah as $j)
                        <tr>
                            <td class="py-2.5 pr-4">{{ $j->mataKuliah->nama_matakuliah }}</td>
                            <td class="py-2.5 pr-4">{{ $j->pengajar->nama }}</td>
                            <td class="py-2.5 pr-4">{{ $j->kelas }}</td>
                            <td class="py-2.5 pr-4">{{ $j->hari }}</td>
                            <td class="py-2.5 pr-4">{{ $j->jam }}</td>
                        </tr>
                    @empty
                        <x-baris-kosong :kolom="5" pesan="Belum ada jadwal kuliah" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <x-tombol href="{{ route('krs.milikSaya') }}" varian="utama">
                <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                Kelola KRS Saya
            </x-tombol>
        </div>
    </x-kartu>

@endsection
