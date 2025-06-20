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
        Schema::table('tuong_tac', function (Blueprint $table) {
            $table->foreign(['ma_bg'], 'FK_tuong_tac_ma_bg')->references(['ma_bg'])->on('bai_giang')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ma_tk'], 'FK_tuong_tac_ma_tk')->references(['ma_tk'])->on('sinh_vien')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tuong_tac', function (Blueprint $table) {
            $table->dropForeign('FK_tuong_tac_ma_bg');
            $table->dropForeign('FK_tuong_tac_ma_tk');
        });
    }
};
