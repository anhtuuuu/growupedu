<?php

namespace App\Exports;

use App\Models\SinhVien;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }


    public function collection()
    {
        return collect($this->filters);
    }
}
