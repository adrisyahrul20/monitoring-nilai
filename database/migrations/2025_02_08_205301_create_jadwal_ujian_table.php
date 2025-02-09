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
        Schema::create('jadwal_ujian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idmtpelajaran')->nullable();
            $table->foreign('idmtpelajaran')->references('id')->on('mata_pelajaran')->onDelete('set null');
            $table->date('hari_ujian');
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
            $table->unsignedBigInteger('idkelas')->nullable();
            $table->foreign('idkelas')->references('id')->on('kelas')->onDelete('set null');
            $table->unsignedBigInteger('idguru')->nullable();
            $table->foreign('idguru')->references('id')->on('guru')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujian');
    }
};
