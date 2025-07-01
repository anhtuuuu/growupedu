<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\bm;
use App\Models\HocPhan;
use App\Models\Khoa;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Http\Request;

class SubjectController extends LayoutController
{
   function index()
   {
      return view(config('asset.view_admin_page')('subject_management'));
   }
   function admin_index()
   {
      $args = array();
      $subject = (new BoMon)->gets($args);
      $this->_data['rows'] = $subject;
      return $this->_auth_login() ?? view(config('asset.view_admin_page')('subject_management'), $this->_data);
   }
   function admin_add(Request $request)
   {
      $args = array();
      $data = (new Khoa)->gets($args);
      $this->_data['table_khoa'] = $data;

      $get_req = $request->all();
      if (!empty($get_req)) {
         $validated = $request->validate(
            [
               'ten_bm' => 'required|max:255',
               'alias' => 'required|max:255|unique:bo_mon',
            ],
            [
               'ten_bm.required' => 'Vui lòng nhập tên bộ môn.',
               'ten_bm.max' => 'Tên bộ môn không được vượt quá 255 ký tự.',
               'alias.required' => 'Liên kết tĩnh không được để trống.',
               'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
               'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
            ]
         );
         $data = [
            'ma_khoa' => $request->ma_khoa,
            'ten_bm' => $request->ten_bm,
            'alias' => $request->alias,
            'mo_ta' => $request->mo_ta
         ];
         $result = (new BoMon())->add($data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Thêm bộ môn thành công.');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có dữ liệu nào được thêm mới.');
         }
         return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_subject'), $this->_data);
      }
      return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_subject'), $this->_data);
   }

   function admin_update(Request $request)
   {
      $args = array();
      $data = (new Khoa)->gets($args);
      $this->_data['table_khoa'] = $data;
      $get_req = $request->all();
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');

      if (!empty($get_req)) {

         $id_subject = $request->ma_bm;
         $subject = (new BoMon())->get_by_id($id_subject);
         $validated = $request->validate(
            [
               'ten_bm' => 'required|max:255',
               'alias' => 'required|max:255' . ($subject->alias == $request->alias ? '' : '|unique:bo_mon'),
            ],
            [
               'ten_bm.required' => 'Vui lòng nhập tên bộ môn.',
               'ten_bm.max' => 'Tên bộ môn không được vượt quá 255 ký tự.',
               'alias.required' => 'Liên kết tĩnh không được để trống.',
               'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
               'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
            ]
         );

         if (empty($subject)) {
            abort(404);
         }
         if ($subject->alias == $request->alias) {
            $data = [
               'ma_khoa' => $request->ma_khoa,
               'ten_bm' => $request->ten_bm,
               'mo_ta' => $request->mo_ta
            ];
         } else {
            $data = [
               'ma_khoa' => $request->ma_khoa,
               'ten_bm' => $request->ten_bm,
               'alias' => $request->alias,
               'mo_ta' => $request->mo_ta
            ];
         }
         $result = (new BoMon())->admin_update($id_subject, $data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Cập nhật bộ môn thành công.');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
         }
         return Redirect::to('danh-sach-bo-mon');
      }

      $subject = (new BoMon())->get_by_id($id);
      if (empty($subject)) {
         abort(404);
      }
      $this->_data['row'] = $subject;
      return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_subject'), $this->_data);
   }
   function admin_delete()
   {
      $role = Session::get('admin_role');
      if (!$role) {
         return Redirect::to('/admin');
      }
      Session::put('error', 'warning');
      Session::put('message', 'Bạn không có quyền xóa dữ liệu này.');
      if ($role == 1) {
         // $ma_tk = Session::get('admin_id');
         $segment = 2;
         $code_subject = trim(request()->segment($segment) ?? '');
         if (empty($code_subject)) {
            abort(404);
         }
         $args = array();
         $args['id_subject'] = $code_subject;
         $hocphan_list = (new HocPhan())->gets($args);
         Session::put('error', 'warning');
         Session::put('message', 'Yêu cầu xóa dữ liệu học phần trong bộ môn trước khi xóa bộ môn!');
         if (empty($hocphan_list)) {
            $result = (new BoMon())->admin_delete($code_subject);
            if ($result) {
               Session::put('error', 'success');
               Session::put('message', 'Xoá bộ môn thành công.');
            } else {
               return back();
            }
         }
         return back();

      }
      return back();

   }
}
