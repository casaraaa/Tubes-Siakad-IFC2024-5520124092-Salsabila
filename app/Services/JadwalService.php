<?php

namespace App\Services;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use Illuminate\Pagination\LengthAwarePaginator;

class JadwalService
{
    public function daftarDenganPencarian(?string $kueri, int $perHalaman = 10): LengthAwarePaginator
    {
        return Jadwal::query()
            ->besertaRelasiLengkap()
            ->cocokDenganKueri($kueri)
            ->orderBy('hari')
            ->paginate($perHalaman)
            ->withQueryString();
    }

    public function semuaMataKuliahUntukDropdown()
    {
        return MataKuliah::query()->urutkanNama()->get();
    }

    public function semuaDosenUntukDropdown()
    {
        return Dosen::query()->urutkanNama()->get();
    }

    public function pilihanHari(): array
    {
        return Jadwal::URUTAN_HARI;
    }

    public function simpanBaru(array $data): Jadwal
    {
        return Jadwal::create([
            'kode_matakuliah' => $data['kode_matakuliah'],
            'nidn' => $data['nidn'],
            'kelas' => $data['kelas'],
            'hari' => $data['hari'],
            'jam' => $data['jam'],
        ]);
    }

    public function perbarui(Jadwal $jadwal, array $data): Jadwal
    {
        $jadwal->update([
            'kode_matakuliah' => $data['kode_matakuliah'],
            'nidn' => $data['nidn'],
            'kelas' => $data['kelas'],
            'hari' => $data['hari'],
            'jam' => $data['jam'],
        ]);

        return $jadwal;
    }

    public function hapus(Jadwal $jadwal): void
    {
        $jadwal->delete();
    }
}
