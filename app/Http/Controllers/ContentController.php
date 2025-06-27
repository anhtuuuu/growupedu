<?php

namespace App\Http\Controllers;

use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Session;

class ContentController extends LayoutController
{
    function index()
    {
        $segment0 = 1;

        $segment = 2;
        $segment2 = 4;
        $class_alias = trim(request()->segment($segment0) ?? '');

        $lesson_alias = trim(request()->segment($segment) ?? '');
        $content_alias = trim(request()->segment($segment2) ?? '');

        if ($lesson_alias === '' || $content_alias === '' || $class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = (new LopHocPhan)->gets($args);
        $this->_data['load_section_class'] = $section_class_none;
        $args['alias'] = $class_alias;
        $section_class = (new LopHocPhan)->gets($args);
        $this->_data['section_class'] = $section_class;
        $args['alias_lesson'] = $lesson_alias;
        $args['alias_content'] = $content_alias;

        $lesson = (new BaiGiang)->gets($args);
        $content = (new BaiGiang)->gets($args);

        if (empty($lesson) || empty($content)) {
            abort(404);
            return;
        }

        $chapters = (new Chuong)->gets($args);
        $contents = (new Bai)->gets($args);

        $this->_data['chapters'] = $chapters;
        $this->_data['contents'] = $contents;
        $this->_data['lessons'] = $lesson;

        $this->_data['type_side_none'] = 'lesson';
        $this->_data['left_side_none'] = '';

        $row = (new Bai)->get_by_alias($content_alias);
        $this->_data['row'] = $row;

        return view(config('asset.view_page')('lesson'), $this->_data);
    }
    function admin_index()
    {
        $args = array();
        $contents = (new Bai)->gets($args);
        $this->_data['rows'] = $contents;
        return view(config('asset.view_admin_page')('content_management'), $this->_data);
    }

    function files()
    {
        $segment = 1;
        $class_alias = trim(request()->segment($segment) ?? '');
        $segment = 2;
        $lesson_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '' || $lesson_alias === '') {
            abort(404);
        }

        $args = array();
        $section_class_none = (new LopHocPhan)->gets($args);
        $this->_data['load_section_class'] = $section_class_none;
        $args['alias_class'] = $class_alias;
        $args['alias_lesson'] = $lesson_alias;

        $lesson = (new BaiGiang)->gets($args);


        if (empty($lesson)) {
            abort(404);
            return;
        }

        // $courses = (new Chuong)->gets($args);
        $contents = (new Bai)->gets($args);

        // $data = array();
        // $data['courses'] = $courses;
        // $data['contents'] = $contents;
        $args['alias'] = $class_alias;

        $section_class = (new LopHocPhan())->gets($args);


        $this->_data['contents'] = $contents;
        $this->_data['section_class'] = $section_class;
        $this->_data['lessons'] = $lesson;

        $this->_data['type_side_none'] = 'lesson';
        $this->_data['left_side_none'] = '';

        return view(config('asset.view_page')('lesson-files'), $this->_data);
    }
    function admin_add(Request $request)
    {
        $args = array();
        $args['ma_tk'] = Session::get('admin_id');
        $lessons = (new BaiGiang)->gets($args);
        $this->_data['lessons'] = $lessons;

        // $data=(new Chuong())->gets($args);
        // $this->_data['table_chuong'] = $data;

        $get_req = $request->all();
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'alias_bg' => 'required',
                    'ma_chuong' => 'required',
                    'tieu_de' => 'required|max:255',
                    'alias' => 'required|max:255|unique:bai',
                ],
                [
                    'alias_bg.required' => 'Vui lòng chọn bài giảng.',
                    'ma_chuong.required' => 'Vui lòng chọn chương.',
                    'tieu_de.required' => 'Vui lòng nhập tiêu đề.',
                    'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
                    'alias.required' => 'Liên kết tĩnh không được để trống.',
                    'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
                    'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
                ]
            );
            $data = [
                'ma_chuong' => $request->ma_chuong,
                'tieu_de' => $request->tieu_de,
                'alias' => $request->alias,
                'mo_ta' => $request->mo_ta,
                'noi_dung' => $request->noi_dung,
                'video' => $request->video,
                'lien_ket' => $request->lien_ket,
            ];
            $result = (new Bai())->add($data);
            if ($result) {
                Session::put('error', 'success');
                Session::put('message', 'Thêm bài thành công.');
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Chưa có dữ liệu nào được thêm.');
            }
            return view(config('asset.view_admin_control')('control_content'), $this->_data);
        }
        return view(config('asset.view_admin_control')('control_content'), $this->_data);
    }


    function admin_update(Request $request)
    {
        $get_req = $request->all();
        $args = array();
        $args['ma_tk'] = Session::get('admin_id');
        $lessons = (new BaiGiang)->gets($args);
        $this->_data['lessons'] = $lessons;
        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');

        if (!empty($get_req)) {

            $id_content = $request->ma_bai;
            $content = (new Bai())->get_by_id($id_content);
            $validated = $request->validate(
                [
                    'alias_bg' => 'required',
                    'ma_chuong' => 'required',
                    'tieu_de' => 'required|max:255',
                    'alias' => 'required|max:255' . ($content->alias == $request->alias ? '' : '|unique:bai'),       
                         ],
                [
                    'alias_bg.required' => 'Vui lòng chọn bài giảng.',
                    'ma_chuong.required' => 'Vui lòng chọn chương.',
                    'tieu_de.required' => 'Vui lòng nhập tiêu đề.',
                    'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
                    'alias.required' => 'Liên kết tĩnh không được để trống.',
                    'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
                    'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
                ]
            );

            if (empty($content)) {
                abort(404);
            }
            if ($content->alias == $request->alias) {
                $data = [
                'ma_chuong' => $request->ma_chuong,
                'tieu_de' => $request->tieu_de,
                'mo_ta' => $request->mo_ta,
                'noi_dung' => $request->noi_dung,
                'video' => $request->video,
                'lien_ket' => $request->lien_ket,
                ];
            } else {
                $data = [
                'ma_chuong' => $request->ma_chuong,
                'tieu_de' => $request->tieu_de,
                'alias' => $request->alias,
                'mo_ta' => $request->mo_ta,
                'noi_dung' => $request->noi_dung,
                'video' => $request->video,
                'lien_ket' => $request->lien_ket,
                ];
            }
            $result = (new Bai())->admin_update($id_content, $data);
            if ($result) {
                Session::put('error', 'success');
                Session::put('message', 'Cập nhật bài thành công.');
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
            }
            return Redirect::to('danh-sach-bai');
        }

        $content = (new Bai())->get_by_id($id);
        if (empty($content)) {
            abort(404);
        }
        $chapter_id= $content->ma_chuong;
        $chapter=(new Chuong())->get_by_id($chapter_id);
        $lesson_id=$chapter->ma_bg;
        $args['id_lesson'] = $lesson_id;
        $chapters = (new Chuong)->gets($args);
        $this->_data['chapters']= $chapters;
        $this->_data['chapter_id'] = $chapter_id;
        $this->_data['lesson_id'] = $lesson_id;
        $this->_data['row'] = $content;
        return view(config('asset.view_admin_control')('control_content'), $this->_data);
    }
    function gets_chapter()
    {
        $segment = 2;
        $lesson_alias = trim(request()->segment($segment) ?? '');
        $args = array();
        $args['alias_lesson'] = $lesson_alias;
        $chapters = (new Chuong)->gets($args);
        // print_r($chapters);
        $html = '';
        foreach ($chapters as $chap) {
            $html .= '<option value="' . $chap->ma_chuong . '" >' . $chap->ten_chuong . '</option>';
        }
        return $html;
    }
}
