<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4">

    <div class="text-center max-w-sm">
        <div class="w-16 h-16 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-4">
            <i data-lucide="shield-x" class="w-8 h-8"></i>
        </div>
        <h1 class="text-3xl font-extrabold text-slate-800">403</h1>
        <p class="text-sm text-slate-500 mt-2 mb-6">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki akses ke halaman ini.' }}
        </p>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white rounded-lg px-4 py-2.5 text-sm font-medium hover:bg-indigo-700 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Dashboard
        </a>
    </div>

<script>lucide.createIcons();</script>
</body>
</html>
