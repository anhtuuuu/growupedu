<?php

namespace App\Http\Controllers;

use App\Models\Taikhoan;
use Illuminate\Http\Request;
use Session;

class LecturerController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('lecturer_management'));
    }
    function admin_index()
    {
        $args = array();
        $role_id = Session::get('admin_role');
        if (!$role_id) {
            abort(404);
        }
        $args['role'] = 2;
        $args['per_page'] = 5;
        if ($role_id == 2) {
            $ma_tk = Session::get('admin_id');
            $args['ma_gv'] = $ma_tk;
        } 
        $lecturers = (new Taikhoan)->gets($args);
        $this->_data['rows'] = $lecturers;
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('lecturer_management'), $this->_data);
    }
}
