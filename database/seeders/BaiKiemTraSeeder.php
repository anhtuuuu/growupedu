<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaiKiemTraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('bai_kiem_tra')->insert([
            [
                'ma_lhp'     => 1,
                'tieu_de'    => 'Kiểm tra giữa kỳ – Toán cc',
                'noi_dung'   => '19 câu trắc nghiệm...',
                'dap_an'     => 'A;C;B;D;...',
                'ngay_tao'   => '2025-01-01 10:00:00',
                'trang_thai' => true,
            ],
            [
                'ma_lhp'     => 1,
                'tieu_de'    => 'Kiểm tra cuối kỳ – Toán rr',
                'noi_dung'   => '12 câu trắc nghiệm...',
                'dap_an'     => 'A;C;B;D;...',
                'ngay_tao'   => '2025-02-15 14:30:00',
                'trang_thai' => true,
            ],
            [
                'ma_lhp'     => 2,
                'tieu_de'    => 'Kiểm tra giữa kỳ – TK WEB ',
                'noi_dung'   => '5 câu tự luận và 10 câu trắc nghiệm...',
                'dap_an'     => 'C;C;A;B;...',
                'ngay_tao'   => '2025-03-10 09:15:00',
                'trang_thai' => false,
            ],
            [
                'ma_lhp'     => 2,
                'tieu_de'    => 'Kiểm tra cuối kỳ – PHP cơ bản',
                'noi_dung'   => '8 câu trắc nghiệm...',
                'dap_an'     => 'B;A;D;C;...',
                'ngay_tao'   => '2025-04-20 16:45:00',
                'trang_thai' => true,
            ],
        ]);
    }
}
