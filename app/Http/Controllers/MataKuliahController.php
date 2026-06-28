<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Models\MataKuliah;
use App\Services\MataKuliahService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function __construct(private MataKuliahService $mataKuliahService)
    {
    }

    public function index(Request $request): View
    {
        $matakuliahs = $this->mataKuliahService->daftarDenganPencarian($request->input('q'));

        return view('matakuliah.index', ['matakuliahs' => $matakuliahs]);
    }

    public function create(): View
    {
        return view('matakuliah.create');
    }

    public function store(StoreMataKuliahRequest $request): RedirectResponse
    {
        $this->mataKuliahService->simpanBaru($request->validated());

        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $matakuliah): View
    {
        return view('matakuliah.edit', ['matakuliah' => $matakuliah]);
    }

    public function update(UpdateMataKuliahRequest $request, MataKuliah $matakuliah): RedirectResponse
    {
        $this->mataKuliahService->perbarui($matakuliah, $request->validated());

        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah): RedirectResponse
    {
        $this->mataKuliahService->hapus($matakuliah);

        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
