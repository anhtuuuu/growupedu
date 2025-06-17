<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HocPhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('hoc_phan')->insert([
            [
                'ma_hp'      => 1,
                'ma_bm'      => 6,
                'ten_hp'     => 'Lập trình Web',
                'alias'      => 'lap-trinh-web',
                'mo_ta'      => 'Học phần cung cấp kiến thức HTML, CSS, JavaScript và PHP.',
                'trang_thai' => true,
            ],
            [
                'ma_hp'      => 2,
                'ma_bm'      => 6,
                'ten_hp'     => 'Cơ sở dữ liệu',
                'alias'      => 'co-so-du-lieu',
                'mo_ta'      => 'Giới thiệu về hệ quản trị cơ sở dữ liệu và ngôn ngữ SQL.',
                'trang_thai' => true,
            ],
            [
                'ma_hp'      => 3,
                'ma_bm'      => 6,
                'ten_hp'     => 'Lập trình hướng đối tượng',
                'alias'      => 'lap-trinh-huong-doi-tuong',
                'mo_ta'      => 'Học phần giúp sinh viên nắm bắt OOP với Java/PHP/C#.',
                'trang_thai' => true,
            ],
        ]);
    }
}
