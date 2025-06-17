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
        Schema::create('chuong', function (Blueprint $table) {
            $table->integer('chuong', true);
            $table->integer('ma_bg')->index('fk_chuong_ma_lhp');
            $table->string('ten_chuong');
            $table->string('alias');
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->nullable()->default(true);
            $table->boolean('thong_bao')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuong');
    }
};
