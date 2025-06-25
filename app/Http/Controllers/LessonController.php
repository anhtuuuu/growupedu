<?php

namespace App\Http\Controllers;
use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\LhpBg;
use App\Models\LopHocPhan;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use View;

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
      $get_req = $request->all();
      if (!empty($get_req)) {
         $validated = $request->validate(
            [
               'ten_bg' => 'required|max:255',
               'alias' => 'required|max:255|unique:bai_giang',
            ],
            [
               'ten_bg.required' => 'Vui lòng nhập tên bài giảng.',
               'ten_bg.max' => 'Tên bài giảng không được vượt quá 255 ký tự.',
               'alias.required' => 'Liên kết tĩnh không được để trống.',
               'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
               'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
            ]
         );
         $data = [
            'ma_tk' => Session::get('admin_id'),
            'ten_bg' => $request->ten_bg,
            'alias' => $request->alias,
            'mo_ta' => $request->mo_ta
         ];
         $result = (new BaiGiang)->add($data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Thêm bài giảng thành công');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Thêm bài giảng thất bại');
         }
         return view(config('asset.view_admin_control')('control_lesson'), $this->_data);
      }
      return view(config('asset.view_admin_control')('control_lesson'));

      // print_r($result);
   }
   function admin_update(Request $request)
   {
      $get_req = $request->all();
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');
      if (empty($get_req)) {
         if ($id === '') {
            abort(404);
         }
         $lesson = (new BaiGiang)->get_by_id($id);
         if (empty($lesson)) {
            abort(404);
         }
         $this->_data['row'] = $lesson;
         return view(config('asset.view_admin_control')('control_lesson'), $this->_data);
      }

      $id_lesson = $request->ma_bg;
      $lesson = (new BaiGiang)->get_by_id($id_lesson);
      $validated = $request->validate(
         [
            'ten_bg' => 'required|max:255',
            'alias' => 'required|max:255' . ($lesson->alias == $request->alias ? '' : '|unique:bai_giang'),
         ],
         [
            'ten_bg.required' => 'Vui lòng nhập tên bài giảng.',
            'ten_bg.max' => 'Tên bài giảng không được vượt quá 255 ký tự.',
            'alias.required' => 'Liên kết tĩnh không được để trống.',
            'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
            'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
         ]
      );

      if (empty($lesson)) {
         abort(404);
      }
      if ($lesson->alias == $request->alias) {
         $data = [
            'ten_bg' => $request->ten_bg,
            'mo_ta' => $request->mo_ta
         ];
      } else {
         $data = [
            'ten_bg' => $request->ten_bg,
            'alias' => $request->alias,
            'mo_ta' => $request->mo_ta
         ];
      }
      $result = (new BaiGiang)->admin_update($id_lesson, $data);
      if ($result) {
         Session::put('error', 'success');
         Session::put('message', 'Cập nhật bài giảng thành công.');
      } else {
         Session::put('error', 'danger');
         Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
      }
      return Redirect::to('danh-sach-bai-giang');
   }

}
