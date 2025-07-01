<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\Khoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
class DepartmentController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('department_management'));
    }
    function admin_index()
    {
        $args = array();
        $department = (new Khoa)->gets($args);
        $this->_data['rows'] = $department;
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('department_management'), $this->_data);
    }
    function admin_add(Request $request)
    {
        $get_req = $request->all();
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'ten_khoa' => 'required|max:255',
                    'alias' => 'required|max:255|unique:khoa',
                ],
                [
                    'ten_khoa.required' => 'Vui lòng nhập tên khoa.',
                    'ten_khoa.max' => 'Tên khoa không được vượt quá 255 ký tự.',
                    'alias.required' => 'Liên kết tĩnh không được để trống.',
                    'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
                    'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
                ]
            );
            $data = [

                'ten_khoa' => $request->ten_khoa,
                'alias' => $request->alias,
                'mo_ta' => $request->mo_ta
            ];
            $result = (new Khoa)->add($data);
            if ($result) {
                $this->_data['error'] = 'success';
                $this->_data['message'] = 'Thêm khoa thành công';
            } else {
                $this->_data['error'] = 'danger';
                $this->_data['message'] = 'Thêm khoa thất bại';
            }
            return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_department'), $this->_data);
        }
        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_department'));

    }

   function admin_update(Request $request)
   {
      $get_req = $request->all();
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');

      if (!empty($get_req)) {

         $id_department = $request->ma_khoa;
         $department = (new Khoa)->get_by_id($id_department);
         $validated = $request->validate(
            [
               'ten_khoa' => 'required|max:255',
               'alias' => 'required|max:255' . ($department->alias == $request->alias ? '' : '|unique:khoa'),
            ],
            [
               'ten_khoa.required' => 'Vui lòng nhập tên khoa.',
               'ten_khoa.max' => 'Tên khoa không được vượt quá 255 ký tự.',
               'alias.required' => 'Liên kết tĩnh không được để trống.',
               'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
               'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
            ]
         );

         if (empty($department)) {
            abort(404);
         }
         if ($department->alias == $request->alias) {
            $data = [
               'ten_khoa' => $request->ten_khoa,
               'mo_ta' => $request->mo_ta
            ];
         } else {
            $data = [
               'ten_khoa' => $request->ten_khoa,
               'alias' => $request->alias,
               'mo_ta' => $request->mo_ta
            ];
         }
         $result = (new Khoa)->admin_update($id_department, $data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Cập nhật khoa thành công.');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
         }
         return Redirect::to('danh-sach-khoa');
      }
      
      $department = (new Khoa)->get_by_id($id);
      if (empty($department)) {
         abort(404);
      }
      $this->_data['row'] = $department;
      return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_department'), $this->_data);
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
            $code_khoa = trim(request()->segment($segment) ?? '');
            if (empty($code_khoa)) {
               abort(404);
            }
            $args = array();
            $args['id_khoa'] = $code_khoa;
            $bomon_list = (new BoMon())->gets($args);
            Session::put('error', 'warning');
            Session::put('message', 'Yêu cầu xóa dữ liệu bộ môn trong khoa trước khi xóa khoa!');
            if (empty($bomon_list)) {
               $result = (new Khoa())->admin_delete($code_khoa);
               if ($result) {
                  Session::put('error', 'success');
                  Session::put('message', 'Xoá khoa thành công.');
               } else {
                  return back();
               }
            }
            return back();

         }
         return back();

      }

}
