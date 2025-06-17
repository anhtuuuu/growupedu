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
        Schema::create('hoc_phan', function (Blueprint $table) {
            $table->integer('ma_hp', true);
            $table->integer('ma_bm')->index('fk_hocphan_ma_bm');
            $table->string('ten_hp');
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
        Schema::dropIfExists('hoc_phan');
    }
};
