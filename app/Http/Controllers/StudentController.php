<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use Illuminate\Http\Request;

class StudentController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('student_management'));
    }
    function admin_index()
    {
        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');
        $args = array();
        $args['alias_class'] = $id;
        $students = (new SinhVien)->gets($args);
        $this->_data['rows'] = $students;
        return view(config('asset.view_admin_page')('student_management'), $this->_data);
    }

}
