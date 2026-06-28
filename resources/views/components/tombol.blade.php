@props([
    'varian' => 'utama',
    'tipe' => 'button',
    'href' => null,
])

@php
    $kelasDasar = 'inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2.5 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-1';

    $kelasVarian = match ($varian) {
        'utama' => 'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-400',
        'netral' => 'bg-slate-100 text-slate-600 hover:bg-slate-200 focus:ring-slate-300',
        'bahaya' => 'bg-rose-50 text-rose-600 hover:bg-rose-100 focus:ring-rose-300',
        default => 'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-400',
    };
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$kelasDasar $kelasVarian"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $tipe }}" {{ $attributes->merge(['class' => "$kelasDasar $kelasVarian"]) }}>
        {{ $slot }}
    </button>
@endif
