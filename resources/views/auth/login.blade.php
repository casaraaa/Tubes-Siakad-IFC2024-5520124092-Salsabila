<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SIAKAD Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-950 via-indigo-900 to-slate-900 flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        <div class="text-center mb-6">
            <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mx-auto mb-3">
                <i data-lucide="graduation-cap" class="w-7 h-7 text-white"></i>
            </div>
            <h1 class="text-white font-bold text-lg">SIAKAD Akademik</h1>
            <p class="text-indigo-300 text-sm mt-0.5">Sistem Informasi Akademik Kampus</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6">
            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    @foreach ($errors->all() as $kesalahan)
                        <p>{{ $kesalahan }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" required
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500">
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    Ingat saya di perangkat ini
                </label>

                <button type="submit" class="w-full bg-indigo-600 text-white rounded-lg py-2.5 text-sm font-medium hover:bg-indigo-700 transition">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center text-indigo-400 text-xs mt-5">&copy; {{ date('Y') }} SIAKAD Akademik — Tugas Besar Pemrograman Web</p>
    </div>

<script>lucide.createIcons();</script>
</body>
</html>
