<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;
use App\Services\MahasiswaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function __construct(private MahasiswaService $mahasiswaService)
    {
    }

    public function index(Request $request): View
    {
        $mahasiswas = $this->mahasiswaService->daftarDenganPencarian($request->input('q'));

        return view('mahasiswa.index', ['mahasiswas' => $mahasiswas]);
    }

    public function create(): View
    {
        $dosens = $this->mahasiswaService->semuaDosenUntukDropdown();

        return view('mahasiswa.create', ['dosens' => $dosens]);
    }

    public function store(StoreMahasiswaRequest $request): RedirectResponse
    {
        $this->mahasiswaService->simpanBaruBesertaAkun($request->validated());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        $dosens = $this->mahasiswaService->semuaDosenUntukDropdown();

        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa, 'dosens' => $dosens]);
    }

    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $this->mahasiswaService->perbarui($mahasiswa, $request->validated());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $this->mahasiswaService->hapusBesertaAkun($mahasiswa);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
