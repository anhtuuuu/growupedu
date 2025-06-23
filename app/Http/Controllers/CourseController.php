<?php

namespace App\Http\Controllers;

use App\Models\HocPhan;
use Illuminate\Http\Request;

class CourseController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('course_management'));
    }
    function admin_index(){
        $args = array();
        $course = (new HocPhan)->gets($args);
        $this->_data['rows'] = $course;
       return view(config('asset.view_admin_page')('course_management'), $this->_data);
    }
}
