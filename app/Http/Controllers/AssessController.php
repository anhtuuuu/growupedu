<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessController extends LayoutController
{
   function index(){
       return view(config('asset.view_page')('assess'));
    }
    function admin_index(){
       return view(config('asset.view_admin_page')('assess'));
    }
    function assess_detail($number){
       return view(config('asset.view_admin_page')('assess_detail'));
    }
}
