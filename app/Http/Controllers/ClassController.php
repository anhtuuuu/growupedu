<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    function index(){
       return view(config('asset.view_admin_page')('class_management'));
    }
}
