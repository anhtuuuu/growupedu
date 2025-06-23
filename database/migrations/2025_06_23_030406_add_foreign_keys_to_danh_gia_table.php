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
        Schema::table('danh_gia', function (Blueprint $table) {
            $table->foreign(['ma_lhp'], 'FK_danh_gia_lop_hoc_phan')->references(['ma_lhp'])->on('lop_hoc_phan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ma_tk'], 'FK_danh_gia_ma_tk')->references(['ma_tk'])->on('sinh_vien')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('danh_gia', function (Blueprint $table) {
            $table->dropForeign('FK_danh_gia_lop_hoc_phan');
            $table->dropForeign('FK_danh_gia_ma_tk');
        });
    }
};
