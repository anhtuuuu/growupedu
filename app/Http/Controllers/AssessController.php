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
      $args = array();
      $section_class_none = (new LopHocPhan)->gets($args);
      $this->_data['load_section_class'] = $section_class_none;
      $args['alias'] = $class_alias;
      $section_class = (new LopHocPhan)->gets($args);

      if (empty($section_class)) {
         abort(404);
         return;
      }
      $lessons = (new BaiGiang)->gets($args);

      // $section_class = (new LopHocPhan)->gets($args);
      $this->_data['class_name'] = $section_class[0]->ten_lhp;
      $this->_data['section_class'] = $section_class;
      $this->_data['lessons'] = $lessons;
      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';

      return view(config('asset.view_page')('assess'), $this->_data);
   }
   function admin_index()
   {
      $args = array();
      $args['order_by'] = 'desc';
      $args['ma_gv'] = Session::get('admin_id');

      $assess = (new DanhGia)->gets($args);
      $this->_data['rows'] = $assess;
      return view(config('asset.view_admin_page')('assess_management'), $this->_data);
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
      return view(config('asset.view_admin_page')('assess_detail'), $this->_data);
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
         $id_assess = trim(request()->segment($segment) ?? '');
         $result = (new DanhGia())->admin_delete($id_assess, $ma_tk);

         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Xoá đánh giá thành công.');
         } else {
            return back();
         }
         return Redirect::to('/danh-sach-danh-gia');
      }
      return back();

   }
}
