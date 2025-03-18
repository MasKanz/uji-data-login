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
        Schema::create('jenis_motor', function (Blueprint $table) {
            $table->id();
            $table->string('merk', 50);
            $table->enum('jenis', ['Bebek', 'Skuter', 'Dual Sport', 'Naked Sport', 'Sport Bike', 'Retro', 'Cruiser', 'Sport Touring', 'Dirt Bike', 'Motocross', 'Scrambler', 'ATV', 'Motor Adventure', 'Lainnya']);
            $table->string('deskripsi jenis');
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_motor');
    }
};
