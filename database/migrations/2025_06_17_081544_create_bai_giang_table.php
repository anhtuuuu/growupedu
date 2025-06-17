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
        Schema::create('bai_giang', function (Blueprint $table) {
            $table->integer('ma_bg', true);
            $table->integer('ma_tk')->index('fk_bai_giang_ma_tk');
            $table->string('ten_bg');
            $table->string('alias');
            $table->text('mo_ta')->nullable();
            $table->boolean('hien_thi')->nullable()->default(true);
            $table->boolean('trang_thai')->nullable()->default(true);
            $table->boolean('thong_bao')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_giang');
    }
};
