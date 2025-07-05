<?php
namespace App\Imports;

use App\Models\Taikhoan;
use Maatwebsite\Excel\Concerns\ToModel;

class AccountsImport implements ToModel
{
    private $rows = 0;

    public function model(array $row)
    {
        $this->rows += 1;
        return new Taikhoan([
            'ma_bm' => $row[0],
            'ho_ten' => $row[1],
            'username' => $row[2],
            'password' => bcrypt($row[3]),
            'email' => $row[4],
            'gioi_tinh' => $row[5],
            'hinh_anh' => $row[6],
            'nam_sinh' => $row[7],
            'sdt' => $row[8],
            'lien_ket' => $row[9],
            'ngay_tao' => $row[10],
            'vai_tro' => $row[11]
        ]);
    }
    public function getRowCount(): int
    {
        return $this->rows;
    }

}