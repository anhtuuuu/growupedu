<?php

namespace App\Http\Controllers;

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
        $result = (new Taikhoan)->check_login($email);
        if ($result && Hash::check($password, $result->password)) {
            Session::put('admin_name', $result->ho_ten);
            Session::put('admin_id', $result->ma_tk);
            Session::put('admin_role', $result->vai_tro);
            Session::put('admin_joined', $result->ngay_tao);

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
