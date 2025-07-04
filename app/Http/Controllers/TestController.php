<?php

namespace App\Http\Controllers;

use App\Models\NopBaiKiemTra;
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
      $section_class_none = $this->section_class();
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

      return view(config('asset.view_page')('test-client'), $this->_data);
   }
   function test_submit(Request $request)
   {
      $get_req = $request->all();
      if (empty($get_req)) {
         abort(404);
      }
      // $validated = $request->validate(
      //    [
      //       'question.*' => 'required',
      //    ],
      //    [
      //       'question.*.required' => 'Vui lòng chọn đáp án.',
      //    ]
      // );
      $questions = $request->question;
      $answers = '';
      foreach ($questions as $ques) {
         $answers .= $ques . ";";
      }
      $test_data = (new Baikiemtra)->get_by_id($request->ma_bkt);
      $answers_req = explode(";", $answers);
      $answers_true = explode(";", $test_data->dap_an);
      $result = 0;
      foreach ($answers_true as $index => $asw) {
         if ($asw == $answers_req[$index]) {
            $result++;
         }
      }
      $result = $result - 1;
      $count = count($answers_true) - 1;
      $score = ($result / $count) * 10;
      $score = round($score, 1);
      $data = [
         'ma_tk' => Session::get('client_id'),
         'ma_bkt' => $request->ma_bkt,
         'tra_loi' => $answers,
         'diem_so' => $score,
      ];
      $result_insert = (new NopBaiKiemTra)->add($data);
      if ($result_insert) {
         Session::put('error', 'success');
         Session::put('message', 'Nộp bài tập thành công.');
      } else {
         Session::put('error', 'warning');
         Session::put('message', 'Nộp bài tập thất bại!');
      }
      return back();

   }
   function test_list()
   {
      $segment = 1;
      $class_alias = trim(request()->segment($segment) ?? '');
      if ($class_alias === '') {
         abort(404);
      }
      $args = array();
      $section_class_none = $this->section_class();
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

      $args = [];
      $args['ma_tk'] = Session::get('client_id');
      $check_submited = (new NopBaiKiemTra)->gets($args);
      if (!empty($check_submited)) {
         $this->_data['check_submited'] = $check_submited;
      }
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
      $args['per_page'] = 5;
      $tests = (new Baikiemtra)->gets($args);
      $this->_data['rows'] = $tests;
      return $this->_auth_login() ?? view(config('asset.view_admin_page')('test_management'), $this->_data);
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
               'label.*' => 'required|max:255',
               'answer1.*' => 'required',
               'answer2.*' => 'required',
               'answer3.*' => 'required',
               'answer4.*' => 'required',
            ],
            [
               'tieu_de.required' => 'Vui lòng nhập tiêu đề.',
               'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
               'label.*.required' => 'Tiêu đề câu hỏi không được để trống.',
               'label.*.max' => 'Tiêu đề câu hỏi không được vượt quá 255 ký tự.',
               'answer1.*.required' => 'Đáp án không được bỏ trống.',
               'answer2.*.required' => 'Đáp án không được bỏ trống.',
               'answer3.*.required' => 'Đáp án không được bỏ trống.',
               'answer4.*.required' => 'Đáp án không được bỏ trống.',
            ]
         );

         $questions = array();
         $labels = $request->input('label');
         $answer1 = $request->input('answer1');
         $answer2 = $request->input('answer2');
         $answer3 = $request->input('answer3');
         $answer4 = $request->input('answer4');

         $answers = $request->input('dap_an');
         $dap_an = '';
         foreach ($answers as $ans) {
            $dap_an .= ($ans . ";");
         }
         foreach ($labels as $i => $label) {
            $questions[] = [
               'label' => $label,
               'answer1' => $answer1[$i] ?? null,
               'answer2' => $answer2[$i] ?? null,
               'answer3' => $answer3[$i] ?? null,
               'answer4' => $answer4[$i] ?? null,
            ];
         }

         $attributes = serialize($questions);
         $data = [
            'ma_lhp' => $request->ma_lhp,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $attributes,
            'dap_an' => $dap_an
         ];
         $result = (new BaiKiemTra)->add($data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Thêm bài kiểm tra thành công');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Thêm bài kiểm tra thất bại');
         }
         return Redirect::to('/danh-sach-bai-kiem-tra');
      }
      return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_test'), $this->_data);

      // print_r($result);
   }

   function admin_update(Request $request)
   {
      $args = array();
      $args['ma_tk'] = Session::get('admin_id');
      $class = (new LopHocPhan)->gets($args);
      $this->_data['class'] = $class;
      $get_req = $request->all();
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');

      if (!empty($get_req)) {

         $id_test = $request->ma_bkt;
         $test = (new Baikiemtra)->get_by_id($id_test);
         $validated = $request->validate(
            [
               'tieu_de' => 'required|max:255',
               'label.*' => 'required|max:255',
               'answer1.*' => 'required',
               'answer2.*' => 'required',
               'answer3.*' => 'required',
               'answer4.*' => 'required',
            ],
            [
               'tieu_de.required' => 'Vui lòng nhập tiêu đề.',
               'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
               'label.*.required' => 'Tiêu đề câu hỏi không được để trống.',
               'label.*.max' => 'Tiêu đề câu hỏi không được vượt quá 255 ký tự.',
               'answer1.*.required' => 'Đáp án không được bỏ trống.',
               'answer2.*.required' => 'Đáp án không được bỏ trống.',
               'answer3.*.required' => 'Đáp án không được bỏ trống.',
               'answer4.*.required' => 'Đáp án không được bỏ trống.',
            ]
         );

         if (empty($test)) {
            abort(404);
         }
         $questions = array();
         $labels = $request->input('label');
         $answer1 = $request->input('answer1');
         $answer2 = $request->input('answer2');
         $answer3 = $request->input('answer3');
         $answer4 = $request->input('answer4');

         $answers = $request->input('dap_an');
         $dap_an = '';
         foreach ($answers as $ans) {
            $dap_an .= ($ans . ";");
         }
         foreach ($labels as $i => $label) {
            $questions[] = [
               'label' => $label,
               'answer1' => $answer1[$i] ?? null,
               'answer2' => $answer2[$i] ?? null,
               'answer3' => $answer3[$i] ?? null,
               'answer4' => $answer4[$i] ?? null,
            ];
         }

         $attributes = serialize($questions);
         $data = [
            'ma_lhp' => $request->ma_lhp,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $attributes,
            'dap_an' => $dap_an
         ];
         $result = (new Baikiemtra)->admin_update($id_test, $data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Cập nhật bài kiểm tra thành công.');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
         }
         return Redirect::to('danh-sach-bai-kiem-tra');
      }

      $test_content = (new Baikiemtra)->get_by_id($id);
      if (empty($test_content)) {
         abort(404);
      }
      $this->_data['row'] = $test_content;
      return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_test'), $this->_data);
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

   function test_list_submited()
   {
      $role = Session::get('admin_id');
      if (empty($role)) {
         Redirect::to('/');
      }
      $args = array();
      $args['ma_gv'] = $role;
      $args['order_by'] = 'desc';
      $args['per_page'] = 10;
      $tests = (new NopBaiKiemTra())->gets($args);
      // print_r($tests);
      $this->_data['rows'] = $tests;
      return $this->_auth_login() ?? view(config('asset.view_admin_page')('test_submited'), $this->_data);
   }
}
