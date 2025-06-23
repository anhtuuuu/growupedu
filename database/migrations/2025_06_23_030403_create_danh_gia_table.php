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
        Schema::create('danh_gia', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('ma_tk')->index('fk_danh_gia_ma_tk');
            $table->integer('ma_lhp')->index('fk_danh_gia_lop_hoc_phan');
            $table->integer('so_sao')->nullable();
            $table->text('noi_dung')->nullable();
            $table->timestamp('ngay_tao')->useCurrent();
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gia');
    }
};
