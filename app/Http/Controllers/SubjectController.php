<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\Khoa;

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
        return view(config('asset.view_admin_page')('subject_management'), $this->_data);
    }
    function admin_add(Request $request)
    {
        $args = array();
        $data=(new Khoa)->gets($args);
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
                'ma_khoa'=>$request->ma_khoa,
                'ten_bm' => $request->ten_bm,
                'alias' => $request->alias,
                'mo_ta' => $request->mo_ta
            ];
            $result = (new BoMon())->add($data);
            if ($result) {
                $this->_data['error'] = 'success';
                $this->_data['message'] = 'Thêm bộ môn thành công';
            } else {
                $this->_data['error'] = 'danger';
                $this->_data['message'] = 'Thêm bộ môn thất bại';
            }
            return view(config('asset.view_admin_control')('control_department'), $this->_data);
        }
        return view(config('asset.view_admin_control')('control_subject'), $this->_data);
    }
}
