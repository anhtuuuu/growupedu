<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends LayoutController
{
    function admin_index(){
       return view(config('asset.view_admin_page')('main'));
    }
}
