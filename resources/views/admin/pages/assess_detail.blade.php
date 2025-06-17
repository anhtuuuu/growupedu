@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Chi tiết đánh giá</h3>
                </div>
                <div class="box-body">
                    <div id="accordion" class="box-group">
                        <div class="panel box box-primary">
                            <div class="box-header">
                                <h4 class="box-title">
                                    Thông tin cá nhân
                                </h4>
                            </div>
                            <div class="box-body">
                                <p>Họ tên: <b>Nguyễn Thị Tuyết Nhật</b></p>
                                <p>Học phần: <b>PHP nâng cao</b></p>
                                <p>Lớp học phần: <b>CĐTH22WebC - PHP nâng cao</b></p>
                                <p>Giảng viên: <b>Nguyễn Đức Duy</b></p>
                                <p>Số sao: <b>5</b></p>
                                <p>Ngày tạo: <b>11/10/2025</b></p>
                            </div>
                        </div>
                        <div class="panel box box-success">
                            <div class="box-header">
                                <h4 class="box-title">
                                    Nội dung đánh giá:
                                </h4>
                            </div>
                            <div class="box-body">
                                cũng cũng
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
