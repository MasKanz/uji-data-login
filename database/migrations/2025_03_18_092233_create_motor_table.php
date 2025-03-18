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
        Schema::create('motor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motor', 100)->unique();
            $table->unsignedBigInteger('idjenis');
            $table->foreign('idjenis')->references('id')->on('jenis_motor')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('harga_jual');
            $table->text('deskripsi_motor');
            $table->string('warna', 50);
            $table->string('kapasitas_mesin', 10);
            $table->string('tahun_produksi', 4);
            $table->string('foto1');
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor');
    }
};
