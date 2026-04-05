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
        Schema::table('angsuran', function (Blueprint $table) {
            $table->dateTime('tgl_bayar')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('angsuran', function (Blueprint $table) {
            $table->date('tgl_bayar')->change();
        });
    }
};
