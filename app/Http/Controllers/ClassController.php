<?php

namespace App\Http\Controllers;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;

class ClassController extends LayoutController
{
    function index(){
       return view(config('asset.view_page')('section-class'));
    }
    function detail($number){
       return view(config('asset.view_page')('section-class-detail'));
    }
    function admin_index()
    {
        $class = $this->gets();
        return view(config('asset.view_admin_page')('class_management'));
    }
    function gets()
    {
        $args = '';
        $class = (new LopHocPhan)->gets($args);
        return $class;
    }

}
