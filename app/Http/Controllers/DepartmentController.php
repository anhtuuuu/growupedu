<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('department_management'));
    }
}
