@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    <section class="content">
        <div class="row">
            <div id="notify" class="col-lg-12">
          
            </div>
        </div>
        <h4 class="text-capitalize">Thông tin hiệu suất: <b>Nguyễn Văn A</b></h4>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Số lượng sinh viên</span>
                        <span class="info-box-number">
                            100
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-edit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Điểm số trung bình</span>
                        <span class="info-box-number">
                            8.5
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-file"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Trung bình số sao</span>
                        <span class="info-box-number">
                            4.7
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Lớp học quản lý</span>
                        <span class="info-box-number">
                            4
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
