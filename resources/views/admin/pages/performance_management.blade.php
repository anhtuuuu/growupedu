@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Thông tin chi tiết:</h3>
                </div>
                <div class="box-body">
                    <?php if(isset($row) && !empty($row)): ?>
                    <div id="accordion" class="box-group">
                        <div class="panel box box-primary">
                            {{-- <div class="box-header">
                                <h4 class="box-title">
                                    Thông tin đánh giá
                                </h4>
                            </div> --}}
                            <div class="box-body">
                                <p>Họ tên: <b>{{ $row->ho_ten }}</b></p>
                                <p>Thuộc bộ môn: <b>{{ $row->ten_bm }}</b></p>
                                <p>Email: <b>{{ $row->email }}</b></p>
                                {{-- <p>Ngày sinh: <b>{{ date('d/m/Y', strtotime($row->nam_sinh)) }}</b></p> --}}
                                <p>Số lược đánh giá: <b>{{ isset($count) ? $count : 0 }}</b></p>
                                <p>Trung bình số sao: <b>{{ isset($start_avg) ? $start_avg : 0 }}</b></p>
                                <p>Đánh giá:
                                    <b>{{ isset($start_avg) ? ($start_avg == 5 ? 'Tốt' : ($start_avg >= 4 ? 'Khá' : 'Cần cải thiện')) : '' }}</b>
                                </p>
                            </div>
                        </div>
                        <div class="panel box box-success">
                            <div class="box-header">
                                <h4 class="box-title">
                                    Đổi mật khẩu
                                </h4>
                            </div>
                            <div class="box-body">
                                <form action="{{URL::to('thong-tin-ca-nhan')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group required">
                                        <label for="old_password" class="control-label">Mật khẩu cũ</label>
                                        <input type="password" class="form-control" name="old_password" id="old_password"
                                            value="">
                                        @error('old_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group required">
                                        <label for="password" class="control-label">Mật khẩu mới</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group required">
                                        <label for="password_confirmation" class="control-label">Xác nhận mật khẩu</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" value="">
                                    </div>
                                    <div class="row">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
@endsection
