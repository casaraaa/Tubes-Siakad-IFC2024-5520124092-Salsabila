<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use App\Models\Jadwal;
use App\Services\JadwalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function __construct(private JadwalService $jadwalService)
    {
    }

    public function index(Request $request): View
    {
        $jadwals = $this->jadwalService->daftarDenganPencarian($request->input('q'));

        return view('jadwal.index', ['jadwals' => $jadwals]);
    }

    public function create(): View
    {
        return view('jadwal.create', $this->dataPendukungForm());
    }

    public function store(StoreJadwalRequest $request): RedirectResponse
    {
        $this->jadwalService->simpanBaru($request->validated());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal): View
    {
        return view('jadwal.edit', array_merge(
            ['jadwal' => $jadwal],
            $this->dataPendukungForm()
        ));
    }

    public function update(UpdateJadwalRequest $request, Jadwal $jadwal): RedirectResponse
    {
        $this->jadwalService->perbarui($jadwal, $request->validated());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal): RedirectResponse
    {
        $this->jadwalService->hapus($jadwal);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Data dropdown (mata kuliah, dosen, pilihan hari) yang dipakai
     * bersama oleh form create dan edit.
     */
    private function dataPendukungForm(): array
    {
        return [
            'matakuliahs' => $this->jadwalService->semuaMataKuliahUntukDropdown(),
            'dosens' => $this->jadwalService->semuaDosenUntukDropdown(),
            'hariOptions' => $this->jadwalService->pilihanHari(),
        ];
    }
}
