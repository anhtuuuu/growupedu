<?php

namespace App\Http\Controllers;

use App\Models\Bai;
use App\Models\BaiGiang;
use App\Models\BaiKiemTra;
use App\Models\BoMon;
use App\Models\HocPhan;
use App\Models\LopHocPhan;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\Taikhoan;
use Illuminate\Http\Request;

class AdminController extends LayoutController
{
    function login()
    {
        // Session::flush();

        return view(config('asset.view_admin_page')('form-login'));
    }
    function admin_index(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $args = array();
        $args['is_admin'] = true;
        $result = (new Taikhoan)->check_login($args, $email);
        if ($result && Hash::check($password, $result->password)) {
            Session::put('admin_name', $result->ho_ten);
            Session::put('admin_id', $result->ma_tk);
            Session::put('admin_role', $result->vai_tro);
            Session::put('admin_joined', $result->ngay_tao);

            Session::put('count_account', (Taikhoan::count()));
            Session::put('count_subject', (BoMon::count()));
            Session::put('count_course', (HocPhan::count()));
            Session::put('count_class', (LopHocPhan::count()));

            if ($result->vai_tro == 2) {
                $args = array();
                $args['ma_tk'] = $result->ma_tk;
                Session::put('count_class', count((new LopHocPhan())->gets($args)));
                Session::put('count_lesson', count((new BaiGiang())->gets($args)));
                $args['ma_gv'] = $result->ma_tk;
                Session::put('count_content', count((new Bai())->gets($args)));
                Session::put('count_test', count((new BaiKiemTra())->gets($args)));
            }

            // print_r(session()->all());
            Session::forget('message');
            return Redirect::to('/dashboard');
        }
        Session::put('message', 'Tài khoản hoặc mật khẩu không đúng!');
        return Redirect::to('/admin');
    }
    function show_dashboard()
    {
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('main'));
    }
    function logout()
    {
        $this->_auth_login();
        Session::flush();
        return Redirect::to('/admin');
    }
}
