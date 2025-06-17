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
        Schema::table('lop_hoc_phan', function (Blueprint $table) {
            $table->foreign(['ma_hp'], 'lop_hoc_phan_ma_hp')->references(['ma_hp'])->on('hoc_phan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ma_tk'], 'lop_hoc_phan_ma_tk')->references(['ma_tk'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lop_hoc_phan', function (Blueprint $table) {
            $table->dropForeign('lop_hoc_phan_ma_hp');
            $table->dropForeign('lop_hoc_phan_ma_tk');
        });
    }
};
