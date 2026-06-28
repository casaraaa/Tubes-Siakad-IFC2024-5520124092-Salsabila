<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Models\Dosen;
use App\Services\DosenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function __construct(private DosenService $dosenService)
    {
    }

    public function index(Request $request): View
    {
        $dosens = $this->dosenService->daftarDenganPencarian($request->input('q'));

        return view('dosen.index', ['dosens' => $dosens]);
    }

    public function create(): View
    {
        return view('dosen.create');
    }

    public function store(StoreDosenRequest $request): RedirectResponse
    {
        $this->dosenService->simpanBaru($request->validated());

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen): View
    {
        return view('dosen.edit', ['dosen' => $dosen]);
    }

    public function update(UpdateDosenRequest $request, Dosen $dosen): RedirectResponse
    {
        $this->dosenService->perbarui($dosen, $request->validated());

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen): RedirectResponse
    {
        $this->dosenService->hapus($dosen);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}
