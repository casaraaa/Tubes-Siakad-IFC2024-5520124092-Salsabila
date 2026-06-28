<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model User (akun login sistem).
 *
 * Setiap pengguna memiliki peran (role) yang membedakan hak akses:
 * - ROLE_ADMIN: mengelola seluruh data master akademik.
 * - ROLE_MAHASISWA: hanya mengelola KRS miliknya sendiri.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';

    public const ROLE_MAHASISWA = 'mahasiswa';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'npm',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function berperanSebagaiAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function berperanSebagaiMahasiswa(): bool
    {
        return $this->role === self::ROLE_MAHASISWA;
    }

    /**
     * Data mahasiswa terkait (hanya relevan jika role = mahasiswa).
     */
    public function dataMahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }
}
