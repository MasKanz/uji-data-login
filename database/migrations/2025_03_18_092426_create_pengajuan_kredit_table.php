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
        Schema::create('pengajuan_kredit', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengajuan_kredit');
            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_motor');
            $table->foreign('id_motor')->references('id')->on('motor')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('harga_cash');
            $table->integer('dp');
            $table->unsignedBigInteger('id_jenis_cicilan');
            $table->foreign('id_jenis_cicilan')->references('id')->on('jenis_cicilan')->onDelete('cascade')->onUpdate('cascade');
            $table->double('harga_kredit');
            $table->unsignedBigInteger('id_asuransi');
            $table->foreign('id_asuransi')->references('id')->on('asuransi')->onDelete('cascade')->onUpdate('cascade');
            $table->double('biaya_asuransi_perbulan');
            $table->double('cicilan_perbulan');
            $table->string('url_kk');
            $table->string('url_ktp');
            $table->string('url_npwp');
            $table->string('url_slip_gaji');
            $table->string('url_foto');
            $table->enum('status_pengajuan', ['Menunggu Konfirmasi', 'Diproses', 'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 'Diterima']);
            $table->string('keterangan_status_pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kredit');
    }
};
