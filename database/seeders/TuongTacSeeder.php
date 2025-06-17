<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TuongTacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 DB::table('tuong_tac')->insert([
            [
                'id'         => 1,
                'ma_tk'      => 1,
                'ma_bg'      => 1,
                'tra_loi_cho'=> 0,
                'noi_dung'   => 'Bài giảng rất dễ hiểu, cảm ơn thầy cô!',
                'ngay_tao'   => '2025-01-01 09:00:00',
                'trang_thai' => true,
            ],
            [
                'id'         => 2,
                'ma_tk'      => 2,
                'ma_bg'      => 1,
                'tra_loi_cho'=> 1,
                'noi_dung'   => 'Mình cũng thấy vậy, giải thích rõ ràng lắm.',
                'ngay_tao'   => '2025-01-01 10:00:00',
                'trang_thai' => true,
            ],
            [
                'id'         => 3,
                'ma_tk'      => 3,
                'ma_bg'      => 2,
                'tra_loi_cho'=> 0,
                'noi_dung'   => 'Có thể bổ sung thêm ví dụ minh họa được không ạ?',
                'ngay_tao'   => '2025-01-02 08:30:00',
                'trang_thai' => true,
            ],
            [
                'id'         => 4,
                'ma_tk'      => 1,
                'ma_bg'      => 2,
                'tra_loi_cho'=> 3,
                'noi_dung'   => 'Đồng ý, thêm ví dụ sẽ dễ học hơn.',
                'ngay_tao'   => '2025-01-02 09:15:00',
                'trang_thai' => true,
            ],
        ]);
    }
}
