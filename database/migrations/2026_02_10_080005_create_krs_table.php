<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel KRS (Kartu Rencana Studi) — menghubungkan mahasiswa dengan
 * mata kuliah yang diambilnya pada periode berjalan.
 *
 * Kombinasi (npm, kode_matakuliah) dibuat unik agar satu mahasiswa
 * tidak bisa mengambil mata kuliah yang sama dua kali.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->char('npm', 10);
            $table->char('kode_matakuliah', 8);
            $table->timestamps();

            $table->foreign('npm')
                ->references('npm')->on('mahasiswas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kode_matakuliah')
                ->references('kode_matakuliah')->on('matakuliahs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['npm', 'kode_matakuliah'], 'krs_npm_matakuliah_unik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
