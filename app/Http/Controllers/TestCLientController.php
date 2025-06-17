<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestCLientController extends Controller
{
    function index(){
       return view(config('asset.view_page')('test-client'));
    }
}
