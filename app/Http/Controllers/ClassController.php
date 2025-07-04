<?php

namespace App\Http\Controllers;
use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\Chuong;
use App\Models\HocPhan;
use App\Models\SinhVien;
use App\Models\TuongTac;
use App\Models\LopHocPhan;
use App\Models\Taikhoan;
use App\Models\Nopbaikiemtra;
use Illuminate\Support\Facades\Redirect;
use Session;

use Illuminate\Http\Request;
use URL;

class ClassController extends LayoutController
{
    function index()
    {
        $segment = 1;
        $class_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = $this->section_class();
        $this->_data['load_section_class'] = $section_class_none;

        $args['alias'] = $class_alias;
        $class = (new LopHocPhan)->gets($args);

        $args['ma_bg'] = $class[0]->ma_bg;
        $lessons = (new BaiGiang)->gets($args);

        $interacts = (new TuongTac)->gets($args);

        if (empty($class) || empty($lessons) || empty($interacts)) {
            abort(404);
            return;
        }

        $args['alias_lesson'] = $lessons[0]->alias;
        $args['order_by'] = 'DESC';

        $chapters = (new Chuong)->gets($args);
        $contents = (new Bai)->gets($args);


        $this->_data['chapters'] = $chapters;
        $this->_data['contents'] = $contents;

        $this->_data['section_class'] = $class;
        $this->_data['lessons'] = $lessons;
        $this->_data['interacts'] = $interacts;

        $this->_data['type_side_none'] = 'lesson';
        // $this->_data['left_side_none'] = $class[0]->ten_lhp;
        $this->_data['left_side_none'] = '';


        return view(config('asset.view_page')('section-class'), $this->_data);
    }
    function detail()
    {


        // return view(config('asset.view_page')('section-class'));
    }
    function admin_index()
    {
        $args = array();
        $args['order_by'] = 'desc';
        $args['ma_tk'] = Session::get('admin_id');
        $args['per_page'] = 5;
        $class = (new LopHocPhan())->gets($args);
        $this->_data['rows'] = $class;
        if (Session::get('admin_id') == 1) {
            $args = array();
            $args['per_page'] = 5;
            $this->_data['rows'] = (new LopHocPhan())->gets($args);
        }
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('class_management'), $this->_data);
    }
    function gets()
    {
        $args = '';
        $class = (new LopHocPhan)->gets($args);
        return $class;
    }
    function interact()
    {
        $segment = 2;
        $class_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = $this->section_class();
        $lessons = (new BaiGiang)->gets($args);
        $this->_data['load_section_class'] = $section_class_none;

        $args['alias'] = $class_alias;
        $class = (new LopHocPhan)->gets($args);
        $args['ma_tk'] = $class[0]->ma_tk;
        // $lessons = (new BaiGiang)->gets($args);

        $interacts = (new TuongTac)->gets($args);

        if (empty($class) || empty($interacts)) {
            abort(404);
            return;
        }
        $is_lecturer = Session::get('client_role');
        if ($is_lecturer == 2) {
            $this->_data['is_lecturer'] = $is_lecturer;
        }

        $this->_data['section_class'] = $class;
        $this->_data['lessons'] = $lessons;
        $this->_data['interacts'] = $interacts;
        $this->_data['type_side_none'] = 'lesson';
        $this->_data['left_side_none'] = '';
        return view(config('asset.view_page')('interact'), $this->_data);
    }
    function submit_interact(Request $request)
    {
        $get_req = $request->all();
        $html = '';
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'noi_dung' => 'required|max:500',
                ],
                [
                    'noi_dung.required' => 'Vui lòng nhập nội dung.',
                    'noi_dung.max' => 'Nội dung chỉ trong khoảng 500 ký tự.',
                ]
            );
            $data = [
                'ma_tk' => Session::get('client_id'),
                'ma_lhp' => $request->ma_lhp,
                'noi_dung' => $request->noi_dung,
            ];
            $result = (new TuongTac)->add($data);
            if (!empty($result)) {
                $interact = (new TuongTac)->get_by_id($result);
                $html .= '<div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item1">
                                <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                    <img class="avatar-student-smaller" width="20px" src="' . URL::to(config('asset.images_path') . $interact->avatar) . '" alt="">
                                </div>
                                <div class="my-auto col-10 p-1">
                                    <div class="d-flex">
                                        <h6 class="small-text"><b>' . $interact->ho_ten . '</b></h6>
                                        <h6 class="small-text px-2">' . $interact->ngay_tao . '</h6>
                                    </div>
                                    <h6 class="small-title">' . $interact->noi_dung . '</h6>
                                </div>
                            </div>';
            }
        }
        return response($html);
    }
    function delete_interact()
    {
        $segment = 2;
        $interact_id = trim(request()->segment($segment) ?? '');
        if (empty($interact_id)) {
            abort(404);
        }
        $result = (new TuongTac)->delete_interact($interact_id);
        if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Đã xóa tương tác.');
        } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa thể xóa tương tác này.');
        }
        return back();
    }
    function core_sheet()
    {
        $segment = 1;
        $segment2 = 2;
        $class_alias = trim(request()->segment($segment) ?? '');
        $test_code = trim(request()->segment($segment2) ?? '');
        if ($class_alias === '' && $test_code === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = $this->section_class();
        $this->_data['load_section_class'] = $section_class_none;
        $args['class_alias'] = $class_alias;
        $section_class = (new LopHocPhan)->gets($args);
        $args['test_code'] = $test_code;

        $accounts = (new Taikhoan)->gets($args);
        $submitted_tests = (new NopBaiKiemTra)->gets($args);
        $lesson = (new BaiGiang)->gets($args);

        $this->_data['lessons'] = $lesson;
        $this->_data['section_class'] = $section_class;
        $this->_data['submitted_tests'] = $submitted_tests;
        $this->_data['type_side_none'] = 'lesson';
        $this->_data['left_side_none'] = '';

        return view(config('asset.view_page')('score-sheet'), $this->_data);
    }
    function core_sheet_list()
    {
        $segment = 1;
        $class_alias = trim(request()->segment($segment) ?? '');
        if ($class_alias === '') {
            abort(404);
        }
        $args = array();
        $section_class_none = $this->section_class();
        $this->_data['load_section_class'] = $section_class_none;
        $args['alias'] = $class_alias;
        $section_class = (new LopHocPhan)->gets($args);
        $args['class_alias'] = $class_alias;
        $submitted_tests = (new NopBaiKiemTra)->gets($args);
        $lesson = (new BaiGiang)->gets($args);

        $this->_data['lessons'] = $lesson;
        $this->_data['section_class'] = $section_class;
        $this->_data['submitted_tests'] = $submitted_tests;
        $this->_data['type_side_none'] = 'lesson';
        $this->_data['left_side_none'] = '';

        return view(config('asset.view_page')('score-sheet-list'), $this->_data);
    }
    function admin_update(Request $request)
    {
        $args = array();
        $data = (new BaiGiang())->gets($args);
        $this->_data['table_baigiang'] = $data;
        $data_course = (new HocPhan())->gets($args);
        $this->_data['table_hocphan'] = $data_course;
        $get_req = $request->all();
        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');

        if (!empty($get_req)) {

            $id_class = $request->ma_lhp;
            $class = (new LopHocPhan())->get_by_id($id_class);
            $validated = $request->validate(
                [
                    'ten_lhp' => 'required|max:255',
                    'alias' => 'required|max:255' . ($class->alias == $request->alias ? '' : '|unique:lop_hoc_phan'),
                ],
                [
                    'ten_lhp.required' => 'Vui lòng nhập tên chương.',
                    'ten_lhp.max' => 'Tên chương không được vượt quá 255 ký tự.',
                    'alias.required' => 'Liên kết tĩnh không được để trống.',
                    'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
                    'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
                ]
            );

            if (empty($class)) {
                abort(404);
            }
            if ($class->alias == $request->alias) {
                $data = [
                    'ten_lhp' => $request->ten_lhp,
                    'ma_tk' => Session::get('admin_id'),
                    'ma_bg' => $request->ma_bg,
                    'ma_hp' => $request->ma_hp,
                    'hinh_anh' => $request->hinh_anh,
                    'mo_ta' => $request->mo_ta
                ];
            } else {
                $data = [
                    'ten_lhp' => $request->ten_lhp,
                    'alias' => $request->alias,
                    'ma_tk' => Session::get('admin_id'),
                    'ma_bg' => $request->ma_bg,
                    'ma_hp' => $request->ma_hp,
                    'hinh_anh' => $request->hinh_anh,
                    'mo_ta' => $request->mo_ta
                ];
            }
            $result = (new LopHocPhan())->admin_update($id_class, $data);

            if ($result && $class->hinh_anh != $request->hinh_anh) {
                $file = $request->file('hinh_anh');
                $filename = $request->hinh_anh_clone;
                if (!empty($request->hinh_anh)) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                }
                $upload_img = (new LopHocPhan())->upload_image($request->alias, $filename);
                Session::put('error', 'success');
                Session::put('message', 'Cập nhật lớp học phần thành công');

                if (!$upload_img) {
                    Session::put('error', 'warning');
                    Session::put('message', 'Cập nhật lớp học phần thành công nhưng chưa upload được hình ảnh.');
                }
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Cập nhật lớp học phần thất bại');
            }
            return Redirect::to('/danh-sach-lop-hoc-phan');
        }
        $class = (new LopHocPhan())->get_by_id($id);
        if (empty($class)) {
            abort(404);
        }
        $this->_data['row'] = $class;
        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_class'), $this->_data);
    }

    function admin_add(Request $request)
    {
        $args = array();
        $data = (new BaiGiang())->gets($args);
        $this->_data['table_baigiang'] = $data;
        $data_course = (new HocPhan())->gets($args);
        $this->_data['table_hocphan'] = $data_course;

        $get_req = $request->all();
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'ten_lhp' => 'required|max:255',
                    'alias' => 'required|max:255|unique:lop_hoc_phan',
                ],
                [
                    'ten_lhp.required' => 'Vui lòng nhập tên lớp học phần.',
                    'ten_lhp.max' => 'Tên lớp học phần không được vượt quá 255 ký tự.',
                    'alias.required' => 'Liên kết tĩnh không được để trống.',
                    'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
                    'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
                ]
            );
            $data = [
                'ten_lhp' => $request->ten_lhp,
                'alias' => $request->alias,
                'ma_tk' => Session::get('admin_id'),
                'ma_bg' => $request->ma_bg,
                'ma_hp' => $request->ma_hp,
                'hinh_anh' => null,
                'mo_ta' => $request->mo_ta
            ];
            $result = (new LopHocPhan())->add($data);
            $class_id = (new LopHocPhan())->get_by_alias($request->alias)->ma_lhp;
            $data_lecturer = [
                'ma_tk' => Session::get('admin_id'),
                'ma_lhp' => $class_id
            ];
            $result_add_lecturer = (new SinhVien())->add($data_lecturer);
            if ($result && $result_add_lecturer) {
                $file = $request->file('hinh_anh');
                $upload_img = false;
                if (!empty($request->hinh_anh)) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                    $upload_img = (new LopHocPhan())->upload_image($request->alias, $filename);
                }
                Session::put('error', 'success');
                Session::put('message', 'Thêm lớp học phần thành công');

                if (!$upload_img) {
                    Session::put('error', 'warning');
                    Session::put('message', 'Thêm lớp học phần thành công nhưng chưa upload hình ảnh.');
                }
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Thêm lớp học phần thất bại');
            }
            return $this->_auth_login() ?? Redirect::to('danh-sanh-lop-hoc-phan');
        }
        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_class'), $this->_data);
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
            $args = array();
            $args['is_lecturer'] = $ma_tk;
            $segment = 2;
            $code_class = trim(request()->segment($segment) ?? '');
            $result = (new LopHocPhan())->admin_delete($args, $code_class);
            if ($result) {
                Session::put('error', 'success');
                Session::put('message', 'Xoá bài thành công.');
            } else {
                return back();
            }
            return back();
        }
        if ($role == 1) {
            $args = array();
            $segment = 2;
            $code_class = trim(request()->segment($segment) ?? '');
            $result = (new LopHocPhan())->admin_delete($args, $code_class);
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


}
