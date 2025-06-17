<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    function index(){
       return view(config('asset.view_admin_page')('subject_management'));
    }
}
