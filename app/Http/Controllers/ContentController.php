<?php

namespace App\Http\Controllers;

use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;

class ContentController extends LayoutController
{
    function index(){
       $segment = 2;
       $segment2 = 4;

      $lesson_alias = trim(request()->segment($segment) ?? '');
      $content_alias = trim(request()->segment($segment2) ?? '');
      if ($lesson_alias === '' || $content_alias === '') {
         abort(404);
      }
      $args = array();
        $section_class_none = (new LopHocPhan)->gets($args);
      $this->_data['load_section_class'] = $section_class_none;
      $args['alias_lesson'] = $lesson_alias;
      $args['alias_content'] = $content_alias;

      $lesson = (new BaiGiang)->gets($args);
      $content = (new BaiGiang)->gets($args);

      if (empty($lesson) || empty($content)) {
         abort(404);
         return;
      }

      $chapters = (new Chuong)->gets($args);      
      $contents = (new Bai)->gets($args);

      $this->_data['chapters'] = $chapters;
      $this->_data['contents'] = $contents;

      $this->_data['type_side_none'] = 'lesson';
        $this->_data['left_side_none'] = '';

      $row = (new Bai)->get_by_alias($content_alias);      
      $this->_data['row'] = $row;

      return view(config('asset.view_page')('lesson'), $this->_data);
    }
    function admin_index(){
      $args = array();
      $contents = (new Bai)->gets($args);
      $this->_data['rows'] = $contents;
       return view(config('asset.view_admin_page')('content_management'),$this->_data);
    }

    function files()
   {
      $segment = 1;
      $class_alias = trim(request()->segment($segment) ?? '');
      $segment = 2;
      $lesson_alias = trim(request()->segment($segment) ?? '');
      if ($class_alias === '' || $lesson_alias === '' ) {
         abort(404);
      }

      $args = array();
      $args['alias_class'] = $class_alias;
      $args['alias_lesson'] = $lesson_alias;

      $lesson = (new BaiGiang)->gets($args);


      if (empty($lesson)) {
         abort(404);
         return;
      }

      // $courses = (new Chuong)->gets($args);
      $contents = (new Bai)->gets($args);

      // $data = array();
      // $data['courses'] = $courses;
      // $data['contents'] = $contents;
      $section_class_none = (new LopHocPhan())->gets($args);

      $this->_data['load_section_class'] = $section_class_none;
      $this->_data['contents'] = $contents;
      $this->_data['section_class'] = $section_class_none;
      $this->_data['lessons'] = $lesson;

      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';

      return view(config('asset.view_page')('lesson-files'),$this->_data);
   }
}
