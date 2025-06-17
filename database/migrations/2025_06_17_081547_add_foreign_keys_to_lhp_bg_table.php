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
        Schema::table('lhp_bg', function (Blueprint $table) {
            $table->foreign(['ma_bg'], 'FK_LHP_BG_ma_bg')->references(['ma_bg'])->on('bai_giang')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ma_lhp'], 'FK_LHP_BG_ma_lhp')->references(['ma_lhp'])->on('lop_hoc_phan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lhp_bg', function (Blueprint $table) {
            $table->dropForeign('FK_LHP_BG_ma_bg');
            $table->dropForeign('FK_LHP_BG_ma_lhp');
        });
    }
};
