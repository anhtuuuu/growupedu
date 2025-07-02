<?php

namespace App\Http\Controllers;

use App\Models\Taikhoan;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class FormLoginController extends Controller
{
    function index(Request $request)
    {
        $req = $request->all();
        if (!empty($req)) {
            $args = array();
            $args['is_client'] = true;
            $email = $request->email;
            $password = $request->password;
            $result = (new Taikhoan)->check_login($args, $email);
            if ($result && Hash::check($password, $result->password)) {
                Session::put('client_name', $result->ho_ten);
                Session::put('client_id', $result->ma_tk);
                Session::put('client_role', $result->vai_tro);
                Session::put('client_joined', $result->ngay_tao);

                Session::forget('message');
                return Redirect::to('/');
            }
            Session::put('message', 'Tài khoản hoặc mật khẩu không đúng!');
            return Redirect::to('/');
        }
        return view(config('asset.view_page')('form-login'));
    }
}
