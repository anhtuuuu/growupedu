<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessController extends Controller
{
    function index(){
       return view(config('asset.view_admin_page')('assess'));
    }
    function detail($number){
       return view(config('asset.view_admin_page')('assess_detail'));
    }
}
