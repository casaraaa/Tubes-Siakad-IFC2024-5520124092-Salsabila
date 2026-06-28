<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model MataKuliah.
 *
 * @property string $kode_matakuliah
 * @property string $nama_matakuliah
 * @property int $sks
 */
class MataKuliah extends Model
{
    protected $table = 'matakuliahs';

    protected $primaryKey = 'kode_matakuliah';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
    ];

    /**
     * Jadwal-jadwal yang terkait dengan mata kuliah ini.
     */
    public function jadwalTerkait(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
     * Mahasiswa-mahasiswa yang mengambil mata kuliah ini (relasi melalui tabel krs).
     */
    public function pesertaKrs(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs', 'kode_matakuliah', 'npm')
            ->withTimestamps();
    }

    /**
     * Label tampilan gabungan kode + nama, dipakai pada dropdown form.
     */
    public function getLabelPilihanAttribute(): string
    {
        return "{$this->nama_matakuliah} ({$this->sks} SKS)";
    }

    public function scopeCocokDenganKueri(Builder $builder, ?string $kueri): Builder
    {
        if (blank($kueri)) {
            return $builder;
        }

        return $builder->where(function (Builder $sub) use ($kueri) {
            $sub->where('nama_matakuliah', 'like', "%{$kueri}%")
                ->orWhere('kode_matakuliah', 'like', "%{$kueri}%");
        });
    }

    public function scopeUrutkanNama(Builder $builder): Builder
    {
        return $builder->orderBy('nama_matakuliah');
    }
}
