<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use Hash;
use Session;
use App\Models\Taikhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PerformanceController extends LayoutController
{
    function index()
    {
    }
    function admin_index()
    {
        $account_id = Session::has('admin_id') ? Session::get('admin_id') : '';
        if(empty($account_id)){
            Redirect::to('admin');
        }
        $data = (new Taikhoan())->get_by_id($account_id);

        $args = array();
        $args['ma_gv'] = $account_id;
        $assess = (new DanhGia())->gets($args);
        $start_avg = 0;
        $count = (count($assess));
        if(!empty($assess)){
            $sum = 0;
            foreach($assess as $a){
                $sum += $a->so_sao;
            }
            $start_avg = ($sum / $count);
        }

        $this->_data['row'] = $data;
        $this->_data['count'] = $count;
        $this->_data['start_avg'] = $start_avg;

        return $this->_auth_login() ?? view(config('asset.view_admin_page')('performance_management'), $this->_data);
    }
    function update_info(Request $request)
    {
        $get_req = $request->all();
        if (empty($get_req)) {
            abort(404);
        }

        $id_account = Session::get('admin_id');
        $account = (new Taikhoan())->get_by_id($id_account);
        if (empty($account)) {
            abort(404);
        }
        $validated = $request->validate(
            [
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
                'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
                'password.max' => 'Mật khẩu tối đa 20 ký tự.',
                'password.confirmed' => 'Mật khẩu xác nhận chưa chính xác.',
            ]
        );
        $data = [
            'password' => bcrypt($request->password),
        ];
        $result = (new Taikhoan())->admin_update($id_account, $data);
        if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Cập nhật mật khẩu thành công');
        } else {
            Session::put('error', 'warning');
            Session::put('message', 'Cập nhật mật khẩu thất bại.');
        }
        return back();
    }
}
