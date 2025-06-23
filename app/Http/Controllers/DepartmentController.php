<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;

class DepartmentController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('department_management'));
    }
    function admin_index()
    {
        $args = array();
        $department = (new Khoa)->gets($args);
        $this->_data['rows'] = $department;
        return view(config('asset.view_admin_page')('department_management'), $this->_data);
    }
}
