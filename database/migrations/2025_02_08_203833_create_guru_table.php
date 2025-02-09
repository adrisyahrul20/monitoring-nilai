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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique()->index();
            $table->string('nama');
            $table->string('templahir');
            $table->date('tgllahir');
            $table->enum('jk', ['lk', 'pr', 'nd'])->default('nd');
            $table->longText('alamat')->nullable();
            $table->string('nohp');
            $table->string('email');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
