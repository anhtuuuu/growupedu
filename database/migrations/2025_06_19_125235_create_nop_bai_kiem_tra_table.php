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
        Schema::create('nop_bai_kiem_tra', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('ma_bkt')->index('fk_nop_bai_kiem_tra_ma_bkt');
            $table->integer('ma_tk')->index('fk_nop_bai_kiem_tra_ma_tk');
            $table->longText('noi_dung');
            $table->string('tra_loi');
            $table->decimal('diem_so', 10, 0)->nullable();
            $table->timestamp('ngay_nop')->useCurrent();
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nop_bai_kiem_tra');
    }
};
