@props(['judul' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl border border-slate-200 shadow-sm']) }}>
    @if($judul)
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-700">{{ $judul }}</h2>
        </div>
    @endif

    <div class="p-5">
        {{ $slot }}
    </div>
</div>
