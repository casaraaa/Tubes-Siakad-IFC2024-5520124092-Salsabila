<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel master data mahasiswa.
 * Setiap mahasiswa dapat memiliki satu dosen wali (opsional).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->char('npm', 10)->primary();
            $table->char('nidn', 10)->nullable();
            $table->string('nama', 50);
            $table->timestamps();

            $table->foreign('nidn')
                ->references('nidn')->on('dosens')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
