<?php

namespace App\Http\Controllers;
use App\Imports\AccountsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BoMon;
use App\Models\SinhVien;
use App\Models\Taikhoan;
use App\Models\VaiTro;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
class AccountController extends LayoutController
{
    function index()
    {
        $id = Session::get('client_id');
        if ($id === '') {
            abort(404);
        }
        $section_class_none = $this->section_class();
        $this->_data['load_section_class'] = $section_class_none;
        $this->_data['notification'] = $this->notification();
        $args = array();
        $args['ma_sv'] = $id;
        $class_info = (new SinhVien)->gets($args);
        $this->_data['class_info'] = $class_info;

        $value_account = (new Taikhoan)->get_by_id($id);
        $this->_data['not_in_class'] = true;

        $this->_data['row'] = $value_account;
        return view(config('asset.view_page')('persional-management'), $this->_data);
    }
    function logout()
    {
        $this->_auth_login_client();
        Session::flush();
        return Redirect::to('/');
    }
    function update_info(Request $request)
    {
        $get_req = $request->all();
        if (empty($get_req)) {
            abort(404);
        }

        $id_account = $request->ma_tk;
        $account = (new Taikhoan())->get_by_id($id_account);
        if (empty($account)) {
            abort(404);
        }
        $validated = $request->validate(
            [
                'sdt' => 'numeric',
                'old_password' => [
                    'required',
                    function ($attribute, $value, $fail) use ($account) {
                        if (!Hash::check($value, $account->password)) {
                            $fail('Mật khẩu không trùng khớp với mật khẩu cũ.');
                        }
                    },
                ],
                'password' => [
                    'required',
                    'min:6',
                    'max:20',
                    'confirmed',
                    function ($attribute, $value, $fail) use ($account) {
                        if (Hash::check($value, $account->password)) {
                            $fail('Mật mới khẩu không được trùng với mật khẩu cũ.');
                        }
                    },
                ]
            ],
            [
                'sdt.numeric' => 'Số điện thoại chỉ chứa số.',
                'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
                'password.max' => 'Mật khẩu tối đa 20 ký tự.',
                'password.confirmed' => 'Mật khẩu xác nhận chưa chính xác.',
            ]
        );
        if ($request->sdt != $account->sdt) {
            $request->validate(
                [
                    'sdt' => 'numeric|unique:taikhoan',
                ],
                [
                    'sdt.numeric' => 'Số điện thoại chỉ chứa số.',
                    'sdt.unique' => 'Số điện thoại đã tồn tại.',
                ]
            );
        }

        $data = [
            'sdt' => $request->sdt,
            'password' => bcrypt($request->password),
        ];
        $result = (new Taikhoan())->admin_update($id_account, $data);
        if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Cập nhật tài khoản thành công');
        } else {
            Session::put('error', 'warning');
            Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
        }
        return back();
    }
    function admin_index(Request $request)
    {
        $args = array();
        $args['per_page'] = 5;
        $args['filter'] = 1;

        $accounts = (new Taikhoan)->gets($args);
        $this->_data['rows'] = $accounts;

        $list_filter = (new VaiTro)->gets();
        $filter = array();
        foreach ($list_filter as $index => $value) {
            $filter[$index]['value'] = $value->ma_vt;
            $filter[$index]['title'] = $value->tieu_de;
        }
        $this->_data['filter'] = $filter;
        $this->_data['filter_link'] = 'danh-sach-tai-khoan/';

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
            $data = (new Taikhoan)->gets($args);
            $this->_data['rows'] = $data;
        }
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('account_management'), $this->_data);
    }
    // function filter(Request $request)
    // {
    //     $value_filter = $request->cat_id;
    //     $key_word = $request->key_word;
    //     $this->_data['value_filter'] = $value_filter;
    //     $this->_data['key_word'] = $key_word;

    //     $args = array();
    //     $args['per_page'] = 5;
    //     if ($value_filter != 0) {
    //         $args['role'] = $value_filter;
    //     }
    //     if (!empty($key_word)) {
    //         $args['key_word'] = $key_word;
    //     }
    //     $roles = (new VaiTro)->gets();

    //     $filter = array();
    //     foreach ($roles as $index => $value) {
    //         $filter['value'][$index] = $value->ma_vt;
    //         $filter['title'][$index] = $value->tieu_de;
    //     }
    //     $this->_data['filter'] = $filter;
    //     $this->_data['filter_link'] = 'danh-sach-tai-khoan/';

    //     $data = (new Taikhoan)->gets($args);
    //     $this->_data['rows'] = $data;
    //     return $this->_auth_login() ?? view(config('asset.view_admin_page')('account_management'), $this->_data);
    // }
    function gets()
    {
        $args = array();
        $args['order_by'] = '';
        $accounts = (new Taikhoan)->gets($args);
        return $accounts;
    }
    function admin_add(Request $request)
    {
        $get_req = $request->all();
        $roles = (new VaiTro)->gets();
        $this->_data['roles'] = $roles;
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'ho_ten' => 'required|max:255',
                    'username' => 'required|max:255|unique:taikhoan',
                    'password' => 'required|min:6|max:20|confirmed',
                    'email' => 'required|email|max:255|unique:taikhoan',
                    'sdt' => 'numeric|unique:taikhoan',
                    'hinh_anh' => 'image|mimes:jpg,jpeg,png|max:2048'
                ],
                [
                    'ho_ten.required' => 'Vui lòng nhập họ tên.',
                    'username.required' => 'Vui lòng nhập username.',
                    'password.required' => 'Vui lòng nhập mật khẩu.',
                    'email.required' => 'Vui lòng nhập email.',
                    'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự.',
                    'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
                    'username.unique' => 'Tên đăng nhập đã tồn tại.',
                    'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
                    'password.max' => 'Mật khẩu tối đa 20 ký tự.',
                    'password.confirmed' => 'Mật khẩu xác nhận chưa chính xác.',
                    'email.email' => 'Email chưa đúng định dạng.',
                    'email.max' => 'Email tối đa 255 ký tự.',
                    'email.unique' => 'Email đã tồn tại.',
                    'sdt.numeric' => 'Số điện thoại chỉ chứa số.',
                    'sdt.unique' => 'Số điện thoại đã tồn tại.',
                    'hinh_anh.image' => 'File truyền vào phải là hình ảnh.',
                    'hinh_anh.mimes' => 'Chỉ chấp nhận các file jpg, jpeg, png.',
                    'hinh_anh.max' => 'Dung lượng tối đa cho phép 2MB.',
                ]
            );
            $data = [
                'ma_bm' => $request->ma_bm,
                'ho_ten' => $request->ho_ten,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'gioi_tinh' => $request->gioi_tinh,
                'hinh_anh' => null,
                'nam_sinh' => $request->nam_sinh,
                'sdt' => $request->sdt,
                'lien_ket' => $request->lien_ket,
                'vai_tro' => $request->vai_tro,
            ];
            $result = (new Taikhoan)->add($data);

            if ($result) {
                $upload_img = false;
                if (!empty($request->hinh_anh)) {
                    $file = $request->file('hinh_anh');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                    $upload_img = (new Taikhoan)->upload_image($request->username, $filename);
                    Session::put('error', 'success');
                    Session::put('message', 'Thêm tài khoản thành công');
                }

                if (!$upload_img) {
                    Session::put('error', 'warning');
                    Session::put('message', 'Thêm tài khoản thành công nhưng chưa upload được hình ảnh.');
                }
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Thêm tài khoản thất bại');
            }
            return Redirect::to('danh-sach-tai-khoan');
        }

        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_account'), $this->_data);

        // print_r($result);
    }
    public function import(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|mimes:xlsx,csv,xls'
            ],
            [
                'file.required' => 'Vui lòng chọn file excel.',
                'file.mimes' => 'Chỉ chấp nhận files định dạng (xlsx, csv, xls).',
            ]
        );
        $import = new AccountsImport;
        Excel::import($import, $request->file('file'));
        $result = $import->getRowCount();
        if ($result != 0) {
            Session::put('error', 'success');
            Session::put('message', 'Có ' . $result . ' tài khoản được thêm thành công');
        } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có tài khoản nào thêm thành công');
        }
        return back();
    }
    function update_status()
    {
        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');
        if (empty($id)) {
            abort(404);
        }
        $account = (new Taikhoan())->get_by_id($id);
        $data = [
            'kich_hoat' => $account->kich_hoat == 1 ? 0 : 1
        ];
        if ($account->username == 'administrator') {
            $data = [
                'kich_hoat' => 1
            ];
        }
        $result = (new Taikhoan())->admin_update($id, $data);
        return $result;
    }
    function admin_update(Request $request)
    {
        $get_req = $request->all();
        $roles = (new VaiTro)->gets();
        $this->_data['roles'] = $roles;
        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');
        if (!empty($get_req)) {

            $id_account = $request->ma_tk;
            $account = (new Taikhoan())->get_by_id($id_account);
            $request->validate(
                [
                    'ho_ten' => 'required|max:255',
                    'username' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'sdt' => 'numeric',
                    'hinh_anh' => 'image|mimes:jpg,jpeg,png|max:2048'

                ],
                [
                    'ho_ten.required' => 'Vui lòng nhập họ tên.',
                    'username.required' => 'Vui lòng nhập username.',
                    'email.required' => 'Vui lòng nhập email.',
                    'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự.',
                    'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
                    'username.unique' => 'Tên đăng nhập đã tồn tại.',
                    'email.email' => 'Email chưa đúng định dạng.',
                    'email.max' => 'Email tối đa 255 ký tự.',
                    'email.unique' => 'Email đã tồn tại.',
                    'sdt.numeric' => 'Số điện thoại chỉ chứa số.',
                    'sdt.unique' => 'Số điện thoại đã tồn tại.',
                    'hinh_anh.image' => 'File truyền vào phải là hình ảnh.',
                    'hinh_anh.mimes' => 'Chỉ chấp nhận các file jpg, jpeg, png.',
                    'hinh_anh.max' => 'Dung lượng tối đa cho phép 2MB.',
                ]
            );
            if (empty($account)) {
                abort(404);
            }
            $data = array();
            foreach ($account as $key => $value) {
                if ($value != $request->$key && !empty($request->$key) && $key != 'hinh_anh') {
                    $data[$key] = $request->$key;
                }
            }
            if (isset($data['username'])) {
                if ($account->username == 'administrator') {
                    $data['username'] = 'administrator';
                }
            }
            if (isset($data['username']) && isset($data['email']) && isset($data['sdt'])) {
                $request->validate(
                    [
                        'username' => 'unique:taikhoan',
                        'email' => 'unique:taikhoan',
                        'sdt' => 'unique:taikhoan',
                    ],
                    [
                        'username.unique' => 'Tên đăng nhập đã tồn tại.',
                        'email.unique' => 'Email đã tồn tại.',
                        'sdt.unique' => 'Số điện thoại đã tồn tại.',
                    ]
                );
            }
            $result = (new Taikhoan())->admin_update($id_account, $data);
            if ($result) {
                $file = $request->file('hinh_anh');
                $filename = $request->hinh_anh_clone;
                if (!empty($request->hinh_anh)) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                }
                $upload_img = (new Taikhoan)->upload_image($request->username, $filename);
                Session::put('error', 'success');
                Session::put('message', 'Cập nhật tài khoản thành công');
            } else {
                Session::put('error', 'warning');
                Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
                if (!empty($request->hinh_anh)) {
                    $file = $request->file('hinh_anh');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                    $upload_img = (new Taikhoan)->upload_image($request->username, $filename);
                    Session::put('error', 'success');
                    Session::put('message', 'Cập nhật tài khoản thành công');
                    if (!$upload_img) {
                        Session::put('error', 'warning');
                        Session::put('message', 'Cập nhật tài khoản thành công nhưng chưa upload được hình ảnh.');
                    }
                }
            }
            return Redirect::to('danh-sach-tai-khoan');
        }

        $account = (new Taikhoan())->get_by_id($id);
        if (empty($account)) {
            abort(404);
        }
        $this->_data['row'] = $account;
        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_account'), $this->_data);
    }

    function check_role()
    {
        $segment = 2;
        $role = trim(request()->segment($segment) ?? '');
        $args = array();
        if (empty($role))
            return '';
        $html = '';
        if ($role == 2) {
            $subjects = (new BoMon)->gets($args);
            $html .= '<label for="ma_bm" class="control-label">Bộ môn</label>
                                    <select class="form-control" name="ma_bm" id="ma_bm">';
            foreach ($subjects as $row) {
                $html .= '<option value="' . $row->ma_bm . '">' . $row->ten_bm . '</option>';
            }
            $html .= '</select>';
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
        if ($role == 1) {
            $segment = 2;
            $id_account = trim(request()->segment($segment) ?? '');
            if (empty($id_account)) {
                abort(404);
            }
            $check_account = (new Taikhoan())->get_by_id($id_account);
            if (!empty($check_account) && $check_account->username == 'administrator') {
                Session::put('error', 'warning');
                Session::put('message', 'Không thể xóa tài khoản này.');
                return back();
            }
            $del_student = (new SinhVien())->account_delete($id_account);
            $result = (new Taikhoan)->admin_delete($id_account);

            if ($result) {
                Session::put('error', 'success');
                Session::put('message', 'Xoá tài khoản thành công.');
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Xoá tài khoản thất bại.');
            }
            return back();
        }
        return back();
    }
}
