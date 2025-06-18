<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('lecturer_management'));
    }
}
