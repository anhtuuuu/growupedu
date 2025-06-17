<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionClassController extends Controller
{
    function index(){
       return view(config('asset.view_page')('section-class'));
    }
}
