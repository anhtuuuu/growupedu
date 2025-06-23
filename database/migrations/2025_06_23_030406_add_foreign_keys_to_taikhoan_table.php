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
        Schema::table('taikhoan', function (Blueprint $table) {
            $table->foreign(['ma_bm'], 'FK_taikhoan_bo_mon')->references(['ma_bm'])->on('bo_mon')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['vai_tro'], 'FK_taikhoan_vai_tro')->references(['ma_vt'])->on('vai_tro')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taikhoan', function (Blueprint $table) {
            $table->dropForeign('FK_taikhoan_bo_mon');
            $table->dropForeign('FK_taikhoan_vai_tro');
        });
    }
};
