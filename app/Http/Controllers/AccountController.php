<?php

namespace App\Http\Controllers;
use App\Models\Taikhoan;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    function index(){
        $accounts = Taikhoan::all();
       return view(config('asset.view_admin_page')('account_management'))->with('accounts', $accounts);
    }
}
