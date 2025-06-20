<?php

namespace App\Http\Controllers;
use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\LhpBg;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LessonController extends LayoutController
{
   function index()
   {
      $segment = 2;
      $lesson_alias = trim(request()->segment($segment) ?? '');
      if ($lesson_alias === '') {
         abort(404);
      }
      $args = array();

      $args['alias_lesson'] = $lesson_alias;
      $lesson = (new BaiGiang)->gets($args);

      if (empty($lesson)) {
         abort(404);
         return;
      }

      $courses = (new Chuong)->gets($args);
      $contents = (new Bai)->gets($args);

      if (empty($lesson)) {
         abort(404);
         return;
      }

      $data = array();
      $data['courses'] = $courses;
      $data['contents'] = $contents;

      $this->_data['type_side_none'] = 'chapter';
      $this->_data['left_side_none'] = $data;
      $this->_data['load_section_class'] = $section_class_none; 


      return Redirect::to('bai-giang/' . $lesson[0]->alias . '/' . $courses[0]->alias . '/' . $contents[0]->alias);
      // return view(config('asset.view_page')('lesson'), $this->_data);
   }
   function files()
   {
      $segment = 2;
      $lesson_alias = trim(request()->segment($segment) ?? '');
      if ($lesson_alias === '') {
         abort(404);
      }
      $args = array();

      $args['alias_lesson'] = $lesson_alias;
      $lesson = (new BaiGiang)->gets($args);

      if (empty($lesson)) {
         abort(404);
         return;
      }

      $courses = (new Chuong)->gets($args);
      $contents = (new Bai)->gets($args);

      $data = array();
      $data['courses'] = $courses;
      $data['contents'] = $contents;

      $this->_data['type_side_none'] = 'chapter';
      $this->_data['left_side_none'] = $data;

      return view(config('asset.view_page')('lession-files'),$this->_data);
   }
   function admin_index()
   {
      return view(config('asset.view_admin_page')('lesson_management'));
   }
}
