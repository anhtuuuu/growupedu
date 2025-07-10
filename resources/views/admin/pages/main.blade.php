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
            <?php if(Session::has('admin_role') && Session::get('admin_role') == 1): ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tài khoản</span>
                        <span class="info-box-number">
                            {{ Session::has('count_account') ? Session::get('count_account') : '' }}
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
                            {{ Session::has('count_subject') ? Session::get('count_subject') : '' }}

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
                            {{ Session::has('count_course') ? Session::get('count_course') : '' }}
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
                            {{ Session::has('count_class') ? Session::get('count_class') : '' }}
                        </span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(Session::has('admin_role') && Session::get('admin_role') == 2): ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Lớp học phần</span>
                        <span class="info-box-number">
                            {{ Session::has('count_class') ? Session::get('count_class') : '' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-edit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bài giảng</span>
                        <span class="info-box-number">
                            {{ Session::has('count_lesson') ? Session::get('count_lesson') : '' }}

                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-file"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bài</span>
                        <span class="info-box-number">
                            {{ Session::has('count_content') ? Session::get('count_content') : '' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bài kiểm tra</span>
                        <span class="info-box-number">
                            {{ Session::has('count_test') ? Session::get('count_test') : '' }}
                        </span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- End Main content -->
@endsection
