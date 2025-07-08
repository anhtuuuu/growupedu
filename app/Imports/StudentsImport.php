<?php
namespace App\Imports;

use App\Models\SinhVien;
use App\Models\Taikhoan;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;

class StudentsImport implements ToModel
{
    private $rows = 0;
    protected $students_miss;
    protected $class_id;
    public function __construct($class_id)
    {
        $this->class_id = $class_id;
    }

    public function model(array $row)
    {
        $username = $row[0];
        $student = (new Taikhoan())->get_by_username($username);
        if (empty($student)) {
            $this->students_miss[] = [$row[0]];
        } else {
            $args['ma_sv'] = $student->ma_tk;
            $check_existed = (new SinhVien())->gets($args);
            if (empty($check_existed)) {
                $this->rows += 1;
                return new SinhVien([
                    'ma_tk' => $student->ma_tk,
                    'ma_lhp' => $this->class_id
                ]);
            }
            else{
                $this->students_miss[] = [$row[0]];
            }
        }
    }
    public function getRowCount(): int
    {
        return $this->rows;
    }
    public function getMissed()
    {
        return $this->students_miss;
    }
}