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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique()->index();
            $table->string('nama');
            $table->string('templahir');
            $table->date('tgllahir');
            $table->enum('jk', ['lk', 'pr', 'nd'])->default('nd');
            $table->longText('alamat')->nullable();
            $table->unsignedBigInteger('idkelas')->nullable();
            $table->foreign('idkelas')->references('id')->on('kelas')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
