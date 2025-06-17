<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NopBaiKiemTraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('nop_bai_kiem_tra')->insert([
            [
                'id'         => 1,
                'ma_bkt'     => 1,
                'ma_tk'      => 1,
                'noi_dung'   => 'Bài làm gồm 3 phần: trắc nghiệm, tự luận và ví dụ minh hoạ.',
                'tra_loi'    => 'Câu trả lời đầy đủ và chính xác.',
                'diem_so'    => 9.5,
                'ngay_nop'   => '2025-01-20 09:30:00',
                'trang_thai' => true,
            ],
            [
                'id'         => 2,
                'ma_bkt'     => 2,
                'ma_tk'      => 2,
                'noi_dung'   => 'Nộp bài gồm phần trắc nghiệm và mô tả thuật toán.',
                'tra_loi'    => 'Trả lời đúng 80% nội dung yêu cầu.',
                'diem_so'    => 8.0,
                'ngay_nop'   => '2025-01-21 14:15:00',
                'trang_thai' => true,
            ],
        ]);
    }
}
