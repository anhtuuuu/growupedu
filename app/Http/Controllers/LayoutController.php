<?php

namespace App\Http\Controllers;
use App\Models\Bai;
use App\Models\CauHinh;
use App\Models\LopHocPhan;
use App\Models\ThongBao;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LayoutController extends Controller
{
    protected $_data = array();


    public function _auth_login()
    {
        if (!Session::has('admin_id')) {
            return Redirect::to('admin');
        }
    }
    public function _auth_login_client()
    {
        if (!Session::has('client_id')) {
            return Redirect::to('login');
        }
    }
    public function section_class()
    {
        $args = array();
        $id_student = Session::get('client_id');
        if (empty($id_student)) {
            return Redirect::to('login');
        }
        $args['ma_sv'] = $id_student;
        $args['hien_thi'] = true;

        $section_class_none = (new LopHocPhan())->gets($args);
        return $section_class_none;
    }
    public function notification(){
        $args = array();
        $id_student = Session::get('client_id');
        if (empty($id_student)) {
            return Redirect::to('login');
        }
        $section_class_none = $this->section_class();
        $args = array();
        $args['order_by'] = 'desc';
        $notices = (new ThongBao())->gets($args);
        $data = [];
        foreach($section_class_none as $class){
            foreach($notices as $n){
                if($class->ma_lhp == $n->ma_lhp){
                    $data[] = $n;
                }
            }
        }
        return $data;
    }
    function index()
    {
        $section_class_none = $this->section_class();
        $this->_data['section_class_none'] = $section_class_none;
        $this->_data['notification'] = $this->notification();

        $this->_data['type_side_none'] = 'home';
        $this->_data['left_side_none'] = $section_class_none;

        $this->_data['load_section_class'] = $section_class_none;
        $this->_data['not_in_class'] = true;

        return $this->_auth_login_client() ?? view(config('asset.view_page')('main'), $this->_data);
    }
    function update_config(Request $request)
    {
        $get_req = $request->all();
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'ten_site' => 'required|max:255',
                    'dia_chi' => 'required|max:255',
                    'sdt' => 'required|max:255',
                    'email' => 'required|max:255',
                    'website' => 'required|max:255'
                ],
                [
                    'ten_site.required' => 'Vui lòng nhập tên trang web.',
                    'ten_site.max' => 'Tên trang web không được vượt quá 255 ký tự.',
                    'dia_chi.required' => 'Vui lòng nhập địa chỉ.',
                    'dia_chi.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
                    'sdt.required' => 'Vui lòng nhập số điện thoại.',
                    'sdt.max' => 'Số điện thoại không được vượt quá 255 ký tự.',
                    'email.required' => 'Vui lòng nhập email.',
                    'email.max' => 'Email không được vượt quá 255 ký tự.',
                    'website.max' => 'Liên kết không được vượt quá 255 ký tự.',
                ]
            );
            $data = [
                'ten_site' => $request->ten_site,
                'dia_chi' => $request->dia_chi,
                'sdt' => $request->sdt,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => null,
                'favicon' => null,
                'lien_ket' => $request->lien_ket,
                'facebook' => $request->facebook
            ];
            $result = (new CauHinh)->admin_update($data);
            if ($result) {
                // $file = $request->file('logo');
                // $filename = $request->logo_clone;
                // if (!empty($request->logo)) {
                //     $filename = time() . '_' . $file->getClientOriginalName();
                //     $path = $file->storeAs('uploads', $filename, 'public');
                // }
                // $upload_img = (new CauHinh)->upload_image('logo', $filename);
                $filename = $request->logo_clone;
                if (!empty($request->logo)) {
                    $file = $request->file('logo');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                }
                $upload_img = (new CauHinh)->upload_image('logo', $filename);

                $filename2 = $request->favicon_clone;
                if (!empty($request->favicon)) {
                    $file = $request->file('favicon');
                    $filename2 = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename2, 'public');
                }
                $upload_img = (new CauHinh)->upload_image('favicon', $filename2);

                Session::put('error', 'success');
                Session::put('message', 'Cập nhật thông tin thành công');
            } else {
                Session::put('error', 'warning');
                Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
                if (!empty($request->logo)) {
                    $file = $request->file('logo');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                    $upload_img = (new CauHinh)->upload_image('logo', $filename);
                    Session::put('error', 'success');
                    Session::put('message', 'Cập nhật thông tin thành công');
                    if (!$upload_img) {
                        Session::put('error', 'warning');
                        Session::put('message', 'Cập nhật thông tin thành công nhưng chưa upload được hình ảnh.');
                    }
                }
                if (!empty($request->favicon)) {
                    $file = $request->file('favicon');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                    $upload_img = (new CauHinh)->upload_image('favicon', $filename);
                    Session::put('error', 'success');
                    Session::put('message', 'Cập nhật thông tin thành công');
                    if (!$upload_img) {
                        Session::put('error', 'warning');
                        Session::put('message', 'Cập nhật thông tin thành công nhưng chưa upload được hình ảnh.');
                    }
                }
            }
            return back();
        }

        $config = (new CauHinh())->get();
        if (empty($config)) {
            abort(404);
        }
        $this->_data['row'] = $config;
        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_configuration'), $this->_data);
    }
    function gets()
    {
        $args = '';
        $class = (new LopHocPhan)->gets($args);
        return $class;
    }
    function search(Request $request)
    {
        $get_req = $request->all();
        $args = array();
        $args['order_by'] = 'desc';
        $args['per_page'] = 10;
        $section_class_none = $this->section_class();
        $this->_data['load_section_class'] = $section_class_none;
        $this->_data['notification'] = $this->notification();
        $this->_data['type_side_none'] = 'home';
        $this->_data['left_side_none'] = $section_class_none;
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'q' => 'required|max:255',
                ],
                [
                    'q.required' => 'Vui lòng nhập từ khóa.',
                    'q.max' => 'Từ khóa không được vượt quá 255 ký tự.'
                ]
            );
            $input = $request->q;
            $args['q'] = $input;
            // $args['class'] = [];
            // foreach($section_class_none as $class){
            //     $args['class'][] = $class->ma_bg;
            // }
            $args['lesson_id'] = Session::has('lesson_id') ? Session::get('lesson_id') : '';

            $contents = (new Bai())->gets($args);
            $this->_data['contents'] = $contents;
        }
        return $this->_auth_login_client() ?? view(config('asset.view_page')('search'), $this->_data);

    }
}
