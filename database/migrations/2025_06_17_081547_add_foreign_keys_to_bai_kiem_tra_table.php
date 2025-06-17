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
        Schema::table('bai_kiem_tra', function (Blueprint $table) {
            $table->foreign(['ma_lhp'], 'FK_bai_kiem_tra_ma_lhp')->references(['ma_lhp'])->on('lop_hoc_phan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bai_kiem_tra', function (Blueprint $table) {
            $table->dropForeign('FK_bai_kiem_tra_ma_lhp');
        });
    }
};
