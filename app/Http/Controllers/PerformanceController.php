<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerformanceController extends LayoutController
{
    function index(){
       return view(config('asset.view_page')('persional-management'));
    }
    function admin_index(){
       return $this->_auth_login() ?? view(config('asset.view_admin_page')('performance_management'));
    }
}
