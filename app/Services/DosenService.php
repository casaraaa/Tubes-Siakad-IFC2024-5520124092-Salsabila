<?php

namespace App\Services;

use App\Models\Dosen;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Service untuk operasi data Dosen.
 *
 * Controller tidak menyentuh Eloquent secara langsung; semua query
 * dan aturan bisnis terkait Dosen dipusatkan di sini agar mudah
 * diuji dan dipakai ulang.
 */
class DosenService
{
    public function daftarDenganPencarian(?string $kueri, int $perHalaman = 10): LengthAwarePaginator
    {
        return Dosen::query()
            ->cocokDenganKueri($kueri)
            ->urutkanNama()
            ->paginate($perHalaman)
            ->withQueryString();
    }

    public function semuaUntukDropdown()
    {
        return Dosen::query()->urutkanNama()->get();
    }

    public function simpanBaru(array $data): Dosen
    {
        return Dosen::create([
            'nidn' => $data['nidn'],
            'nama' => $data['nama'],
        ]);
    }

    public function perbarui(Dosen $dosen, array $data): Dosen
    {
        $dosen->update([
            'nama' => $data['nama'],
        ]);

        return $dosen;
    }

    public function hapus(Dosen $dosen): void
    {
        $dosen->delete();
    }
}
