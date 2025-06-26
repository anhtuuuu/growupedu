<?php

namespace App\Http\Controllers;
use App\Models\BoMon;
use App\Models\Taikhoan;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Session;
class AccountController extends LayoutController
{
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
        $accounts = (new Taikhoan)->gets($args);
        $this->_data['rows'] = $accounts;
        return view(config('asset.view_admin_page')('account_management'), $this->_data);
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

        return view(config('asset.view_admin_control')('control_account'), $this->_data);

        // print_r($result);
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
                $html .= '<option value="'.$row->ma_bm.'">'.$row->ten_bm.'</option>';
            }
            $html .= '</select>';
        }
        return $html;
    }
}
