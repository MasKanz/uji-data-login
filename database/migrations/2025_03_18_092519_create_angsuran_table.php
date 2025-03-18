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
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kredit');
            $table->foreign('id_kredit')->references('id')->on('kredit')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tgl_bayar');
            $table->integer('angsuran_ke');
            $table->double('total_bayar');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsuran');
    }
};
