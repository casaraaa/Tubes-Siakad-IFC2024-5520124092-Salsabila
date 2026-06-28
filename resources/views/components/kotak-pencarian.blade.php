@props(['placeholder' => 'Cari...'])

<form method="GET" class="relative w-full max-w-xs">
    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
    <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="{{ $placeholder }}"
        class="w-full rounded-lg border border-slate-300 bg-white pl-9 pr-3 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 transition"
    >
</form>
