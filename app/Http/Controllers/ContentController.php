<?php

namespace App\Http\Controllers;

use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\LopHocPhan;
use App\Models\Taikhoan;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Session;
use Storage;

class ContentController extends LayoutController
{
    function index()
    {
        $segment = 2;
        $segment2 = 4;
        $class_alias = Session::has('class_alias') ? Session::get('class_alias') : '';
        $lesson_alias = trim(request()->segment($segment) ?? '');
        $content_alias = trim(request()->segment($segment2) ?? '');

        if ($lesson_alias === '' || $content_alias === '' || $class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = $this->section_class();
        $this->_data['load_section_class'] = $section_class_none;
        $this->_data['notification'] = $this->notification();
        $args['alias_lesson'] = $lesson_alias;
        $args['alias_content'] = $content_alias;
        $args['hien_thi'] = true;
        $lesson = (new BaiGiang)->gets($args);
        $content = (new BaiGiang)->gets($args);

        if (empty($lesson) || empty($content)) {
            abort(404);
            return;
        }
        $chapters = (new Chuong)->gets($args);
        $contents = (new Bai)->gets($args);

        $lecturer = (new Taikhoan)->get_by_id($lesson[0]->ma_tk);
        if (!empty($lecturer)) {
            $this->_data['lecturer'] = $lecturer;
        }
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
        $args['per_page'] = 5;
        $args['order_by'] = 'desc';
        $args['ma_gv'] = Session::get('admin_id');
        $segment = 1;
        $chapter_alias = trim(request()->segment($segment) ?? '');
        if ($chapter_alias === '') {
            abort(404);
        }
        $args['alias_chapter'] = $chapter_alias;
        $contents = (new Bai)->gets($args);
        $this->_data['rows'] = $contents;
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('content_management'), $this->_data);
    }

    function files()
    {
        $class_alias = Session::has('class_alias') ? Session::get('class_alias') : '';
        $segment = 2;
        $lesson_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '' || $lesson_alias === '') {
            abort(404);
        }

        $args = array();
        $section_class_none = $this->section_class();
        $this->_data['load_section_class'] = $section_class_none;
        $this->_data['notification'] = $this->notification();
        $args['alias_class'] = $class_alias;
        $args['alias_lesson'] = $lesson_alias;
        $args['hien_thi'] = true;
        $lesson = (new BaiGiang)->gets($args);

        if (empty($lesson)) {
            abort(404);
            return;
        }
        $contents = (new Bai)->gets($args);
        $this->_data['contents'] = $contents;
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
        session(['KCFINDER' => ['disabled' => false]]);

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
                $get_chapter = (new Chuong())->get_by_id($request->ma_chuong);
                if (!empty($get_chapter)) {
                    $get_lesson_id = $get_chapter->ma_bg;
                    $args = array();
                    $args['id_lesson'] = $get_lesson_id;
                    $get_class = (new LopHocPhan())->gets($args);
                    if (!empty($get_class)) {
                        foreach ($get_class as $cls) {
                            $notice = [
                                'ma_lhp' => $cls->ma_lhp,
                                'ho_ten' => Session::get('admin_name'),
                                'mo_ta' => 'đã đăng một bài học mới',
                                'noi_dung' => $request->tieu_de. ' ('.$get_chapter->ten_chuong.')',
                            ];
                            (new ThongBao())->add($notice);
                        }
                    }
                }
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Chưa có dữ liệu nào được thêm.');
            }
            return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_content'), $this->_data);
        }
        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_content'), $this->_data);
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
            return back();
        }

        $content = (new Bai())->get_by_id($id);
        if (empty($content)) {
            abort(404);
        }
        $chapter_id = $content->ma_chuong;
        $chapter = (new Chuong())->get_by_id($chapter_id);
        $lesson_id = $chapter->ma_bg;
        $args['id_lesson'] = $lesson_id;
        $chapters = (new Chuong)->gets($args);
        $this->_data['chapters'] = $chapters;
        $this->_data['chapter_id'] = $chapter_id;
        $this->_data['lesson_id'] = $lesson_id;
        $this->_data['row'] = $content;
        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_content'), $this->_data);
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
            $code_bai = trim(request()->segment($segment) ?? '');
            $result = (new Bai())->admin_delete($code_bai, $ma_tk);
            if ($result) {
                Session::put('error', 'success');
                Session::put('message', 'Xoá bài thành công.');
            } else {
                return back();
            }
            return back();
        }
        return back();
    }
    function store(Request $request)
    {
        $request->validate([
            'base64' => 'required|string',
            'filename' => 'required|string'
        ]);

        $base64 = $request->input('base64');
        $filename = $request->input('filename');

        // Tách phần base64
        if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
            $base64 = substr($base64, strpos($base64, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            $filePath = "images/" . $filename;
            Storage::disk('public')->put($filePath, base64_decode($base64));

            return response()->json([
                'url' => Storage::url($filePath)
            ]);
        }

        return response()->json(['error' => 'Invalid image data'], 400);
    }
    function update_status()
    {
        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');
        if (empty($id)) {
            abort(404);
        }
        $class = (new Bai())->get_by_id($id);
        $data = [
            'hien_thi' => $class->hien_thi == 1 ? 0 : 1
        ];
        $result = (new Bai())->admin_update($id, $data);
        return $result;
    }
}
