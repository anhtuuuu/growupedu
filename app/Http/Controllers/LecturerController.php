<?php

namespace App\Http\Controllers;

use App\Models\Taikhoan;
use Illuminate\Http\Request;

class LecturerController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('lecturer_management'));
    }
    function admin_index()
    {
        $args = array();
        $args['role'] = 1;
        $lecturers = (new Taikhoan)->gets($args);
        $this->_data['rows'] = $lecturers;
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('lecturer_management'), $this->_data);
    }
}
