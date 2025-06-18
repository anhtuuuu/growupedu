<?php

namespace App\Http\Controllers;
use App\Models\BaiGiang;
use App\Models\TuongTac;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;

class ClassController extends LayoutController
{
    function index()
    {
        $segment = 2;
        $class_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '') {
            abort(404);
        }
        $args = array();

        $args['alias'] = $class_alias;
        $class = (new LopHocPhan)->gets_by_alias($args);

        if (empty($class)) {
            abort(404);
            return;
        }
        $args['ma_tk'] = $class[0]->ma_tk;
        $lessons = (new BaiGiang)->gets($args);

        $interacts = (new TuongTac)->gets($args);

        $_values = array();
        $_values['section_class'] = $class;
        $_values['lessons'] = $lessons;
        $_values['interacts'] = $interacts;


        return view(config('asset.view_page')('section-class'), $_values);
    }
    function detail()
    {


        // return view(config('asset.view_page')('section-class'));
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
