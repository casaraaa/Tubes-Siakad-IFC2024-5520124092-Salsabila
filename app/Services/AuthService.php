<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Service yang menangani proses autentikasi pengguna.
 * Dipisah dari controller agar AuthController hanya bertugas
 * menjembatani HTTP request <-> service, tanpa logic bisnis di dalamnya.
 */
class AuthService
{
    /**
     * Mencoba melakukan login berdasarkan kredensial yang diberikan.
     *
     * @return bool true jika berhasil login, false jika gagal.
     */
    public function tryLogin(Request $request, array $credentials, bool $remember = false): bool
    {
        $berhasil = Auth::attempt($credentials, $remember);

        if ($berhasil) {
            $request->session()->regenerate();
        }

        return $berhasil;
    }

    /**
     * Mengakhiri sesi pengguna yang sedang login.
     */
    public function logout(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /**
     * Mengambil user yang sedang login, atau null jika tidak ada.
     */
    public function currentUser(): ?User
    {
        return Auth::user();
    }
}
