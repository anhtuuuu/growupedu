<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\LopHocPhan;
use App\Models\Baikiemtra;
use App\Models\Baigiang;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Arr;

class TestController extends LayoutController
{
   function index()
   {
      $segment = 1;
      $segment2 = 2;
      $class_alias = trim(request()->segment($segment) ?? '');
      $test_code = trim(request()->segment($segment2) ?? '');
      if ($class_alias === '' && $test_code === '') {
         abort(404);
      }
      $args = array();
      $section_class_none = (new LopHocPhan)->gets($args);
      $this->_data['load_section_class'] = $section_class_none;
      $args['alias'] = $class_alias;

      $section_class = (new LopHocPhan)->gets($args);
      $args['class_alias'] = $class_alias;
      $args['test_code'] = $test_code;
      $test = (new Baikiemtra)->gets($args);
      $tieu_de = $test[0]->tieu_de ?? 'Không có tiêu đề';
      $this->_data['tieu_de_test'] = $tieu_de;
      $this->_data['test'] = $test;
      $test_questions = '';
      $array_question = array();
      if (!empty($test)) {
         $test_questions = $test[0]->noi_dung;
         $array_question = @unserialize($test_questions);
      }

      $lessons = (new Baigiang)->gets($args);


      $this->_data['array_question'] = $array_question;
      $this->_data['section_class'] = $section_class;
      $this->_data['lessons'] = $lessons;
      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';
      // $this->_data['test'] = 'test';
      // $this->_data['content'] = $content;
      // print_r($this->_data['test']);
      return view(config('asset.view_page')('test-client'), $this->_data);
   }
   function test_list()
   {
      $segment = 1;
      $class_alias = trim(request()->segment($segment) ?? '');
      if ($class_alias === '') {
         abort(404);
      }
      $args = array();
      $section_class_none = (new LopHocPhan)->gets($args);
      $this->_data['load_section_class'] = $section_class_none;
      $args['class_alias'] = $class_alias;
      $args['alias'] = $class_alias;
      $section_class = (new LopHocPhan)->gets($args);

      $tests = (new Baikiemtra)->gets($args);
      $lessons = (new Baigiang)->gets($args);
      $this->_data['section_class'] = $section_class;
      $this->_data['tests'] = $tests;
      $this->_data['lessons'] = $lessons;
      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';
      // $this->_data['content'] = $content;
      // print_r($array_question);
      // print_r($tests);
      return view(config('asset.view_page')('test-list'), $this->_data);
   }

   function admin_index()
   {
      $args = array();
      $args['order_by'] = 'desc';
      $args['ma_gv'] = Session::get('admin_id');

      $tests = (new Baikiemtra)->gets($args);
      $this->_data['rows'] = $tests;
      return view(config('asset.view_admin_page')('test_management'), $this->_data);
   }

   function admin_add(Request $request)
   {
      $get_req = $request->all();
      $args = array();
      $args['ma_tk'] = Session::get('admin_id');
      $class = (new LopHocPhan)->gets($args);
      $this->_data['class'] = $class;
      if (!empty($get_req)) {
         $validated = $request->validate(
            [
               'tieu_de' => 'required|max:255',
               'label' => 'required|max:255',
               'answer1' => 'required',
               'answer2' => 'required',
               'answer3' => 'required',
               'answer4' => 'required',
            ],
            [
               'tieu_de.required' => 'Vui lòng nhập tiêu đề.',
               'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
               'label.required' => 'Tiêu đề câu hỏi không được để trống.',
               'label.max' => 'Tiêu đề câu hỏi không được vượt quá 255 ký tự.',
               'answer1.required' => 'Đáp án không được bỏ trống.',
               'answer2.required' => 'Đáp án không được bỏ trống.',
               'answer3.required' => 'Đáp án không được bỏ trống.',
               'answer4.required' => 'Đáp án không được bỏ trống.',
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
      return view(config('asset.view_admin_control')('control_test'), $this->_data);

      // print_r($result);
   }
   function admin_delete()
   {
      $role = Session::get('admin_role');
      if (!$role) {
         return Redirect::to('/admin');
      }
      Session::put('error', 'warning');
      Session::put('message', 'Bạn không có quyền xóa dữ liệu này.');
      if ($role == 2) {
         $ma_tk = Session::get('admin_id');

         $segment = 2;
         $id_test = trim(request()->segment($segment) ?? '');
         $result = (new Baikiemtra())->admin_delete($id_test, $ma_tk);

         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Xoá bài kiểm tra thành công.');
         } else {
            return back();
         }
         return Redirect::to('/danh-sach-bai-kiem-tra');
      }
      return back();

   }
}
