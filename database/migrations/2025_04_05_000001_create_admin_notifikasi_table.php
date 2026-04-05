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
        Schema::create('admin_notifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengajuan_kredit');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('judul');
            $table->text('pesan');
            $table->string('tipe')->default('pengajuan'); // pengajuan, pembayaran, pengiriman
            $table->boolean('dibaca')->default(false);
            $table->timestamps();

            $table->foreign('id_pengajuan_kredit')->references('id')->on('pengajuan_kredit')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_notifikasi');
    }
};
