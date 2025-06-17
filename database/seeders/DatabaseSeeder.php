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
            BaiGiangSeeder::class,
            BaiKiemTraSeeder::class,            
            BaiSeeder::class,       
            BoMonSeeder::class,       
            ChuongSeeder::class,        
            DanhGiaSeeder::class,      
            HocPhanSeeder::class,        
            KhoaSeeder::class, 
            LhpBgSeeder::class,          
            LopHocPhanSeeder::class,    
            DanhGiaSeeder::class,         
            NopBaiKiemTraSeeder::class,  
            SinhVienSeeder::class,
            TaiKhoanSeeder::class,
            TuongTacSeeder::class,
            VaiTroSeeder::class,
        ]);
    }
}
