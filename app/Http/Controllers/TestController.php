<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHocPhan;
use App\Models\Baikiemtra;
use App\Models\Baigiang;
use Illuminate\Support\Arr;

class TestController extends LayoutController
{
   function index()
   {
      $segment = 1;
      $segment2 = 2;
      $class_alias = trim(request()->segment($segment) ?? '');
      $test_code = trim(request()->segment($segment2) ?? '');
      if ($class_alias === '' && $test_code === '') {
         abort(404);
      }
      $args = array();
      $section_class_none = (new LopHocPhan)->gets($args);
      $this->_data['load_section_class'] = $section_class_none;
      $args['alias'] = $class_alias;

      $section_class = (new LopHocPhan)->gets($args);
      $args['class_alias'] = $class_alias;
      $args['test_code'] = $test_code;
      $test = (new Baikiemtra)->gets($args);
      $test_questions = '';
      $array_question = array();
      if (!empty($test)) {
         $test_questions = $test[0]->noi_dung;
         $array_question = @unserialize($test_questions);
      }

      $lessons = (new Baigiang)->gets($args);


      $this->_data['array_question'] = $array_question;
      $this->_data['section_class'] = $section_class;
      $this->_data['lessons'] = $lessons;
      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';
      // $this->_data['content'] = $content;
      // print_r($array_question);
      return view(config('asset.view_page')('test-client'), $this->_data);
   }
   function test_list()
   {
      $segment = 1;
      $class_alias = trim(request()->segment($segment) ?? '');
      if ($class_alias === '') {
         abort(404);
      }
      $args = array();
      $section_class_none = (new LopHocPhan)->gets($args);
      $this->_data['load_section_class'] = $section_class_none;
      $args['class_alias'] = $class_alias;
      $args['alias'] = $class_alias;
      $section_class = (new LopHocPhan)->gets($args);

      $tests = (new Baikiemtra)->gets($args);
      $lessons = (new Baigiang)->gets($args);
      $this->_data['section_class'] = $section_class;
      $this->_data['tests'] = $tests;
      $this->_data['lessons'] = $lessons;
      $this->_data['type_side_none'] = 'lesson';
      $this->_data['left_side_none'] = '';
      // $this->_data['content'] = $content;
      // print_r($array_question);
      // print_r($tests);
      return view(config('asset.view_page')('test-list'), $this->_data);
   }

   function admin_index()
   {
      $args = array();
      $args['order_by'] = 'desc';
      $tests = (new Baikiemtra)->gets($args);
      $this->_data['rows'] = $tests;
      return view(config('asset.view_admin_page')('test_management'),$this->_data);
   }
}
