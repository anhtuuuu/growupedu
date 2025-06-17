<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaiTroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vai_tro')->insert([
            [
                'ma_vt'      => 1,
                'tieu_de'    => 'Sinh viên',
                'mo_ta'      => 'Người học tham gia các lớp học phần và bài giảng',
                'trang_thai' => true,
            ],
            [
                'ma_vt'      => 2,
                'tieu_de'    => 'Admin',
                'mo_ta'      => 'Quản trị hệ thống, tài khoản, dữ liệu',
                'trang_thai' => true,
            ],
            [
                'ma_vt'      => 3,
                'tieu_de'    => 'Giảng viên',
                'mo_ta'      => 'Giảng dạy, quản lý bài giảng và lớp học phần',
                'trang_thai' => true,
            ],
        ]);
    }
}
