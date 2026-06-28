<?php

namespace App\Services;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use RuntimeException;

class KrsService
{
    /**
     * Untuk admin: melihat seluruh entri KRS semua mahasiswa.
     */
    public function daftarSemuaDenganPencarian(?string $kueri, int $perHalaman = 10): LengthAwarePaginator
    {
        return Krs::query()
            ->besertaRelasiLengkap()
            ->cocokDenganKueri($kueri)
            ->orderBy('npm')
            ->paginate($perHalaman)
            ->withQueryString();
    }

    public function ambilDataMahasiswaBesertaKrs(string $npm): Mahasiswa
    {
        return Mahasiswa::query()
            ->besertaRelasiLengkap()
            ->findOrFail($npm);
    }

    public function semuaMataKuliahUntukDropdown()
    {
        return MataKuliah::query()->urutkanNama()->get();
    }

    /**
     * Mahasiswa mengambil satu mata kuliah baru ke dalam KRS-nya.
     *
     * @throws RuntimeException jika mata kuliah tersebut sudah pernah diambil.
     */
    public function ambilMataKuliah(User $user, string $kodeMatakuliah): Krs
    {
        $sudahDiambil = Krs::query()
            ->milikMahasiswa($user->npm)
            ->untukMataKuliah($kodeMatakuliah)
            ->exists();

        if ($sudahDiambil) {
            throw new RuntimeException('Mata kuliah ini sudah diambil sebelumnya.');
        }

        return Krs::create([
            'npm' => $user->npm,
            'kode_matakuliah' => $kodeMatakuliah,
        ]);
    }

    /**
     * Menghapus (drop) entri KRS, dengan validasi kepemilikan untuk
     * pengguna berperan mahasiswa. Admin diperbolehkan menghapus entri siapa pun.
     *
     * @throws RuntimeException jika mahasiswa mencoba menghapus KRS milik orang lain.
     */
    public function dropMataKuliah(User $user, Krs $krs): void
    {
        if ($user->berperanSebagaiMahasiswa() && ! $krs->dimilikiOleh($user)) {
            throw new RuntimeException('Anda tidak dapat menghapus KRS milik mahasiswa lain.');
        }

        $krs->delete();
    }
}
