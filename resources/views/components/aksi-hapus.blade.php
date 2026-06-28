@props(['aksi', 'konfirmasi' => 'Hapus data ini?'])

<form action="{{ $aksi }}" method="POST" onsubmit="return confirm('{{ $konfirmasi }}');" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition" title="Hapus">
        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
    </button>
</form>
