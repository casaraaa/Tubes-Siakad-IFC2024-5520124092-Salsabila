@extends('layouts.app')

@section('judul', 'Jadwal Kuliah')

@section('konten')

    <div class="flex items-center justify-between mb-5">
        <x-kotak-pencarian placeholder="Cari mata kuliah / dosen..." />
        <x-tombol href="{{ route('jadwal.create') }}" varian="utama">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Jadwal
        </x-tombol>
    </div>

    <x-kartu>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="py-2.5 pr-4 font-medium">Mata Kuliah</th>
                        <th class="py-2.5 pr-4 font-medium">Dosen</th>
                        <th class="py-2.5 pr-4 font-medium">Kelas</th>
                        <th class="py-2.5 pr-4 font-medium">Hari</th>
                        <th class="py-2.5 pr-4 font-medium">Jam</th>
                        <th class="py-2.5 pr-4 font-medium w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jadwals as $j)
                        <tr>
                            <td class="py-2.5 pr-4">{{ $j->mataKuliah->nama_matakuliah }}</td>
                            <td class="py-2.5 pr-4 text-slate-500">{{ $j->pengajar->nama }}</td>
                            <td class="py-2.5 pr-4">{{ $j->kelas }}</td>
                            <td class="py-2.5 pr-4">{{ $j->hari }}</td>
                            <td class="py-2.5 pr-4">{{ $j->jam }}</td>
                            <td class="py-2.5 pr-4">
                                <div class="flex gap-1.5">
                                    <x-aksi-ubah :href="route('jadwal.edit', $j->id)" />
                                    <x-aksi-hapus :aksi="route('jadwal.destroy', $j->id)" konfirmasi="Hapus jadwal ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-baris-kosong :kolom="6" pesan="Belum ada jadwal kuliah" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $jadwals->links() }}
        </div>
    </x-kartu>

@endsection
