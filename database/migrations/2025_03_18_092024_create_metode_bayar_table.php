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
        Schema::create('metode_bayar', function (Blueprint $table) {
            $table->id();
            $table->string('metode_pembayaran', 30);
            $table->string('tempat_bayar', 50);
            $table->string('no_rekening', 25);
            $table->string('url_logo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_bayar');
    }
};
