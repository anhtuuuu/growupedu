<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends LayoutController
{
    function index(){
       return view(config('asset.view_page')('test-client'));
    }
    function admin_index(){
       return view(config('asset.view_admin_page')('test_management'));
    }
}
