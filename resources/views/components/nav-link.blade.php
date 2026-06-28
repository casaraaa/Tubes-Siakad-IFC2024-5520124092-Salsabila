@props(['route', 'icon'])

@php
    $aktif = request()->routeIs($route);
@endphp

<a
    href="{{ route(str_contains($route, '*') ? str_replace('.*', '.index', $route) : $route) }}"
    class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition
        {{ $aktif ? 'bg-white/10 text-white font-medium' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}"
>
    <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
    <span>{{ $slot }}</span>
</a>
