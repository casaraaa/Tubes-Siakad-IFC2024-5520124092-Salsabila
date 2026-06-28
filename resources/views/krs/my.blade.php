@extends('layouts.app')

@section('judul', 'KRS Saya')

@section('konten')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        <div class="lg:col-span-2">
            <x-kartu judul="Mata Kuliah yang Sudah Diambil">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-slate-500 border-b border-slate-100">
                                <th class="py-2.5 pr-4 font-medium">Kode</th>
                                <th class="py-2.5 pr-4 font-medium">Mata Kuliah</th>
                                <th class="py-2.5 pr-4 font-medium">SKS</th>
                                <th class="py-2.5 pr-4 font-medium w-16">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($mahasiswa->mataKuliahDiambil as $mk)
                                <tr>
                                    <td class="py-2.5 pr-4 font-mono text-slate-600">{{ $mk->kode_matakuliah }}</td>
                                    <td class="py-2.5 pr-4">{{ $mk->nama_matakuliah }}</td>
                                    <td class="py-2.5 pr-4">{{ $mk->sks }}</td>
                                    <td class="py-2.5 pr-4">
                                        <x-aksi-hapus
                                            :aksi="route('krs.destroy', $mahasiswa->cariIdKrsUntuk($mk->kode_matakuliah))"
                                            konfirmasi="Drop mata kuliah ini?"
                                        />
                                    </td>
                                </tr>
                            @empty
                                <x-baris-kosong :kolom="4" pesan="Belum mengambil mata kuliah apa pun" />
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <p class="mt-4 text-sm font-semibold text-slate-700">
                    Total SKS diambil: <span class="text-indigo-600">{{ $mahasiswa->total_sks }}</span>
                </p>
            </x-kartu>
        </div>

        <div>
            <x-kartu judul="Ambil Mata Kuliah Baru">
                <form method="POST" action="{{ route('krs.store') }}">
                    @csrf

                    <x-select-field
                        nama="kode_matakuliah"
                        label="Pilih Mata Kuliah"
                        :pilihan="$matakuliahTersedia->mapWithKeys(fn ($mk) => [$mk->kode_matakuliah => $mk->label_pilihan])"
                    />

                    <x-tombol tipe="submit" varian="utama" class="w-full justify-center">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Tambahkan ke KRS
                    </x-tombol>
                </form>
            </x-kartu>
        </div>

    </div>

@endsection
