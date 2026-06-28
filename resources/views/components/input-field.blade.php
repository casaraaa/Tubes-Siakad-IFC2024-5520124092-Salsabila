@props([
    'nama',
    'label',
    'tipe' => 'text',
    'nilai' => null,
    'disabled' => false,
    'placeholder' => null,
])

<div class="mb-4">
    <label for="{{ $nama }}" class="block text-sm font-medium text-slate-700 mb-1.5">{{ $label }}</label>

    <input
        type="{{ $tipe }}"
        name="{{ $nama }}"
        id="{{ $nama }}"
        value="{{ old($nama, $nilai) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($disabled) disabled @endif
        {{ $attributes->merge(['class' => 'w-full rounded-lg border px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 transition '
            . ($errors->has($nama) ? 'border-rose-300 bg-rose-50' : 'border-slate-300 bg-white')
            . ($disabled ? ' bg-slate-100 text-slate-400 cursor-not-allowed' : '')]) }}
    >

    @error($nama)
        <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}
        </p>
    @enderror
</div>
