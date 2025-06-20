<?php

namespace App\Http\Controllers;
use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\TuongTac;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;

class ClassController extends LayoutController
{
    function index()
    {
        $this->_initialize();
        $segment = 1;
        $class_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = (new LopHocPhan())->gets($args);
        $this->_data['load_section_class'] = $section_class_none;

        $args['alias'] = $class_alias;
        $class = (new LopHocPhan)->gets($args);

        $args['ma_tk'] = $class[0]->ma_tk;
        $lessons = (new BaiGiang)->gets($args);

        $interacts = (new TuongTac)->gets($args);

        if (empty($class) || empty($lessons) || empty($interacts)) {
            abort(404);
            return;
        }

        $args['alias_lesson'] = $lessons[0]->alias;
        $args['order_by'] = 'DESC';

        $courses = (new Chuong)->gets($args);
        $contents = (new Bai)->gets($args);


        $this->_data['courses'] = $courses;
        $this->_data['contents'] = $contents;

        $this->_data['section_class'] = $class;
        $this->_data['lessons'] = $lessons;
        $this->_data['interacts'] = $interacts;

        $this->_data['type_side_none'] = 'lesson';
        // $this->_data['left_side_none'] = $class[0]->ten_lhp;
        $this->_data['left_side_none'] = '';


        return view(config('asset.view_page')('section-class'), $this->_data);
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
    function interact(){
         $this->_initialize();
        $segment = 2;
        $class_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = (new LopHocPhan())->gets($args);
        $this->_data['load_section_class'] = $section_class_none;

        $args['alias'] = $class_alias;
        $class = (new LopHocPhan)->gets($args);
        $args['ma_tk'] = $class[0]->ma_tk;
        $lessons = (new BaiGiang)->gets($args);

        $interacts = (new TuongTac)->gets($args);

        if (empty($class) || empty($lessons)|| empty($interacts)) {
            abort(404);
            return;
        }
        $this->_data['section_class'] = $class;
        $this->_data['lessons'] = $lessons;
        $this->_data['interacts'] = $interacts;
        $this->_data['type_side_none'] = 'lesson';
        // $this->_data['left_side_none'] = $class[0]->ten_lhp;
        $this->_data['left_side_none'] = '';
        return view(config('asset.view_page')('interact'),$this->_data);
    }
}
