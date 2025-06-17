<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerController extends Controller
{
    function index(){
       return view(config('asset.view_admin_page')('lecturer_management'));
    }
}
