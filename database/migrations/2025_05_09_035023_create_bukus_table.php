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

        Schema::create('bukus', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->foreignId('kategori_id')->constrained();
            $table->foreignId('rak_id')->constrained();
            $table->string('sampul')->nullable();
            $table->string('isbn')->nullable();
            $table->string('judul')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('penulis')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('isi')->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_masuk');
            $table->string('no_induk')->nullable();
            $table->string('rf_id')->nullable();
            $table->string('no_barcode')->nullable();
            $table->string('peroleh')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
