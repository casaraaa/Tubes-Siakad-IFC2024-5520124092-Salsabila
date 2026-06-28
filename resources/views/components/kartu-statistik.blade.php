@props(['label', 'nilai', 'ikon', 'warna' => 'indigo'])

@php
    $petaWarna = [
        'indigo' => 'bg-indigo-50 text-indigo-600',
        'emerald' => 'bg-emerald-50 text-emerald-600',
        'amber' => 'bg-amber-50 text-amber-600',
        'sky' => 'bg-sky-50 text-sky-600',
        'rose' => 'bg-rose-50 text-rose-600',
    ];
    $kelasIkon = $petaWarna[$warna] ?? $petaWarna['indigo'];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
    <div class="w-11 h-11 rounded-xl {{ $kelasIkon }} flex items-center justify-center shrink-0">
        <i data-lucide="{{ $ikon }}" class="w-5 h-5"></i>
    </div>
    <div>
        <p class="text-2xl font-bold text-slate-800 leading-none">{{ $nilai }}</p>
        <p class="text-xs text-slate-500 mt-1">{{ $label }}</p>
    </div>
</div>
