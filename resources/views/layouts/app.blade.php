<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'SIAKAD Akademik')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">
<div class="flex min-h-screen">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="w-64 bg-gradient-to-b from-indigo-950 to-indigo-900 text-indigo-100 flex flex-col shrink-0">
        <div class="px-6 py-6 border-b border-indigo-800/60">
            <p class="text-lg font-extrabold text-white tracking-tight flex items-center gap-2">
                <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                SIAKAD
            </p>
            <p class="text-xs text-indigo-300 mt-0.5">Sistem Informasi Akademik</p>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
            <x-nav-link route="dashboard" icon="layout-dashboard">Dashboard</x-nav-link>

            @auth
                @if(auth()->user()->berperanSebagaiAdmin())
                    <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-indigo-400 font-semibold">Data Master</p>
                    <x-nav-link route="dosen.*" icon="user-round">Dosen</x-nav-link>
                    <x-nav-link route="mahasiswa.*" icon="users">Mahasiswa</x-nav-link>
                    <x-nav-link route="matakuliah.*" icon="book-open">Mata Kuliah</x-nav-link>
                    <x-nav-link route="jadwal.*" icon="calendar-clock">Jadwal Kuliah</x-nav-link>

                    <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-indigo-400 font-semibold">Akademik</p>
                    <x-nav-link route="krs.index" icon="clipboard-list">Rekap KRS</x-nav-link>
                @else
                    <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-indigo-400 font-semibold">Akademik</p>
                    <x-nav-link route="krs.milikSaya" icon="clipboard-list">KRS Saya</x-nav-link>
                @endif
            @endauth
        </nav>

        <div class="px-3 py-4 border-t border-indigo-800/60">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-indigo-200 hover:bg-rose-500/20 hover:text-rose-200 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Keluar
                    </button>
                </form>
            @endauth
        </div>
    </aside>

    {{-- ===================== KONTEN ===================== --}}
    <div class="flex-1 flex flex-col min-w-0">

        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shrink-0">
            <h1 class="text-base font-semibold text-slate-700">@yield('judul', 'Dashboard')</h1>

            @auth
                <div class="flex items-center gap-3">
                    <div class="text-right leading-tight">
                        <p class="text-sm font-medium text-slate-700">{{ auth()->user()->name }}</p>
                        <x-badge-peran :peran="auth()->user()->role" />
                    </div>
                    <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            @endauth
        </header>

        <main class="flex-1 p-6">
            @if(session('success'))
                <x-flash-pesan jenis="berhasil">{{ session('success') }}</x-flash-pesan>
            @endif

            @if(session('error'))
                <x-flash-pesan jenis="gagal">{{ session('error') }}</x-flash-pesan>
            @endif

            @yield('konten')
        </main>
    </div>
</div>

<script>lucide.createIcons();</script>
@stack('skrip')
</body>
</html>
