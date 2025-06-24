<?php

namespace App\Http\Controllers;

use App\Models\BaiGiang;
// use App\Models\LhpBg;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
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

      $section_class = (new LopHocPhan)->gets($args);
      $args['alias'] = $class_alias;

      if (empty($section_class )) {
         abort(404);
         return;
      }
        $lessons = (new BaiGiang)->gets($args);

      // $section_class = (new LopHocPhan)->gets($args);
      $this->_data['class_name'] = $section_class[0]->ten_lhp;
      $this->_data['load_section_class'] = $section_class;
      $this->_data['section_class'] = $section_class;
      $this->_data['lessons'] = $lessons;
      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';

      return view(config('asset.view_page')('assess'), $this->_data);
   }
   function admin_index()
   {
      return view(config('asset.view_admin_page')('assess'));
   }
   function assess_detail($number)
   {
      return view(config('asset.view_admin_page')('assess_detail'));
   }
}
