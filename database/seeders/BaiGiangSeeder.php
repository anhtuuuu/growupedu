<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
                'ma_bg'      => 1,
                'ma_tk'      => 1,
                'ten_bg'     => 'Giảng bài mẫu 1',
                'alias'      => 'giang-bai-mau-1',
                'mo_ta'      => 'Mô tả chi tiết 1...',
                'hien_thi'   => true,
                'trang_thai' => true,
                'thong_bao'  => false,
            ],
            [
                'ma_bg'      => 2,
                'ma_tk'      => 2,
                'ten_bg'     => 'Giảng bài mẫu 2',
                'alias'      => 'giang-bai-mau-2',
                'mo_ta'      => 'Mô tả chi tiết 2...',
                'hien_thi'   => true,
                'trang_thai' => true,
                'thong_bao'  => false,
            ],
            [
                'ma_bg'      => 3,
                'ma_tk'      => 3,
                'ten_bg'     => 'Giảng bài mẫu 3',
                'alias'      => 'giang-bai-mau-3',
                'mo_ta'      => 'Mô tả chi tiết 3...',
                'hien_thi'   => false,
                'trang_thai' => true,
                'thong_bao'  => true,
            ],
            [
                'ma_bg'      => 4,
                'ma_tk'      => 4,
                'ten_bg'     => 'Giảng bài mẫu 4',
                'alias'      => 'giang-bai-mau-4',
                'mo_ta'      => 'Mô tả chi tiết 4...',
                'hien_thi'   => true,
                'trang_thai' => false,
                'thong_bao'  => false,
            ],
            [
                'ma_bg'      => 5,
                'ma_tk'      => 4,
                'ten_bg'     => 'Giảng bài mẫu 5',
                'alias'      => 'giang-bai-mau-5',
                'mo_ta'      => 'Mô tả chi tiết 5...',
                'hien_thi'   => false,
                'trang_thai' => false,
                'thong_bao'  => true,
            ],
        ]);
    }
}
