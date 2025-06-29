<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id('id_masuk');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah');
            $table->date('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
