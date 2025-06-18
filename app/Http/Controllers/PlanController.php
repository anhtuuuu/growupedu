<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('plan_management'));
    }
}
