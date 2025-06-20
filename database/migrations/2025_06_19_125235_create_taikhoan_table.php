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
        Schema::create('taikhoan', function (Blueprint $table) {
            $table->integer('ma_tk', true);
            $table->integer('ma_bm')->default(0)->index('fk_taikhoan_bo_mon');
            $table->string('ho_ten', 100);
            $table->string('username', 50)->unique('username');
            $table->string('password');
            $table->string('email', 100)->unique('email');
            $table->string('gioi_tinh', 3)->nullable();
            $table->string('hinh_anh')->nullable();
            $table->timestamp('nam_sinh')->useCurrentOnUpdate()->useCurrent();
            $table->string('sdt')->nullable();
            $table->string('lien_ket')->nullable();
            $table->timestamp('ngay_tao')->useCurrent();
            $table->integer('vai_tro')->index('fk_taikhoan_vai_tro');
            $table->boolean('trang_thai_dang_nhap')->nullable()->default(false);
            $table->boolean('kich_hoat')->nullable()->default(false);
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taikhoan');
    }
};
