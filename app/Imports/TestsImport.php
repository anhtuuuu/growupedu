<?php
namespace App\Imports;

use App\Models\BaiKiemTra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;


class TestsImport implements ToCollection
{
    // private $rows = 0;

    // public function model(array $row)
    // {
    //     $this->rows += 1;
    //     return new BaiKiemTra([
    //         'noi_dung' => $row[0],
    //     ]);
    // }
    // public function getRowCount(): int
    // {
    //     return $this->rows;
    // }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            logger($row); // hoặc dd($row);
        }
    }



}