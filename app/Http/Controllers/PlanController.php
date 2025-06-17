<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    function index(){
       return view(config('asset.view_admin_page')('plan_management'));
    }
}
