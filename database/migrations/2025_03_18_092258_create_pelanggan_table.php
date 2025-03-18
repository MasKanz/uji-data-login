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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('email')->unique();
            $table->string('katakunci', 15);
            $table->string('no_telp', 15);
            $table->string('alamat1');
            $table->string('kota1');
            $table->string('propinsi1');
            $table->string('kodepos1');
            $table->string('alamat2')->nullable();
            $table->string('kota2')->nullable();
            $table->string('propinsi2')->nullable();
            $table->string('kodepos2')->nullable();
            $table->string('alamat3')->nullable();
            $table->string('kota3')->nullable();
            $table->string('propinsi3')->nullable();
            $table->string('kodepos3')->nullable();
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
