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
        Schema::table('hoc_phan', function (Blueprint $table) {
            $table->foreign(['ma_bm'], 'FK_hocphan_ma_bm')->references(['ma_bm'])->on('bo_mon')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoc_phan', function (Blueprint $table) {
            $table->dropForeign('FK_hocphan_ma_bm');
        });
    }
};
