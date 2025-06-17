<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LopHocPhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('lop_hoc_phan')->insert([
            [
                'ma_lhp'      => 1,
                'ten_lhp'     => 'CĐ TH22WEB A',
                'alias'       => 'cd-th22web-a',
                'ma_tk'       => 1,
                'ma_hp'       => 1,
                'hinh_anh'    => 'web-a.jpg',
                'mo_ta'       => 'Lớp học phần A thuộc ngành Thiết kế web.',
                'ngay_tao'    => '2025-01-10 08:00:00',
                'hien_thi'    => true,
                'trang_thai'  => true,
                'thong_bao'   => false,
            ],
            [
                'ma_lhp'      => 2,
                'ten_lhp'     => 'CĐ TH22WEB B',
                'alias'       => 'cd-th22web-b',
                'ma_tk'       => 2,
                'ma_hp'       => 1,
                'hinh_anh'    => 'web-b.jpg',
                'mo_ta'       => 'Lớp học phần B nâng cao về lập trình web.',
                'ngay_tao'    => '2025-01-12 09:00:00',
                'hien_thi'    => true,
                'trang_thai'  => true,
                'thong_bao'   => false,
            ],
            [
                'ma_lhp'      => 3,
                'ten_lhp'     => 'CĐ TH22WEB C',
                'alias'       => 'cd-th22web-c',
                'ma_tk'       => 3,
                'ma_hp'       => 1,
                'hinh_anh'    => 'web-c.jpg',
                'mo_ta'       => 'Lớp học phần C chuyên sâu về PHP và MySQL.',
                'ngay_tao'    => '2025-01-15 10:30:00',
                'hien_thi'    => true,
                'trang_thai'  => true,
                'thong_bao'   => false,
            ],
        ]);
    }
}
