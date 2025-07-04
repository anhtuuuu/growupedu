<?php

namespace App\Http\Controllers;

use App\Models\CauHinh;
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

            $config = (new CauHinh)->get();

            if ($result && Hash::check($password, $result->password)) {
                Session::put('client_name', $result->ho_ten);
                Session::put('client_id', $result->ma_tk);
                Session::put('client_role', $result->vai_tro);
                Session::put('client_avatar', $result->hinh_anh);
                Session::put('client_joined', $result->ngay_tao);

                if (!empty($config)) {
                    Session::put('config_site_name', $config->ten_site);
                    Session::put('config_address', $config->dia_chi);
                    Session::put('config_phone', $config->sdt);
                    Session::put('config_email', $config->email);
                    Session::put('config_logo', $config->logo);
                    Session::put('config_favicon', $config->favicon);
                    Session::put('config_website', $config->website);
                    Session::put('config_link', $config->lien_ket);
                    Session::put('config_facebook', $config->facebook);
                }

                Session::forget('message');
                return Redirect::to('/');
            }
            Session::put('message', 'Tài khoản hoặc mật khẩu không đúng!');
            return Redirect::to('/');
        }
        return view(config('asset.view_page')('form-login'));
    }
}
