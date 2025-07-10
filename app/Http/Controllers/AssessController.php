<?php

namespace App\Http\Controllers;

use App\Models\BaiGiang;
// use App\Models\LhpBg;
use App\Models\DanhGia;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
class AssessController extends LayoutController
{
   function index()
   {
      $segment = 2;
      $class_alias = trim(request()->segment($segment) ?? '');
      if ($class_alias === '') {
         abort(404);
      }
      $section_class_none = $this->section_class();
      $this->_data['load_section_class'] = $section_class_none;
      $this->_data['notification'] = $this->notification();
      $args = array();
      $args['alias'] = $class_alias;
      $section_class = (new LopHocPhan)->gets($args);

      if (empty($section_class)) {
         abort(404);
         return;
      }
      $args['ma_bg'] = $section_class[0]->ma_bg;

      $args['hien_thi'] = true;
      $lessons = (new BaiGiang)->gets($args);

      // $section_class = (new LopHocPhan)->gets($args);
      $this->_data['class_name'] = $section_class[0]->ten_lhp;
      $this->_data['class_id'] = $section_class[0]->ma_lhp;

      $this->_data['section_class'] = $section_class;
      $this->_data['lessons'] = $lessons;
      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';

      return view(config('asset.view_page')('assess'), $this->_data);
   }
   function assess_request(Request $request)
   {
      $get_req = $request->all();
      if (empty($get_req)) {
         abort(404);
      }
      $validated = $request->validate(
         [
            'noi_dung' => 'required|max:255',
         ],
         [
            'noi_dung.required' => 'Vui lòng nhập nội dung.',
            'noi_dung.max' => 'Nội dung tối đa 255 ký tự.'
         ]
      );
      $data = [
         'ma_tk' => Session::get('client_id'),
         'ma_lhp' => $request->ma_lhp,
         'so_sao' => $request->so_sao,
         'noi_dung' => $request->noi_dung,
      ];
      $ma_tk = Session::get('client_id');
      $ma_lhp = $request->ma_lhp;      
      $args = array();
      $args['ma_tk'] = $ma_tk;
      $args['ma_lhp'] = $ma_lhp;
      $check_existed = (new DanhGia)->gets( $args);
      if(!empty($check_existed)){
         $get_assess_id = $check_existed[0]->id;
         $result = (new DanhGia)->admin_update($get_assess_id,$data);
      }
      else{
         $result = (new DanhGia)->add($data);
      }
      if ($result) {
         Session::put('error', 'success');
         Session::put('message', 'Đã gửi đánh giá thành công.');
      } else {
         Session::put('error', 'danger');
         Session::put('message', 'Gửi đánh giá thất bại.');
      }
      return back();
   }
   function admin_index(Request $request)
   {
      $args = array();
      $ma_tk = Session::get('admin_id');
      $args['ma_gv'] = $ma_tk;

      $args['order_by'] = 'desc';
      $args['per_page'] = 5;
      $assess = (new DanhGia)->gets($args);
      $this->_data['rows'] = $assess;

      $args_filter = array();
      $args_filter['ma_tk'] = Session::get('admin_id');
      $list_filter = (new LopHocPhan())->gets($args_filter);
      $filter = array();
      foreach ($list_filter as $index => $value) {
         $filter[$index]['value'] = $value->ma_lhp;
         $filter[$index]['title'] = $value->ten_lhp;
      }
      $this->_data['filter'] = $filter;
      $this->_data['filter_link'] = 'danh-sach-danh-gia/';

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
         $data = (new DanhGia())->gets($args);
         $this->_data['rows'] = $data;
      }
      return $this->_auth_login() ?? view(config('asset.view_admin_page')('assess_management'), $this->_data);
   }
   function assess_detail()
   {
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');
      if ($id === '') {
         abort(404);
      }
      $detail = (new DanhGia)->get_by_id($id);

      $class_id = $detail->ma_lhp;
      $class = (new LopHocPhan)->get_by_id($class_id);

      $this->_data['data_assess'] = $detail;
      $this->_data['data_class'] = $class;
      return $this->_auth_login() ?? view(config('asset.view_admin_page')('assess_detail'), $this->_data);
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
         $id_assess = trim(request()->segment($segment) ?? '');
         $result = (new DanhGia())->admin_delete($id_assess);

         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Xoá đánh giá thành công.');
         } else {
            return back();
         }
         return back();

      }
      return back();

   }
}
