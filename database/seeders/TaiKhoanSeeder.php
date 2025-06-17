<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('taikhoan')->insert([
            [
                'ma_tk' => 1,
                'ma_bm' => 6,
                'ho_ten' => 'Nguyễn Văn A',
                'username' => 'nguyenvana',
                'password' =>bcrypt('123456'),
                'email' => 'a@example.com',
                'gioi_tinh' => 'Nam',
                'hinh_anh' => 'avatar1.jpg',
                'nam_sinh' => '2000-01-01 00:00:00',
                'sdt' => '0901234567',
                'lien_ket' => 'https://facebook.com/nguyenvana',
                'ngay_tao' => now(),
                'vai_tro' => 1, // Sinh viên
                'trang_thai_dang_nhap' => false,
                'kich_hoat' => true,
                'trang_thai' => true,
            ],
            [
                'ma_tk' => 2,
                'ma_bm' => 6,
                'ho_ten' => 'Trần Thị B',
                'username' => 'tranthib',
                'password' =>bcrypt('123456'),
                'email' => 'b@example.com',
                'gioi_tinh' => 'Nữ',
                'hinh_anh' => 'avatar2.jpg',
                'nam_sinh' => '1999-05-10 00:00:00',
                'sdt' => '0912345678',
                'lien_ket' => 'https://linkedin.com/in/tranthib',
                'ngay_tao' => now(),
                'vai_tro' => 2, // Admin
                'trang_thai_dang_nhap' => true,
                'kich_hoat' => true,
                'trang_thai' => true,
            ],
            [
                'ma_tk' => 3,
                'ma_bm' => 6,
                'ho_ten' => 'Lê Văn C',
                'username' => 'levanc',
                'password' =>bcrypt('123456'),
                'email' => 'c@example.com',
                'gioi_tinh' => 'Nam',
                'hinh_anh' => 'avatar3.png',
                'nam_sinh' => '1998-09-15 00:00:00',
                'sdt' => '0923456789',
                'lien_ket' => 'https://github.com/levanc',
                'ngay_tao' => now(),
                'vai_tro' => 3, // Giảng viên
                'trang_thai_dang_nhap' => false,
                'kich_hoat' => false,
                'trang_thai' => true,
            ],
            [
                'ma_tk' => 4,
                'ma_bm' => 6,
                'ho_ten' => 'Phạm Thị D',
                'username' => 'phamthid',
                'password' =>bcrypt('123456'),
                'email' => 'd@example.com',
                'gioi_tinh' => 'Nữ',
                'hinh_anh' => 'avatar4.png',
                'nam_sinh' => '1997-07-07 00:00:00',
                'sdt' => '0934567890',
                'lien_ket' => 'https://twitter.com/phamthid',
                'ngay_tao' => now(),
                'vai_tro' => 1, // Sinh viên
                'trang_thai_dang_nhap' => true,
                'kich_hoat' => true,
                'trang_thai' => false,
            ],
        ]);
    }
}
