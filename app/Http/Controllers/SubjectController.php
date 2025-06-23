<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use Illuminate\Http\Request;

class SubjectController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('subject_management'));
    }
    function admin_index()
    {
        $args = array();
        $subject = (new BoMon)->gets($args);
        $this->_data['rows'] = $subject;
        return view(config('asset.view_admin_page')('subject_management'), $this->_data);
    }
}
