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
        Schema::table('bai', function (Blueprint $table) {
            $table->foreign(['ma_chuong'], 'FK_bai_chuong')->references(['ma_chuong'])->on('chuong')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bai', function (Blueprint $table) {
            $table->dropForeign('FK_bai_chuong');
        });
    }
};
