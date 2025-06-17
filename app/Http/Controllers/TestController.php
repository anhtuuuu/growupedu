<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function index(){
       return view(config('asset.view_admin_page')('test_management'));
    }
}
