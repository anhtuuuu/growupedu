<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;

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
        return view(config('asset.view_admin_page')('department_management'), $this->_data);
    }
    function admin_add(Request $request)
    {
        $get_req = $request->all();
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'ten_khoa' => 'required|max:255',
                    'alias' => 'required|max:255|unique:chuong',
                ],
                [
                    'ten_khoa.required' => 'Vui lòng nhập tên bài giảng.',
                    'ten_khoa.max' => 'Tên bài giảng không được vượt quá 255 ký tự.',
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
            return view(config('asset.view_admin_control')('control_department'), $this->_data);
        }
        return view(config('asset.view_admin_control')('control_department'));

    }
}
