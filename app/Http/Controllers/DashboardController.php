<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user();

        return $pengguna->berperanSebagaiAdmin()
            ? $this->tampilkanDashboardAdmin()
            : $this->tampilkanDashboardMahasiswa($pengguna->npm);
    }

    private function tampilkanDashboardAdmin(): View
    {
        $statistik = [
            'total_dosen' => Dosen::count(),
            'total_mahasiswa' => Mahasiswa::count(),
            'total_matakuliah' => MataKuliah::count(),
            'total_jadwal' => Jadwal::count(),
            'total_krs' => Krs::count(),
        ];

        return view('dashboard.admin', ['statistik' => $statistik]);
    }

    private function tampilkanDashboardMahasiswa(string $npm): View
    {
        $mahasiswa = Mahasiswa::query()->besertaRelasiLengkap()->find($npm);

        $kodeMatakuliahDiambil = $mahasiswa?->mataKuliahDiambil->pluck('kode_matakuliah') ?? collect();

        $jadwalKuliah = Jadwal::query()
            ->besertaRelasiLengkap()
            ->whereIn('kode_matakuliah', $kodeMatakuliahDiambil)
            ->get();

        return view('dashboard.mahasiswa', [
            'mahasiswa' => $mahasiswa,
            'jadwalKuliah' => $jadwalKuliah,
        ]);
    }
}
