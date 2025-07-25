<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\HocPhan;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
class CourseController extends LayoutController
{
   function index()
   {
      return view(config('asset.view_admin_page')('course_management'));
   }
   function admin_index(Request $request)
   {
      $args = array();
      $args['per_page'] = 5;
      $course = (new HocPhan)->gets($args);
      $this->_data['rows'] = $course;

      $args_empty = array();
      $list_filter = (new BoMon())->gets($args_empty);
      $filter = array();
      foreach ($list_filter as $index => $value) {
         $filter[$index]['value'] = $value->ma_bm;
         $filter[$index]['title'] = $value->ten_bm;
      }
      $this->_data['filter'] = $filter;
      $this->_data['filter_link'] = 'danh-sach-hoc-phan/';

      $get_req = $request->all();
      if (!empty($get_req)) {
         $value_filter = $request->cat_id;
         $key_word = $request->key_word;
         $this->_data['value_filter'] = $value_filter;
         $this->_data['key_word'] = $key_word;

         if ($value_filter != 0) {
            $args['filter'] = $value_filter;
         }
         if (!empty($key_word)) {
            $args['key_word'] = $key_word;
         }
         $data = (new HocPhan())->gets($args);
         $this->_data['rows'] = $data;
      }
      return $this->_auth_login() ?? view(config('asset.view_admin_page')('course_management'), $this->_data);
   }
   function admin_add(Request $request)
   {
      $args = array();
      $data = (new BoMon())->gets($args);
      $this->_data['table_bm'] = $data;

      $get_req = $request->all();
      if (!empty($get_req)) {
         $validated = $request->validate(
            [
               'ten_hp' => 'required|max:255',
               'alias' => 'required|max:255|unique:hoc_phan',
            ],
            [
               'ten_hp.required' => 'Vui lòng nhập tên học phần.',
               'ten_hp.max' => 'Tên học phần không được vượt quá 255 ký tự.',
               'alias.required' => 'Liên kết tĩnh không được để trống.',
               'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
               'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
            ]
         );
         $data = [
            'ma_bm' => $request->ma_bm,
            'ten_hp' => $request->ten_hp,
            'alias' => $request->alias,
            'mo_ta' => $request->mo_ta
         ];
         $result = (new HocPhan())->add($data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Thêm học phần thành công.');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Thêm học phần thất bại.');
         }
         // return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_course'), $this->_data);
         return Redirect::to('danh-sach-hoc-phan');

      }
      return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_course'), $this->_data);
   }

   function admin_update(Request $request)
   {
      $args = array();
      $data = (new BoMon())->gets($args);
      $this->_data['table_bm'] = $data;
      $get_req = $request->all();
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');

      if (!empty($get_req)) {

         $id_course = $request->ma_hp;
         $course = (new HocPhan())->get_by_id($id_course);
         $validated = $request->validate(
            [
               'ten_hp' => 'required|max:255',
               'alias' => 'required|max:255' . ($course->alias == $request->alias ? '' : '|unique:hoc_phan'),
            ],
            [
               'ten_hp.required' => 'Vui lòng nhập tên học phần.',
               'ten_hp.max' => 'Tên học phần không được vượt quá 255 ký tự.',
               'alias.required' => 'Liên kết tĩnh không được để trống.',
               'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
               'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
            ]
         );

         if (empty($course)) {
            abort(404);
         }
         if ($course->alias == $request->alias) {
            $data = [
               'ma_bm' => $request->ma_bm,
               'ten_hp' => $request->ten_hp,
               'mo_ta' => $request->mo_ta
            ];
         } else {
            $data = [
               'ma_bm' => $request->ma_bm,
               'ten_hp' => $request->ten_hp,
               'alias' => $request->alias,
               'mo_ta' => $request->mo_ta
            ];
         }
         $result = (new HocPhan())->admin_update($id_course, $data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Cập nhật học phần thành công.');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
         }
         return Redirect::to('danh-sach-hoc-phan');
      }

      $course = (new HocPhan())->get_by_id($id);
      if (empty($course)) {
         abort(404);
      }
      $this->_data['row'] = $course;
      return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_course'), $this->_data);
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
         // $ma_tk = Session::get('admin_id');
         $segment = 2;
         $code_course = trim(request()->segment($segment) ?? '');
         if (empty($code_course)) {
            abort(404);
         }
         $args = array();
         $args['id_course'] = $code_course;
         $lhp_list = (new LopHocPhan())->gets($args);
         Session::put('error', 'warning');
         Session::put('message', 'Yêu cầu xóa dữ liệu lớp học phần trong học phần trước khi xóa học phần!');
         if (empty($lhp_list)) {
            $result = (new HocPhan())->admin_delete($code_course);
            if ($result) {
               Session::put('error', 'success');
               Session::put('message', 'Xoá học phần thành công.');
            } else {
               return back();
            }
         }
         return back();

      }
      return back();

   }
}
