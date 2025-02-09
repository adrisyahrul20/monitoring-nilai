<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monitoring_nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idmtpelajaran')->nullable();
            $table->foreign('idmtpelajaran')->references('id')->on('mata_pelajaran')->onDelete('set null');
            $table->unsignedBigInteger('idsiswa')->nullable();
            $table->foreign('idsiswa')->references('id')->on('siswa')->onDelete('set null');
            $table->enum('semester', ['ganjil', 'genap'])->default('ganjil');
            $table->decimal('nilai', 4, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_nilai');
    }
};
