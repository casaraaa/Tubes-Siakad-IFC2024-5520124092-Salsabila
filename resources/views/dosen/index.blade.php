@extends('layouts.app')

@section('judul', 'Data Dosen')

@section('konten')

    <div class="flex items-center justify-between mb-5">
        <x-kotak-pencarian placeholder="Cari nama / NIDN..." />
        <x-tombol href="{{ route('dosen.create') }}" varian="utama">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Dosen
        </x-tombol>
    </div>

    <x-kartu>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="py-2.5 pr-4 font-medium">NIDN</th>
                        <th class="py-2.5 pr-4 font-medium">Nama Dosen</th>
                        <th class="py-2.5 pr-4 font-medium w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($dosens as $dosen)
                        <tr>
                            <td class="py-2.5 pr-4 font-mono text-slate-600">{{ $dosen->nidn }}</td>
                            <td class="py-2.5 pr-4">{{ $dosen->nama }}</td>
                            <td class="py-2.5 pr-4">
                                <div class="flex gap-1.5">
                                    <x-aksi-ubah :href="route('dosen.edit', $dosen->nidn)" />
                                    <x-aksi-hapus :aksi="route('dosen.destroy', $dosen->nidn)" konfirmasi="Hapus data dosen ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-baris-kosong :kolom="3" pesan="Belum ada data dosen" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $dosens->links() }}
        </div>
    </x-kartu>

@endsection
