<?php

namespace App\Http\Controllers;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $class = $this->gets();
        return view(config('asset.view_page')('main'))->with('class',$class);
    }
    function gets()
    {
        $args = '';
        $class = (new LopHocPhan)->gets($args);
        return $class;
    }
}
