@extends('layouts.app')

@section('judul', 'Data Mahasiswa')

@section('konten')

    <div class="flex items-center justify-between mb-5">
        <x-kotak-pencarian placeholder="Cari nama / NPM..." />
        <x-tombol href="{{ route('mahasiswa.create') }}" varian="utama">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Mahasiswa
        </x-tombol>
    </div>

    <x-kartu>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="py-2.5 pr-4 font-medium">NPM</th>
                        <th class="py-2.5 pr-4 font-medium">Nama Mahasiswa</th>
                        <th class="py-2.5 pr-4 font-medium">Dosen Wali</th>
                        <th class="py-2.5 pr-4 font-medium w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($mahasiswas as $m)
                        <tr>
                            <td class="py-2.5 pr-4 font-mono text-slate-600">{{ $m->npm }}</td>
                            <td class="py-2.5 pr-4">{{ $m->nama }}</td>
                            <td class="py-2.5 pr-4 text-slate-500">{{ $m->dosenWali->nama ?? '-' }}</td>
                            <td class="py-2.5 pr-4">
                                <div class="flex gap-1.5">
                                    <x-aksi-ubah :href="route('mahasiswa.edit', $m->npm)" />
                                    <x-aksi-hapus :aksi="route('mahasiswa.destroy', $m->npm)" konfirmasi="Hapus data mahasiswa ini? Akun login terkait juga akan terhapus." />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-baris-kosong :kolom="4" pesan="Belum ada data mahasiswa" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $mahasiswas->links() }}
        </div>
    </x-kartu>

@endsection
