<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PastikanPeranPengguna
{
    public function handle(Request $request, Closure $next, string ...$peranYangDiizinkan): Response
    {
        $pengguna = $request->user();

        $lolos = $pengguna && in_array($pengguna->role, $peranYangDiizinkan, true);

        abort_unless($lolos, 403, 'Anda tidak memiliki akses ke halaman ini.');

        return $next($request);
    }
}
