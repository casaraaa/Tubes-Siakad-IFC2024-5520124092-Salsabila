@props([
    'nama',
    'label',
    'pilihan' => [],
    'nilaiTerpilih' => null,
    'placeholderKosong' => '-- Pilih --',
])

<div class="mb-4">
    <label for="{{ $nama }}" class="block text-sm font-medium text-slate-700 mb-1.5">{{ $label }}</label>

    <select
        name="{{ $nama }}"
        id="{{ $nama }}"
        {{ $attributes->merge(['class' => 'w-full rounded-lg border px-3.5 py-2.5 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 transition '
            . ($errors->has($nama) ? 'border-rose-300 bg-rose-50' : 'border-slate-300')]) }}
    >
        <option value="">{{ $placeholderKosong }}</option>

        @foreach($pilihan as $nilaiOpsi => $labelOpsi)
            <option value="{{ $nilaiOpsi }}" {{ (string) old($nama, $nilaiTerpilih) === (string) $nilaiOpsi ? 'selected' : '' }}>
                {{ $labelOpsi }}
            </option>
        @endforeach
    </select>

    @error($nama)
        <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}
        </p>
    @enderror
</div>
