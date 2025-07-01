<?php

namespace App\Http\Controllers;
use App\Models\BoMon;
use App\Models\Taikhoan;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
class AccountController extends LayoutController
{
    function login()
    {
        // Session::flush();

        return view(config('asset.view_page')('form-login'));
    }
    function index()
    {

        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');
        if ($id === '') {
            abort(404);
        }
        // print_r($id);
        $args = array();
        $args['ma_tk'] = $id;
        $value_account = (new Taikhoan)->gets($args);
        return view(config('asset.view_page')('persional-management'))->with('value_account', $value_account);
    }
    function admin_index()
    {
        $args = array();
        $args['per_page'] = 5;

        $accounts = (new Taikhoan)->gets($args);
        $roles = (new VaiTro)->gets();
        $this->_data['rows'] = $accounts;

        $filter = array();
        foreach($roles as $index => $value){
            $filter['value'][$index] = $value->ma_tk;
            $filter['title'][$index] = $value->tieu_de;
        }
        $this->_data['filter'] = $filter;
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('account_management'), $this->_data);
    }
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
                $file = $request->file('hinh_anh');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');
                $upload_img = (new Taikhoan)->upload_image($request->username, $filename);
                Session::put('error', 'success');
                Session::put('message', 'Thêm tài khoản thành công');

                if (!$upload_img) {
                    Session::put('error', 'warning');
                    Session::put('message', 'Thêm tài khoản thành công nhưng chưa upload được hình ảnh.');
                }
            } else {
                Session::put('error', 'danger');
                Session::put('message', 'Thêm tài khoản thất bại');
            }
            return view(config('asset.view_admin_control')('control_account'), $this->_data);
        }

        return $this->_auth_login() ?? view(config('asset.view_admin_control')('control_account'), $this->_data);

        // print_r($result);
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

            // $this->_data['test'] = $data;
            // $this->_data['test2'] = $request;

            // return view(config('asset.view_admin_control')('test'), $this->_data);

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
            // $data = [
            //     'ma_bm' => $request->ma_bm,
            //     'ho_ten' => $request->ho_ten,
            //     'username' => $request->username,
            //     'password' => bcrypt($request->password),
            //     'email' => $request->email,
            //     'gioi_tinh' => $request->gioi_tinh,
            //     'hinh_anh' => null,
            //     'nam_sinh' => $request->nam_sinh,
            //     'sdt' => $request->sdt,
            //     'lien_ket' => $request->lien_ket,
            //     'vai_tro' => $request->vai_tro,
            // ];

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

                // if (!$upload_img) {
                //     Session::put('error', 'warning');
                //     Session::put('message', 'Cập nhật tài khoản thành công nhưng chưa upload được hình ảnh.');
                // }
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
    function admin_delete(Request $request)
    {
        $segment = 2;
        $id_account = trim(request()->segment($segment) ?? '');
        $result = (new Taikhoan)->admin_delete($id_account);

        if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Xoá tài khoản thành công.');
        } else {
            Session::put('error', 'danger');
            Session::put('message', 'Xoá tài khoản thất bại.');
        }
        return Redirect::to('/danh-sach-tai-khoan');
    }
}
