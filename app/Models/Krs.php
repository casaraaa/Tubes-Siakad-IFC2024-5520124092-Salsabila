<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'npm',
        'kode_matakuliah',
    ];

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
     * Apakah entri KRS ini dimiliki oleh user yang diberikan?
     */
    public function dimilikiOleh(User $user): bool
    {
        return $this->npm === $user->npm;
    }

    public function scopeMilikMahasiswa(Builder $builder, string $npm): Builder
    {
        return $builder->where('npm', $npm);
    }

    public function scopeUntukMataKuliah(Builder $builder, string $kodeMatakuliah): Builder
    {
        return $builder->where('kode_matakuliah', $kodeMatakuliah);
    }

    public function scopeCocokDenganKueri(Builder $builder, ?string $kueri): Builder
    {
        if (blank($kueri)) {
            return $builder;
        }

        return $builder->whereHas('pemilik', function (Builder $sub) use ($kueri) {
            $sub->where('nama', 'like', "%{$kueri}%")
                ->orWhere('npm', 'like', "%{$kueri}%");
        });
    }

    public function scopeBesertaRelasiLengkap(Builder $builder): Builder
    {
        return $builder->with(['pemilik', 'mataKuliah']);
    }
}
