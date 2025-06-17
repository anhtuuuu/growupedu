<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('sinh_vien')->insert([
            [
                'id' => 1,
                'ma_tk' => 1,
                'ma_lhp' => 1,
                'ngay_tham_gia' => '2025-01-10 08:00:00',
                'tien_do' => 20,
                'trang_thai' => true,
            ],
            [
                'id' => 2,
                'ma_tk' => 2,
                'ma_lhp' => 1,
                'ngay_tham_gia' => '2025-01-11 09:00:00',
                'tien_do' => 35,
                'trang_thai' => true,
            ],
            [
                'id' => 3,
                'ma_tk' => 3,
                'ma_lhp' => 2,
                'ngay_tham_gia' => '2025-01-12 10:00:00',
                'tien_do' => 50,
                'trang_thai' => true,
            ],
            [
                'id' => 4,
                'ma_tk' => 4,
                'ma_lhp' => 2,
                'ngay_tham_gia' => '2025-01-13 11:00:00',
                'tien_do' => 60,
                'trang_thai' => true,
            ],           
        ]);
    }
}
