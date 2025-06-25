<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\HocPhan;
use Illuminate\Http\Request;

class CourseController extends LayoutController
{
    function index(){
       return view(config('asset.view_admin_page')('course_management'));
    }
    function admin_index(){
        $args = array();
        $course = (new HocPhan)->gets($args);
        $this->_data['rows'] = $course;
       return view(config('asset.view_admin_page')('course_management'), $this->_data);
    }
    function admin_add(Request $request)
    {
        $args = array();
        $data=(new BoMon())->gets($args);
        $this->_data['table_bomon'] = $data;
    
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
                $this->_data['error'] = 'success';
                $this->_data['message'] = 'Thêm học phần thành công';
            } else {
                $this->_data['error'] = 'danger';
                $this->_data['message'] = 'Thêm học phần thất bại';
            }
            return view(config('asset.view_admin_control')('control_course'), $this->_data);
        }
        return view(config('asset.view_admin_control')('control_course'), $this->_data);
    }
}
