<?php

namespace App\Http\Controllers;
use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\TuongTac;
use App\Models\LopHocPhan;
use App\Models\Taikhoan;
use App\Models\Nopbaikiemtra;

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

        $chapters = (new Chuong)->gets($args);
        $contents = (new Bai)->gets($args);


        $this->_data['chapters'] = $chapters;
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
        $this->_data['rows'] = $this->gets();
        return view(config('asset.view_admin_page')('class_management'), $this->_data);
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
        $lessons = (new BaiGiang)->gets($args);
        $this->_data['load_section_class'] = $section_class_none;

        $args['alias'] = $class_alias;
        $class = (new LopHocPhan)->gets($args);
        $args['ma_tk'] = $class[0]->ma_tk;
        // $lessons = (new BaiGiang)->gets($args);

        $interacts = (new TuongTac)->gets($args);

        if (empty($class) || empty($interacts)) {
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
    function core_sheet(){
        $this->_initialize();
        $segment = 1;
        $class_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class = (new LopHocPhan)->gets($args);
        $args['alias'] = $class_alias;
        
        $accounts=(new Taikhoan)->gets($args);
        $submitted_tests=(new NopBaiKiemTra)->gets($args);
        $lesson = (new BaiGiang)->gets($args);

        $this->_data['load_section_class'] = $section_class;
        $this->_data['lessons'] = $lesson;
        $this->_data['section_class']= $section_class;
        $this->_data['submitted_tests']= $submitted_tests;
        $this->_data['type_side_none'] = 'lesson';
        $this->_data['left_side_none'] = '';

    return view(config('asset.view_page')('score-sheet'),$this->_data);
    }
}
