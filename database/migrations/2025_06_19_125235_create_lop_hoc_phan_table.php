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
        Schema::create('lop_hoc_phan', function (Blueprint $table) {
            $table->integer('ma_lhp', true);
            $table->string('ten_lhp');
            $table->string('alias');
            $table->integer('ma_tk')->index('lop_hoc_phan_ma_tk');
            $table->integer('ma_bg')->nullable()->index('lop_hoc_phan_ma_bg');
            $table->integer('ma_hp')->index('lop_hoc_phan_ma_hp');
            $table->string('hinh_anh')->nullable();
            $table->text('mo_ta')->nullable();
            $table->timestamp('ngay_tao')->useCurrent();
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
        Schema::dropIfExists('lop_hoc_phan');
    }
};
