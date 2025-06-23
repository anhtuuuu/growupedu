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
        Schema::table('nop_bai_kiem_tra', function (Blueprint $table) {
            $table->foreign(['ma_bkt'], 'FK_nop_bai_kiem_tra_ma_bkt')->references(['ma_bkt'])->on('bai_kiem_tra')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ma_tk'], 'FK_nop_bai_kiem_tra_ma_tk')->references(['ma_tk'])->on('sinh_vien')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nop_bai_kiem_tra', function (Blueprint $table) {
            $table->dropForeign('FK_nop_bai_kiem_tra_ma_bkt');
            $table->dropForeign('FK_nop_bai_kiem_tra_ma_tk');
        });
    }
};
