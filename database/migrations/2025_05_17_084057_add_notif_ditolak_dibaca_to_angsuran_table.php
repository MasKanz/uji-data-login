<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('angsuran', function ($table) {
            $table->boolean('notif_ditolak_dibaca')->default(false)->after('keterangan');
        });
    }

    public function down()
    {
        Schema::table('angsuran', function ($table) {
            $table->dropColumn('notif_ditolak_dibaca');
        });
    }
};
