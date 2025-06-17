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
        Schema::table('sinh_vien', function (Blueprint $table) {
            $table->foreign(['ma_lhp'], 'FK_sinh_vien_ma_lhp')->references(['ma_lhp'])->on('lop_hoc_phan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ma_tk'], 'FK_sinh_vien_ma_tk')->references(['ma_tk'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sinh_vien', function (Blueprint $table) {
            $table->dropForeign('FK_sinh_vien_ma_lhp');
            $table->dropForeign('FK_sinh_vien_ma_tk');
        });
    }
};
