<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('khoa')->insert([
            [
                'ten_khoa'    => 'Công nghệ thông tin',
                'alias'       => 'cong-nghe-thong-tin',
                'mo_ta'       => 'Đào tạo các chuyên ngành lập trình, cơ sở dữ liệu, mạng máy tính, và trí tuệ nhân tạo.',
                'trang_thai'  => true,
            ]
        ]);
    }
}
