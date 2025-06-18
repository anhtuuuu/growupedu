<?php

namespace App\Http\Controllers;
use App\Models\Taikhoan;
use Illuminate\Http\Request;

class AccountController extends LayoutController
{
     function index(){
       return view(config('asset.view_page')('persional-management'));
    }
    function admin_index()
    {
        $accounts = $this->gets();
        return view(config('asset.view_admin_page')('account_management'))->with('accounts', $accounts);
    }
    function gets()
    {
        $args = array();
        $args['order_by'] = '';
        $accounts = (new Taikhoan)->gets($args);
        return $accounts;
    }
}
