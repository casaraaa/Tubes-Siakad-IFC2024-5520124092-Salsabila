<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    protected $primaryKey = 'nidn';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nidn',
        'nama',
    ];

    public function mahasiswaBimbingan(): HasMany
    {
        return $this->hasMany(Mahasiswa::class, 'nidn', 'nidn');
    }

    public function jadwalMengajar(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }

    public function scopeCocokDenganKueri(Builder $builder, ?string $kueri): Builder
    {
        if (blank($kueri)) {
            return $builder;
        }

        return $builder->where(function (Builder $sub) use ($kueri) {
            $sub->where('nama', 'like', "%{$kueri}%")
                ->orWhere('nidn', 'like', "%{$kueri}%");
        });
    }

    public function scopeUrutkanNama(Builder $builder): Builder
    {
        return $builder->orderBy('nama');
    }
}
