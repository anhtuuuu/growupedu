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
        Schema::create('tuong_tac', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('ma_tk')->index('fk_tuong_tac_ma_tk');
            $table->integer('ma_lhp')->index('fk_tuong_tac_ma_lhp');
            $table->integer('tra_loi_cho')->nullable()->default(0);
            $table->text('noi_dung');
            $table->timestamp('ngay_tao')->useCurrent();
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuong_tac');
    }
};
