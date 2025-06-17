<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            VaiTroSeeder::class,
            KhoaSeeder::class, 
            BoMonSeeder::class,       
            TaiKhoanSeeder::class,
            HocPhanSeeder::class,        
            LopHocPhanSeeder::class,    
            BaiGiangSeeder::class,
            ChuongSeeder::class,        
            BaiSeeder::class,       
            BaiKiemTraSeeder::class,            
            DanhGiaSeeder::class,      
            LhpBgSeeder::class,                 
            NopBaiKiemTraSeeder::class,  
            SinhVienSeeder::class,
            TuongTacSeeder::class,
        ]);
    }
}
