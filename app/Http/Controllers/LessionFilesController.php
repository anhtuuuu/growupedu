<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessionFilesController extends Controller
{
    function index(){
       return view(config('asset.view_page')('lession-files'));
    }
}
