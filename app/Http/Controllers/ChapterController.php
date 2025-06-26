<?php

namespace App\Http\Controllers;

use App\Models\BaiGiang;
use App\Models\Chuong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

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
    function admin_add(Request $request)
    {
        $args = array();
        $data=(new BaiGiang())->gets($args);
        $this->_data['table_baigiang'] = $data;
    
        $get_req = $request->all();
        if (!empty($get_req)) {
            $validated = $request->validate(
                [
                    'ten_chuong' => 'required|max:255',
                    'alias' => 'required|max:255|unique:chuong',
                ],
                [
                    'ten_chuong.required' => 'Vui lòng nhập tên chương.',
                    'ten_chuong.max' => 'Tên chương không được vượt quá 255 ký tự.',
                    'alias.required' => 'Liên kết tĩnh không được để trống.',
                    'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
                    'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
                ]
            );
            $data = [
                'ma_bg' => $request->ma_bg,
                'ten_chuong' => $request->ten_chuong,
                'alias' => $request->alias,
                'mo_ta' => $request->mo_ta
            ];
            $result = (new Chuong())->add($data);
            if ($result) {
                $this->_data['error'] = 'success';
                $this->_data['message'] = 'Thêm chương thành công';
            } else {
                $this->_data['error'] = 'danger';
                $this->_data['message'] = 'Thêm chương thất bại';
            }
            return view(config('asset.view_admin_control')('control_chapter'), $this->_data);
        }
        return view(config('asset.view_admin_control')('control_chapter'), $this->_data);
    }

    function admin_update(Request $request)
   {
      $args = array();
      $data = (new BaiGiang())->gets($args);
      $this->_data['table_bg'] = $data;
      $get_req = $request->all();
      $segment = 2;
      $id = trim(request()->segment($segment) ?? '');

      if (!empty($get_req)) {

         $id_chapter = $request->ma_chuong;
         $chapter = (new Chuong())->get_by_id($id_chapter);
         $validated = $request->validate(
            [
               'ten_chuong' => 'required|max:255',
               'alias' => 'required|max:255' . ($chapter->alias == $request->alias ? '' : '|unique:chuong'),
            ],
            [
               'ten_chuong.required' => 'Vui lòng nhập tên chương.',
               'ten_chuong.max' => 'Tên chương không được vượt quá 255 ký tự.',
               'alias.required' => 'Liên kết tĩnh không được để trống.',
               'alias.max' => 'Liên kết tĩnh không được vượt quá 255 ký tự.',
               'alias.unique' => 'Liên kết tĩnh đã tồn tại.',
            ]
         );

         if (empty($chapter)) {
            abort(404);
         }
         if ($chapter->alias == $request->alias) {
            $data = [
               'ma_bg' => $request->ma_bg,
               'ten_chuong' => $request->ten_chuong,
               'mo_ta' => $request->mo_ta
            ];
         } else {
            $data = [
               'ma_bg' => $request->ma_bg,
               'ten_chuong' => $request->ten_chuong,
               'alias' => $request->alias,
               'mo_ta' => $request->mo_ta
            ];
         }
         $result = (new Chuong())->admin_update($id_chapter, $data);
         if ($result) {
            Session::put('error', 'success');
            Session::put('message', 'Cập nhật chương thành công.');
         } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có dữ liệu nào được thay đổi.');
         }
         return Redirect::to('danh-sach-chuong');
      }

      $chapter = (new Chuong())->get_by_id($id);
      if (empty($chapter)) {
         abort(404);
      }
      $this->_data['row'] = $chapter;
      return view(config('asset.view_admin_control')('control_chapter'), $this->_data);
   }
}
