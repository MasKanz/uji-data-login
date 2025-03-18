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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique();
            $table->dateTime('tgl_kirim');
            $table->dateTime('tgl_tiba');
            $table->enum('status_kirim', ['Sedang Dikirim', 'Tiba Di Tujuan']);
            $table->string('nama_kurir');
            $table->string('telpon_kurir');
            $table->string('bukti_foto');
            $table->text('keterangan');
            $table->unsignedBigInteger('id_kredit');
            $table->foreign('id_kredit')->references('id')->on('kredit')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
