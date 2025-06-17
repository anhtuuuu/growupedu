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
        Schema::table('bai_giang', function (Blueprint $table) {
            $table->foreign(['ma_tk'], 'FK_bai_giang_ma_tk')->references(['ma_tk'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bai_giang', function (Blueprint $table) {
            $table->dropForeign('FK_bai_giang_ma_tk');
        });
    }
};
