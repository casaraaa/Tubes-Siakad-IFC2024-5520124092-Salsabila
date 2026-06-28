@extends('layouts.app')

@section('judul', 'Data Mata Kuliah')

@section('konten')

    <div class="flex items-center justify-between mb-5">
        <x-kotak-pencarian placeholder="Cari nama / kode..." />
        <x-tombol href="{{ route('matakuliah.create') }}" varian="utama">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Mata Kuliah
        </x-tombol>
    </div>

    <x-kartu>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="py-2.5 pr-4 font-medium">Kode</th>
                        <th class="py-2.5 pr-4 font-medium">Nama Mata Kuliah</th>
                        <th class="py-2.5 pr-4 font-medium">SKS</th>
                        <th class="py-2.5 pr-4 font-medium w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($matakuliahs as $mk)
                        <tr>
                            <td class="py-2.5 pr-4 font-mono text-slate-600">{{ $mk->kode_matakuliah }}</td>
                            <td class="py-2.5 pr-4">{{ $mk->nama_matakuliah }}</td>
                            <td class="py-2.5 pr-4">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-indigo-50 text-indigo-600 text-xs font-semibold">
                                    {{ $mk->sks }}
                                </span>
                            </td>
                            <td class="py-2.5 pr-4">
                                <div class="flex gap-1.5">
                                    <x-aksi-ubah :href="route('matakuliah.edit', $mk->kode_matakuliah)" />
                                    <x-aksi-hapus :aksi="route('matakuliah.destroy', $mk->kode_matakuliah)" konfirmasi="Hapus mata kuliah ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-baris-kosong :kolom="4" pesan="Belum ada data mata kuliah" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $matakuliahs->links() }}
        </div>
    </x-kartu>

@endsection
