@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                <div class="box-body">
                    <input type="hidden" value="' . $row['id'] . '" id="id" name="id" class="form-control" />

                    <form id="f-content" action="{{ URL::to('them-tai-khoan') }}" method="post"
                        enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="vai_tro" class="control-label">Vai trò</label>
                                    <select class="form-control" name="vai_tro" id="roles">
                                        <?php if(isset($roles) && !empty($roles) && is_array($roles)):
                                            foreach($roles as $role): ?>
                                        <option value="{{ $role->ma_vt }}">{{ $role->tieu_de }}</option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div class="form-group" id="subjects">
                                    <input type="hidden" name="ma_bm" value="" id="">
                                </div>
                                <div class="form-group required">
                                    <label for="ho_ten" class="control-label">Họ tên</label>
                                    <input type="text" class="form-control" name="ho_ten" id="ho_ten"
                                        value="{{ old('ho_ten') }}">
                                    @error('ho_ten')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="username" class="control-label">Tên đăng nhập</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ old('username') }}">
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="password" class="control-label">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="password_confirmation" class="control-label">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" value="">
                                </div>
                                <div class="form-group required">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gioi_tinh" class="control-label">Giới tính</label>
                                    <select class="form-control" name="gioi_tinh" id="gioi_tinh">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Hình đại diện</label>
                                    <input type="file" class="file" name="hinh_anh">

                                    <div style="margin-top: 10px;">
                                        <img width="100" src="" alt=""
                                            class="img-thumbnail img-responsive">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label">Ngày sinh</label>
                                    <input type="date" class="form-control" name="nam_sinh"
                                        value="{{ old('ngay_sinh') }}">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="sdt"
                                        value="{{ old('sdt') }}">
                                    @error('sdt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Liên kết</label>
                                    <input type="text" class="form-control" name="lien_ket"
                                        value="{{ old('lien_ket') }}">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
