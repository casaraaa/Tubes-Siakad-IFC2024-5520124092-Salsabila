@extends('layouts.app')

@section('judul', 'Rekap KRS')

@section('konten')

    <div class="mb-5">
        <x-kotak-pencarian placeholder="Cari nama / NPM mahasiswa..." />
    </div>

    <x-kartu>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="py-2.5 pr-4 font-medium">NPM</th>
                        <th class="py-2.5 pr-4 font-medium">Nama Mahasiswa</th>
                        <th class="py-2.5 pr-4 font-medium">Mata Kuliah</th>
                        <th class="py-2.5 pr-4 font-medium">SKS</th>
                        <th class="py-2.5 pr-4 font-medium w-16">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($krsList as $k)
                        <tr>
                            <td class="py-2.5 pr-4 font-mono text-slate-600">{{ $k->npm }}</td>
                            <td class="py-2.5 pr-4">{{ $k->pemilik->nama ?? '-' }}</td>
                            <td class="py-2.5 pr-4">{{ $k->mataKuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="py-2.5 pr-4">{{ $k->mataKuliah->sks ?? '-' }}</td>
                            <td class="py-2.5 pr-4">
                                <x-aksi-hapus :aksi="route('krs.destroy', $k->id)" konfirmasi="Hapus data KRS ini?" />
                            </td>
                        </tr>
                    @empty
                        <x-baris-kosong :kolom="5" pesan="Belum ada data KRS" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $krsList->links() }}
        </div>
    </x-kartu>

@endsection
