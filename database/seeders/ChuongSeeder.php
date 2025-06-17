<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChuongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('chuong')->insert([
            [

                'chuong'   => 1 ,
                'ma_bg'       => 1,
                'ten_chuong'  => 'Chương 1: Tổng quan về CNTT',
                'alias'       => 'chuong-1-tong-quan-ve-cntt',
                'mo_ta'       => 'Giới thiệu các khái niệm cơ bản và vai trò của CNTT.',
                'trang_thai'  => true,
                'thong_bao'   => false,
            ],
            [
                'chuong'   => 2,
                'ma_bg'       => 2,
                'ten_chuong'  => 'Chương 2: Kiến trúc máy tính',
                'alias'       => 'chuong-2-kien-truc-may-tinh',
                'mo_ta'       => 'Tìm hiểu về cấu trúc phần cứng máy tính.',
                'trang_thai'  => true,
                'thong_bao'   => true,
            ],
            [
                'chuong'   => 3,
                'ma_bg'       => 1,
                'ten_chuong'  => 'Chương 1: Lập trình cơ bản',
                'alias'       => 'chuong-1-lap-trinh-co-ban',
                'mo_ta'       => 'Cú pháp và cấu trúc cơ bản của ngôn ngữ lập trình.',
                'trang_thai'  => true,
                'thong_bao'   => false,
            ],
            [
                'chuong'   => 4,
                'ma_bg'       => 3,
                'ten_chuong'  => 'Chương 2: Cấu trúc điều khiển',
                'alias'       => 'chuong-2-cau-truc-dieu-khien',
                'mo_ta'       => 'Câu lệnh điều kiện, vòng lặp và xử lý luồng chương trình.',
                'trang_thai'  => false,
                'thong_bao'   => false,
            ],
        ]);
    }
}
