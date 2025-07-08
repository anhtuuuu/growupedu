<?php

namespace App\Http\Controllers;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\LopHocPhan;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
class StudentController extends LayoutController
{
    function index()
    {
        return view(config('asset.view_admin_page')('student_management'));
    }
    function admin_index()
    {
        $segment = 2;
        $id = trim(request()->segment($segment) ?? '');
        $args = array();
        $args['alias_class'] = $id;
        $args['ma_gv'] = Session::get('admin_id');
        $args['per_page'] = 5;
        $students = (new SinhVien)->gets($args);
        $this->_data['rows'] = $students;
        return $this->_auth_login() ?? view(config('asset.view_admin_page')('student_management'), $this->_data);
    }
    function admin_delete()
    {
        $role = Session::get('admin_role');
        if (!$role) {
            return Redirect::to('/admin');
        }
        Session::put('error', 'warning');
        Session::put('message', 'Bạn không có quyền xóa dữ liệu này.');
        if ($role == 2) {
            $ma_tk = Session::get('admin_id');
            $segment = 2;
            $id_student = trim(request()->segment($segment) ?? '');
            $result = (new SinhVien())->admin_delete($id_student, $ma_tk);

            if ($result) {
                Session::put('error', 'success');
                Session::put('message', 'Xoá sinh viên thành công.');
            } else {
                return back();
            }
            //  return Redirect::to('danh-sach-sinh-vien/{alias}');
            return back();

        }
        return back();

    }
    public function import(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|mimes:xlsx,csv,xls'
            ],
            [
                'file.required' => 'Vui lòng chọn file excel.',
                'file.mimes' => 'Chỉ chấp nhận files định dạng (xlsx, csv, xls).',
            ]
        );
        $ma_lhp = $request->ma_lhp;
        $check_class = (new LopHocPhan())->get_by_id($ma_lhp);
        if(empty($ma_lhp) || empty($check_class)){
            abort(404);
        }

        $import = new StudentsImport($ma_lhp);
        Excel::import($import, $request->file('file'));
        
        $result = $import->getRowCount();
        if ($result != 0) {
            Session::put('error', 'success');
            Session::put('message', 'Có ' . $result . ' tài khoản được thêm thành công');
        } else {
            Session::put('error', 'danger');
            Session::put('message', 'Chưa có tài khoản nào thêm thành công');
        }
        $getMissed = $import->getMissed();
        if(!empty(array_filter($getMissed[0]))){
            return Excel::download(new StudentsExport($getMissed), 'dssv-khong-the-them-vao.xlsx');
        }
        return back();
    }
}
