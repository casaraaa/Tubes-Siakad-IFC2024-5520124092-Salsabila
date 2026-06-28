<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model Mahasiswa.
 *
 * @property string $npm
 * @property string|null $nidn
 * @property string $nama
 */
class Mahasiswa extends Model
{
    protected $primaryKey = 'npm';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'npm',
        'nidn',
        'nama',
    ];

    /**
     * Dosen wali / pembimbing akademik mahasiswa.
     */
    public function dosenWali(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    /**
     * Mata kuliah yang sedang/telah diambil mahasiswa (relasi many-to-many via tabel krs).
     */
    public function mataKuliahDiambil(): BelongsToMany
    {
        return $this->belongsToMany(MataKuliah::class, 'krs', 'npm', 'kode_matakuliah')
            ->withTimestamps();
    }

    /**
     * Baris-baris KRS milik mahasiswa ini secara mentah (sebelum di-join ke matakuliah).
     */
    public function entriKrs(): HasMany
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }

    /**
     * Akun login (tabel users) yang terhubung dengan data mahasiswa ini.
     */
    public function akunPengguna(): HasOne
    {
        return $this->hasOne(User::class, 'npm', 'npm');
    }

    /**
     * Total SKS yang sedang diambil mahasiswa saat ini.
     */
    public function getTotalSksAttribute(): int
    {
        return (int) $this->mataKuliahDiambil->sum('sks');
    }

    public function scopeCocokDenganKueri(Builder $builder, ?string $kueri): Builder
    {
        if (blank($kueri)) {
            return $builder;
        }

        return $builder->where(function (Builder $sub) use ($kueri) {
            $sub->where('nama', 'like', "%{$kueri}%")
                ->orWhere('npm', 'like', "%{$kueri}%");
        });
    }

    public function scopeUrutkanNama(Builder $builder): Builder
    {
        return $builder->orderBy('nama');
    }

    public function scopeBesertaRelasiLengkap(Builder $builder): Builder
    {
        return $builder->with(['dosenWali', 'mataKuliahDiambil', 'entriKrs']);
    }

    /**
     * Mencari id baris KRS untuk satu kode mata kuliah tertentu,
     * dari koleksi entriKrs yang sudah di-eager-load (tanpa query tambahan).
     */
    public function cariIdKrsUntuk(string $kodeMatakuliah): ?int
    {
        return $this->entriKrs
            ->firstWhere('kode_matakuliah', $kodeMatakuliah)
            ?->id;
    }
}
