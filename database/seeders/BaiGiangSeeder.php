<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaiGiangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bai_giang')->insert([
            [
                'MaSach' => 1,
                'MaTK' => 1,
                'SoSao' => 5,
                'DanhGia' => 'Cuốn sách rất đặc biệt!',
                'NgayDang' => '2025-01-01 10:00:00',
            ],

        ]);

    }
}
