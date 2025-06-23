<?php

namespace App\Http\Controllers;

use App\Models\BaiGiang;
use App\Models\LhpBg;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
class AssessController extends LayoutController
{
   function index()
   {
      $segment = 1;
      $class_alias = trim(request()->segment($segment) ?? '');
      if ($class_alias === '') {
         abort(404);
      }
      $args = array();

      $args['alias'] = $class_alias;
      $class = (new LopHocPhan)->gets($args);

      if (empty($class)) {
         abort(404);
         return;
      }

      $this->_data['class_name'] = $class[0]->ten_lhp;
      $lessons = (new LhpBg)->gets($args);


      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = $lessons;

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
