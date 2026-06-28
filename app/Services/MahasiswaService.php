<?php

namespace App\Services;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaService
{
    public function daftarDenganPencarian(?string $kueri, int $perHalaman = 10): LengthAwarePaginator
    {
        return Mahasiswa::query()
            ->with('dosenWali')
            ->cocokDenganKueri($kueri)
            ->urutkanNama()
            ->paginate($perHalaman)
            ->withQueryString();
    }

    public function semuaDosenUntukDropdown()
    {
        return Dosen::query()->urutkanNama()->get();
    }

    /**
     * Menyimpan data mahasiswa baru sekaligus akun login-nya.
     * Dibungkus transaksi supaya kedua tabel konsisten — jika salah satu
     * gagal disimpan, keduanya dibatalkan.
     */
    public function simpanBaruBesertaAkun(array $data): Mahasiswa
    {
        return DB::transaction(function () use ($data) {
            $mahasiswa = Mahasiswa::create([
                'npm' => $data['npm'],
                'nama' => $data['nama'],
                'nidn' => $data['nidn'] ?? null,
            ]);

            User::create([
                'name' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => User::ROLE_MAHASISWA,
                'npm' => $data['npm'],
            ]);

            return $mahasiswa;
        });
    }

    public function perbarui(Mahasiswa $mahasiswa, array $data): Mahasiswa
    {
        $mahasiswa->update([
            'nama' => $data['nama'],
            'nidn' => $data['nidn'] ?? null,
        ]);

        return $mahasiswa;
    }

    /**
     * Menghapus mahasiswa beserta akun login terkaitnya.
     */
    public function hapusBesertaAkun(Mahasiswa $mahasiswa): void
    {
        DB::transaction(function () use ($mahasiswa) {
            $mahasiswa->akunPengguna()->delete();
            $mahasiswa->delete();
        });
    }
}
