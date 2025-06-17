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
        Schema::create('lhp_bg', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('ma_lhp')->index('fk_lhp_bg_ma_lhp');
            $table->integer('ma_bg')->index('fk_lhp_bg_ma_bg');
            $table->boolean('trang_thai')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lhp_bg');
    }
};
