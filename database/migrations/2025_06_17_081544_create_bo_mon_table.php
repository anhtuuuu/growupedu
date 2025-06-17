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
        Schema::create('bo_mon', function (Blueprint $table) {
            $table->integer('ma_bm', true);
            $table->integer('ma_khoa')->index('fk_ma_khoa');
            $table->string('ten_bm');
            $table->string('alias');
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bo_mon');
    }
};
