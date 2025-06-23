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
        Schema::table('chuong', function (Blueprint $table) {
            $table->foreign(['ma_bg'], 'FK_chuong_ma_lhp')->references(['ma_bg'])->on('bai_giang')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chuong', function (Blueprint $table) {
            $table->dropForeign('FK_chuong_ma_lhp');
        });
    }
};
