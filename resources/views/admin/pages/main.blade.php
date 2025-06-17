@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    <!-- Start Main content -->
    <section class="content">
        <div class="row">
            <div id="notify" class="col-lg-12">
                <!--  -->
            </div>
        </div>
        <h4 class="text-capitalize">Thông tin hệ thống</h4>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Khoa</span>
                        <span class="info-box-number">
                            1
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-edit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bộ môn</span>
                        <span class="info-box-number">
                            5
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-file"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Học phần</span>
                        <span class="info-box-number">
                            5
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Lớp học phần</span>
                        <span class="info-box-number">
                            10
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Main content -->
@endsection