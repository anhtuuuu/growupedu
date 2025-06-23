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
        Schema::table('bo_mon', function (Blueprint $table) {
            $table->foreign(['ma_khoa'], 'FK_ma_khoa')->references(['ma_khoa'])->on('khoa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bo_mon', function (Blueprint $table) {
            $table->dropForeign('FK_ma_khoa');
        });
    }
};
