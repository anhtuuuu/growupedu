<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('danhgia')->insert([
            [
                'ma_tk'      => 1,
                'ma_lhp'     => 1,
                'so_sao'     => 5,
                'noi_dung'   => 'Giảng viên rất tận tâm, bài giảng dễ hiểu.',
                'ngay_tao'   => '2025-01-01 10:00:00',
                'trang_thai' => true,
            ],
            [
                'ma_tk'      => 2,
                'ma_lhp'     => 2,
                'so_sao'     => 4,
                'noi_dung'   => 'Lớp học có nội dung thực tiễn nhưng hơi nhanh.',
                'ngay_tao'   => '2025-01-05 08:45:00',
                'trang_thai' => true,
            ],
            [
                'ma_tk'      => 3,
                'ma_lhp'     => 1,
                'so_sao'     => 3,
                'noi_dung'   => 'Cần cải thiện phần tương tác với sinh viên.',
                'ngay_tao'   => '2025-01-10 14:00:00',
                'trang_thai' => true,
            ],
            [
                'ma_tk'      => 4,
                'ma_lhp'     => 3,
                'so_sao'     => 5,
                'noi_dung'   => 'Bài giảng rất rõ ràng, dễ tiếp thu.',
                'ngay_tao'   => '2025-01-12 09:00:00',
                'trang_thai' => true,
            ],
            [
                'ma_tk'      => 3,
                'ma_lhp'     => 3,
                'so_sao'     => 2,
                'noi_dung'   => 'Giảng viên giảng hơi nhanh, cần thêm ví dụ minh họa.',
                'ngay_tao'   => '2025-01-15 11:15:00',
                'trang_thai' => true,
            ],
            [
                'ma_tk'      => 4,
                'ma_lhp'     => 3,
                'so_sao'     => 4,
                'noi_dung'   => 'Tài liệu đầy đủ, học tốt nhưng cần cải thiện phần hỏi đáp.',
                'ngay_tao'   => '2025-01-20 15:30:00',
                'trang_thai' => true,
            ],
        ]);
    }
}
