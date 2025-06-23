<?php

namespace App\Http\Controllers;

use App\Models\Chuong;
use Illuminate\Http\Request;

class ChapterController extends LayoutController
{
    function index()
    {

    }
    function admin_index()
    {
        $args = array();
        $chapter = (new Chuong)->gets($args);
        $this->_data['rows'] = $chapter;
        return view(config('asset.view_admin_page')('chapter_management'), $this->_data);
    }
}
