<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoMonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('bo_mon')->insert([
            [
                'ma_khoa'     => 1, // Giả sử mã khoa CNTT = 3
                'ten_bm'      => 'Bộ môn Khoa học Máy tính',
                'alias'       => 'bo-mon-khoa-hoc-may-tinh',
                'mo_ta'       => 'Nghiên cứu các lý thuyết, thuật toán và ngôn ngữ lập trình.',
                'trang_thai'  => true,
            ],
            [
                'ma_khoa'     => 1,
                'ten_bm'      => 'Bộ môn Kỹ thuật Phần mềm',
                'alias'       => 'bo-mon-ky-thuat-phan-mem',
                'mo_ta'       => 'Tập trung vào quy trình phát triển, kiểm thử và quản lý phần mềm.',
                'trang_thai'  => true,
            ],
            [
                'ma_khoa'     => 1,
                'ten_bm'      => 'Bộ môn Mạng và Truyền thông',
                'alias'       => 'bo-mon-mang-va-truyen-thong',
                'mo_ta'       => 'Chuyên về thiết kế, triển khai và quản trị mạng máy tính.',
                'trang_thai'  => true,
            ],
            [
                'ma_khoa'     => 1,
                'ten_bm'      => 'Bộ môn Hệ thống Thông tin',
                'alias'       => 'bo-mon-he-thong-thong-tin',
                'mo_ta'       => 'Phát triển và quản trị các hệ thống thông tin doanh nghiệp.',
                'trang_thai'  => true,
            ],
            [
                'ma_khoa'     => 1,
                'ten_bm'      => 'Bộ môn Trí tuệ nhân tạo & Máy học',
                'alias'       => 'bo-mon-tri-tue-nhan-tao-may-hoc',
                'mo_ta'       => 'Nghiên cứu và ứng dụng AI, học máy, xử lý ngôn ngữ tự nhiên.',
                'trang_thai'  => true,
            ],
        ]);
    }
}
