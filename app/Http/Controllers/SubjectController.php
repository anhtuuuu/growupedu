<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('subject_management'));
    }
}
