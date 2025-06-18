<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    function index(){
       return view(config('asset.view_page')('lession-files'));
    }
    function admin_index(){
       return view(config('asset.view_admin_page')('lesson_management'));
    }
}
