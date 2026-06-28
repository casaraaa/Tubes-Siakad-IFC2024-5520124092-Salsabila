@props(['kolom' => 1, 'pesan' => 'Belum ada data'])

<tr>
    <td colspan="{{ $kolom }}" class="text-center text-sm text-slate-400 py-10">
        <div class="flex flex-col items-center gap-2">
            <i data-lucide="inbox" class="w-7 h-7 text-slate-300"></i>
            {{ $pesan }}
        </div>
    </td>
</tr>
