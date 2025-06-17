<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LhpBgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('LHP_BG')->insert([
            [
                'id'         => 1,
                'ma_lhp'     => 1,
                'ma_bg'      => 1,
                'trang_thai' => true,
            ],
            [
                'id'         => 2,
                'ma_lhp'     => 1,
                'ma_bg'      => 2,
                'trang_thai' => true,
            ],
            [
                'id'         => 3,
                'ma_lhp'     => 2,
                'ma_bg'      => 3,
                'trang_thai' => true,
            ],
        ]);
    }
}
