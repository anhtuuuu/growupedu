<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('bai')->insert([
            [
                'chuong'      => 1,
                'tieu_de'     => 'Bài 1: Giới thiệu',
                'alias'       => 'bai-1-gioi-thieu',
                'mo_ta'       => 'Mô tả bài học giới thiệu...',
                'noi_dung'    => 'Nội dung chi tiết về bài 1...',
                'video'       => 'https://youtu.be/video1',
                'lien_ket'    => 'https://tài liệu.com/bai1',
                'ngay_tao'    => '2025-01-01 10:00:00',
                'hien_thi'    => true,
                'trang_thai'  => true,
                'thong_bao'   => false,
            ],
            [
                'chuong'      => 2,
                'tieu_de'     => 'Bài 2: Cơ bản',
                'alias'       => 'bai-2-co-ban',
                'mo_ta'       => 'Mô tả bài học cơ bản...',
                'noi_dung'    => 'Nội dung chi tiết về bài 2...',
                'video'       => 'https://youtu.be/video2',
                'lien_ket'    => 'https://tài liệu.com/bai2',
                'ngay_tao'    => '2025-02-15 14:30:00',
                'hien_thi'    => true,
                'trang_thai'  => false,
                'thong_bao'   => true,
            ],
            [
                'chuong'      => 3,
                'tieu_de'     => 'Bài 3: Nâng cao',
                'alias'       => 'bai-3-nang-cao',
                'mo_ta'       => 'Mô tả bài học nâng cao...',
                'noi_dung'    => 'Nội dung chi tiết về bài 3...',
                'video'       => 'https://youtu.be/video3',
                'lien_ket'    => 'https://tài liệu.com/bai3',
                'ngay_tao'    => '2025-03-10 09:15:00',
                'hien_thi'    => false,
                'trang_thai'  => true,
                'thong_bao'   => false,
            ],
        ]);
    }
}
