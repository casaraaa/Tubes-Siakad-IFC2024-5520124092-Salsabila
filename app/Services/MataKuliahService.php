<?php

namespace App\Services;

use App\Models\MataKuliah;
use Illuminate\Pagination\LengthAwarePaginator;

class MataKuliahService
{
    public function daftarDenganPencarian(?string $kueri, int $perHalaman = 10): LengthAwarePaginator
    {
        return MataKuliah::query()
            ->cocokDenganKueri($kueri)
            ->urutkanNama()
            ->paginate($perHalaman)
            ->withQueryString();
    }

    public function semuaUntukDropdown()
    {
        return MataKuliah::query()->urutkanNama()->get();
    }

    public function simpanBaru(array $data): MataKuliah
    {
        return MataKuliah::create([
            'kode_matakuliah' => $data['kode_matakuliah'],
            'nama_matakuliah' => $data['nama_matakuliah'],
            'sks' => $data['sks'],
        ]);
    }

    public function perbarui(MataKuliah $mataKuliah, array $data): MataKuliah
    {
        $mataKuliah->update([
            'nama_matakuliah' => $data['nama_matakuliah'],
            'sks' => $data['sks'],
        ]);

        return $mataKuliah;
    }

    public function hapus(MataKuliah $mataKuliah): void
    {
        $mataKuliah->delete();
    }
}
