<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormLoginController extends Controller
{
    function index(){
       return view(config('asset.view_page')('form-login'));
    }
}
