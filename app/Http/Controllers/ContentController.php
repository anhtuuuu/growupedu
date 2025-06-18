<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('content_management'));
    }
}
