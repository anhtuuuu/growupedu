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

      $chapters = (new Chuong)->gets($args);
      $contents = (new Bai)->gets($args);

      if (empty($lesson)) {
         abort(404);
         return;
      }

      $data = array();
      $data['chapters'] = $chapters;
      $data['contents'] = $contents;

      $this->_data['type_side_none'] = 'chapter';
      $this->_data['left_side_none'] = $data;


      return Redirect::to('bai-giang/' . $lesson[0]->alias . '/' . $chapters[0]->alias . '/' . $contents[0]->alias);
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

      $chapters = (new Chuong)->gets($args);
      $contents = (new Bai)->gets($args);

      $data = array();
      $data['chapters'] = $chapters;
      $data['contents'] = $contents;

      $this->_data['type_side_none'] = 'chapter';
      $this->_data['left_side_none'] = $data;

      return view(config('asset.view_page')('lession-files'), $this->_data);
   }

   function admin_index()
   {
      $args = array();
      $lessons = (new BaiGiang)->gets($args);
      $this->_data['rows'] = $lessons;
      return view(config('asset.view_admin_page')('lesson_management'), $this->_data);
   }
   function admin_add(Request $request)
   {
      $data = $request->all();
      if (empty($data)) {
         return view(config('asset.view_admin_control')('control_lesson'));
      }
      print_r('aaaa');
   }
   function admin_update(Request $request)
   {
      $data = $request->all();
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');
      if ($id === '') {
         abort(404);
      }
      if (empty($data)) {
         $lessons = (new BaiGiang)->get_by_id($id);
         $this->_data['rows'] = $lessons;
         return view(config('asset.view_admin_control')('control_lesson'),$this->_data);
      }
      print_r('aaaa');
   }

}
