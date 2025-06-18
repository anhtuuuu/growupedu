<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('student_management'));
    }
}
