<?php

namespace App\Http\Controllers;
use App\Models\Taikhoan;
use Illuminate\Http\Request;

class AccountController extends LayoutController
{
     function index(){
        
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
}
