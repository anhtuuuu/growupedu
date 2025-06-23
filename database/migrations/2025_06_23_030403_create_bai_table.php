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
        Schema::create('bai', function (Blueprint $table) {
            $table->integer('ma_bai', true);
            $table->integer('ma_chuong')->index('fk_bai_chuong');
            $table->string('tieu_de');
            $table->string('alias');
            $table->text('mo_ta')->nullable();
            $table->text('noi_dung')->nullable();
            $table->text('video')->nullable();
            $table->text('lien_ket')->nullable();
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
        Schema::dropIfExists('bai');
    }
};
