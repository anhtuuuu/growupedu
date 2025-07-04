@extends('site.layout')
@section('content')

<div class="container-fluid mt-4">
	<div class="row row-offcanvas row-offcanvas-right">
			@include(config('asset.view_admin_partial')('notify_message'))	
            <!-- content -->
            <div class="col-xs-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                    </div>
                    <!--panel-Body-->
                    <div class="panel-body">
                        <div class="content-row">
                            <div class="row">
                                <?php
								if(isset($row) && !empty($row)):?>
                                <div class="col-md-6">
                                    <form action="{{ URL::to('cap-nhat-thong-tin') }}" method="post">
                                        {{ csrf_field() }}
                                        <h2>Thông tin cá nhân:</h2>
                                        <input hidden type="hidden" id="ma_tk" name="ma_tk"
                                            value="{{ $row->ma_tk }}">
                                        <ul class="m-0">
                                            <li class="list-group-item"><b>Họ tên: </b>{{ $row->ho_ten }}</li>
                                            <li class="list-group-item"><b>MSSV: </b>{{ $row->ma_tk }}</li>
                                            <li class="list-group-item"><b>Giới tính:
                                                </b>{{ $row->gioi_tinh == 0 ? 'Nam' : 'Nữ' }}</li>
                                            <li class="list-group-item"><b>Email: </b>{{ $row->email }}</li>
                                            <li class="list-group-item"><b>Ngày sinh:
                                                </b>{{ date('d/m/Y', strtotime($row->nam_sinh)) }}</li>
                                        </ul>
                                        <div class="form-group pl-2r mt-4">
                                            <label for="phone">Số điện thoại:</label>
                                            <input type="text" class="form-control" id="phone" name="sdt"
                                                value="{{ $row->sdt }} " placeholder="Số điện thoại">
                                            @error('sdt')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <h2>Đổi mật khẩu:</h2>
                                        <div class="form-group pl-2r mt-4">
                                            <label for="old_password">Mật khẩu cũ: </label>
                                            <input type="password" class="form-control" id="old_password"
                                                name="old_password" placeholder="Mật khẩu cũ">
                                            @error('old_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group pl-2r mt-4">
                                            <label for="password">Mật khẩu mới: </label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Mật khẩu mới">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group pl-2r mt-4">
                                            <label for="password_confirmation">Nhập lại mật khẩu: </label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                                <?php endif;?>
                                <div class="col-md-6 mt-5 mt-md-0 pl-2 border border-top-0 border-right-0 border-bottom-0">
                                    <h2>Lớp học phần:</h2>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Lớp học phần</th>
                                                <th scope="col">Tiến độ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($class_info) && !empty($class_info)):
												foreach($class_info as $index => $value):
											?>
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td><a href="{{ URL::to($value->alias_lhp) }}">{{ $value->ten_lhp }}</a>
                                                </td>
                                                <td>{{ $value->tien_do }}%</td>
                                            </tr>
                                            <?php endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end panel body -->
                </div>
            </div>
            <!-- end content -->
        </div>

    </div>
@endsection
