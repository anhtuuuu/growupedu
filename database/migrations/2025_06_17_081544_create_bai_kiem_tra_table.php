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
        Schema::create('bai_kiem_tra', function (Blueprint $table) {
            $table->integer('ma_bkt', true);
            $table->integer('ma_lhp')->index('fk_bai_kiem_tra_ma_lhp');
            $table->string('tieu_de');
            $table->longText('noi_dung');
            $table->string('dap_an');
            $table->timestamp('ngay_tao')->useCurrent();
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_kiem_tra');
    }
};
