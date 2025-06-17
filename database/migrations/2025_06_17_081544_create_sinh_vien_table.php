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
        Schema::create('sinh_vien', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('ma_tk')->index('fk_sinh_vien_ma_tk');
            $table->integer('ma_lhp')->index('fk_sinh_vien_ma_lhp');
            $table->timestamp('ngay_tham_gia')->useCurrent();
            $table->integer('tien_do')->nullable();
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinh_vien');
    }
};
