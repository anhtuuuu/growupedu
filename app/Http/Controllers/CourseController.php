<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index()
    {
        return view(config('asset.view_admin_page')('course_management'));
    }
}
