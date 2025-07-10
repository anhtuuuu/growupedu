<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\DanhGia;
use App\Models\Taikhoan;
use Illuminate\Http\Request;
use Session;

class LecturerController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('lecturer_management'));
    }
    function admin_index(Request $request)
    {
        $args = array();
        $role_id = Session::get('admin_role');
        if (!$role_id) {
            abort(404);
        }
        $args['role'] = 2;
        $args['per_page'] = 5;
        if ($role_id == 2) {
            $ma_tk = Session::get('admin_id');
            $args['ma_gv'] = $ma_tk;
        }
        $lecturers = (new Taikhoan)->gets($args);
        $stars = [];
        $counts = [];
        foreach ($lecturers as $lec) {
            $args_assess = array();
            $args_assess['ma_gv'] = $lec->ma_tk;
            $assess = (new DanhGia())->gets($args_assess);
            $star = 0;
            $count = (count($assess));
            if (!empty($assess)) {
                $sum = 0;
                foreach ($assess as $a) {
                    $sum += $a->so_sao;
                }
                $star = ($sum / $count);
            }
            $stars[] = $star;
            $counts[] = $count;
        }

        $this->_data['rows'] = $lecturers;
        $this->_data['stars'] = $stars;
        $this->_data['counts'] = $counts;

        $args_empty = array();
        $list_filter = (new BoMon())->gets($args_empty);
        $filter = array();
        foreach ($list_filter as $index => $value) {
            $filter[$index]['value'] = $value->ma_bm;
            $filter[$index]['title'] = $value->ten_bm;
        }
        $this->_data['filter'] = $filter;
        $this->_data['filter_link'] = 'danh-sach-giang-vien/';

        $get_req = $request->all();
        if (!empty($get_req)) {
            $value_filter = $request->cat_id;
            $key_word = $request->key_word;
            $this->_data['value_filter'] = $value_filter;
            $this->_data['key_word'] = $key_word;

            if ($value_filter != 0) {
                $args['filter2'] = $value_filter;
            }
            if (!empty($key_word)) {
                $args['key_word'] = $key_word;
            }

            $data = (new Taikhoan())->gets($args);
            $this->_data['rows'] = $data;
        }
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('lecturer_management'), $this->_data);
    }
}
