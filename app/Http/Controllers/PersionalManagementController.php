<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersionalManagementController extends Controller
{
    function index(){
       return view(config('asset.view_page')('persional-management'));
    }
}
