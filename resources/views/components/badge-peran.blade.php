@props(['peran'])

@php
    $gaya = $peran === 'admin'
        ? 'bg-amber-100 text-amber-700'
        : 'bg-emerald-100 text-emerald-700';

    $label = $peran === 'admin' ? 'Admin' : 'Mahasiswa';
@endphp

<span class="inline-block text-[11px] font-semibold px-2 py-0.5 rounded-full {{ $gaya }}">
    {{ $label }}
</span>
