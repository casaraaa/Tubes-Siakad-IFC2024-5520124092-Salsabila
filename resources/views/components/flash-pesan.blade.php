@props(['jenis' => 'berhasil'])

@php
    $berhasil = $jenis === 'berhasil';
    $kelasBorder = $berhasil ? 'border-emerald-200' : 'border-rose-200';
    $kelasBg = $berhasil ? 'bg-emerald-50' : 'bg-rose-50';
    $kelasTeks = $berhasil ? 'text-emerald-700' : 'text-rose-700';
    $ikon = $berhasil ? 'circle-check' : 'circle-x';
@endphp

<div class="mb-4 flex items-start gap-2.5 rounded-xl border {{ $kelasBorder }} {{ $kelasBg }} {{ $kelasTeks }} px-4 py-3 text-sm">
    <i data-lucide="{{ $ikon }}" class="w-4 h-4 mt-0.5 shrink-0"></i>
    <p>{{ $slot }}</p>
</div>
