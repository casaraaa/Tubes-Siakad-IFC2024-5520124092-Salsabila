<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    protected $fillable = [
        'kode_matakuliah',
        'nidn',
        'kelas',
        'hari',
        'jam',
    ];

    public const URUTAN_HARI = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    public function pengajar(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function getRingkasanWaktuAttribute(): string
    {
        $jam = $this->jam instanceof \Carbon\Carbon
            ? $this->jam->format('H:i')
            : substr((string) $this->jam, 0, 5);

        return "{$this->hari}, {$jam} - Kelas {$this->kelas}";
    }

    public function scopeCocokDenganKueri(Builder $builder, ?string $kueri): Builder
    {
        if (blank($kueri)) {
            return $builder;
        }

        return $builder->where(function (Builder $sub) use ($kueri) {
            $sub->whereHas('mataKuliah', fn (Builder $q) => $q->where('nama_matakuliah', 'like', "%{$kueri}%"))
                ->orWhereHas('pengajar', fn (Builder $q) => $q->where('nama', 'like', "%{$kueri}%"));
        });
    }

    public function scopeBesertaRelasiLengkap(Builder $builder): Builder
    {
        return $builder->with(['mataKuliah', 'pengajar']);
    }
}
