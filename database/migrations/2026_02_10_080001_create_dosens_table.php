<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel master data dosen.
 * NIDN dipakai langsung sebagai primary key (bukan auto increment)
 * karena nilainya unik dan sudah dikeluarkan secara nasional.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->char('nidn', 10)->primary();
            $table->string('nama', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
