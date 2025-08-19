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
        Schema::disableForeignKeyConstraints();

        Schema::create('pinjams', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('nama')->nullable();
            $table->integer('status');
            $table->date('tgl_pinjam')->nullable();
            $table->integer('lama_pinjam')->nullable();
            $table->date('tgl_balik')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('denda')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};
