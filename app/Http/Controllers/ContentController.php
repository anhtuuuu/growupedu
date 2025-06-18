<?php

namespace App\Http\Controllers;

use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use Illuminate\Http\Request;

class ContentController extends LayoutController
{
    function index(){
       $segment = 2;
       $segment2 = 4;

      $lesson_alias = trim(request()->segment($segment) ?? '');
      $content_alias = trim(request()->segment($segment2) ?? '');
      if ($lesson_alias === '' || $content_alias === '') {
         abort(404);
      }
      $args = array();

      $args['alias_lesson'] = $lesson_alias;
      $args['alias_content'] = $content_alias;

      $lesson = (new BaiGiang)->gets($args);
      $content = (new BaiGiang)->gets($args);

      if (empty($lesson) || empty($content)) {
         abort(404);
         return;
      }

      $courses = (new Chuong)->gets($args);      
      $contents = (new Bai)->gets($args);

      $data = array();
      $data['courses'] = $courses;
      $data['contents'] = $contents;

      $this->_data['type_side_none'] = 'chapter';
      $this->_data['left_side_none'] = $data;

      $row = (new Bai)->get_by_alias($content_alias);      
      $this->_data['row'] = $row;

      return view(config('asset.view_page')('lesson'), $this->_data);
    }
    function admin_index(){
       return view(config('asset.view_admin_page')('content_management'));
    }
}
