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
        Schema::create('kredit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengajuan_kredit');
            $table->foreign('id_pengajuan_kredit')->references('id')->on('pengajuan_kredit')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_metode_bayar');
            $table->foreign('id_metode_bayar')->references('id')->on('metode_bayar')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tgl_mulai_kredit');
            $table->date('tgl_selesai_kredit');
            $table->double('sisa_kredit');
            $table->enum('status_kredit', ['Dicicil', 'Macet', 'Lunas']);
            $table->string('keterangan_status_kredit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredit');
    }
};
