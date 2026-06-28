<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKrsRequest;
use App\Models\Krs;
use App\Services\KrsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RuntimeException;

class KrsController extends Controller
{
    public function __construct(private KrsService $krsService)
    {
    }

    /**
     * Khusus admin: menampilkan seluruh entri KRS semua mahasiswa.
     */
    public function index(Request $request): View
    {
        $krsList = $this->krsService->daftarSemuaDenganPencarian($request->input('q'));

        return view('krs.index', ['krsList' => $krsList]);
    }

    /**
     * Khusus mahasiswa: menampilkan KRS miliknya sendiri beserta
     * daftar mata kuliah yang masih bisa diambil.
     */
    public function milikSaya(): View
    {
        $pengguna = Auth::user();

        return view('krs.my', [
            'mahasiswa' => $this->krsService->ambilDataMahasiswaBesertaKrs($pengguna->npm),
            'matakuliahTersedia' => $this->krsService->semuaMataKuliahUntukDropdown(),
        ]);
    }

    /**
     * Mahasiswa mengambil satu mata kuliah ke dalam KRS-nya.
     */
    public function store(StoreKrsRequest $request): RedirectResponse
    {
        try {
            $this->krsService->ambilMataKuliah($request->user(), $request->validated()['kode_matakuliah']);
        } catch (RuntimeException $kesalahan) {
            return back()->with('error', $kesalahan->getMessage());
        }

        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    /**
     * Menghapus (drop) entri KRS. Boleh dipanggil admin maupun mahasiswa;
     * validasi kepemilikan ditangani di KrsService.
     */
    public function destroy(Request $request, Krs $krs): RedirectResponse
    {
        try {
            $this->krsService->dropMataKuliah($request->user(), $krs);
        } catch (RuntimeException $kesalahan) {
            abort(403, $kesalahan->getMessage());
        }

        return back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }
}
