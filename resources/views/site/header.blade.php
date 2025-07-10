<nav role="navigation" class="">
    <div class="row px-3 px-md-5 position-relative">
        <!-- tìm kiếm -->
        @error('q')
            <div class="text-danger position-absolute top-0">{{ $message }}</div>
        @enderror
        <div class="col-5 col-md-3 position-absolute search p-0">
            <?php if(!isset($not_in_class)): ?>
            <form method="get" action="{{ URL::to('tim-kiem') }}">
                <input name="q" placeholder="Tìm kiếm..." class="textboxcss m-0 w-100" value=""
                    list="subnames"></input>
                <button type="submit" name="btnsearch"
                    class="buttoncss m-0 text-lghtgoldyellow position-absolute end-0 "><i
                        class="fa fa-search"></i></button>
            </form>
            <?php endif; ?>
        </div>

        <!-- logo -->

        <div class="d-flex justify-content-end justify-content-md-center p-0">
            <img class="p-0" src="<?php echo URL::to(config('asset.images_path') . (Session::has('config_logo') ? Session::get('config_logo') : 'no-image.png')); ?>" height="90" alt=""
                style="padding-left:5px;padding-top:2px;padding-bottom:5px;">
        </div>


    </div>

    <!-- main menu-->
    <div class="topnav d-flex justify-content-between" id="myTopnav">
        <div class="leftNav">
            <a href="{{ URL::to('/') }}" class="text-lghtgoldyellow">Trang chủ</a>
            {{-- <div class="mdropdown">
                <button class="mdropbtn text-lghtgoldyellow">Khoa
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="mdropdown-content">
                    <a href="index.html" class="text-dark">Công nghệ thông tin</a>
                </div>
            </div> --}}
            <div class="mdropdown">
                <button class="mdropbtn text-lghtgoldyellow">Lớp học phần
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="mdropdown-content">
                    <?php if(isset($load_section_class) &&  !empty($load_section_class) && is_array($load_section_class)):
                        foreach($load_section_class as $row): ?>
                    <a href="<?php echo URL::to($row->alias); ?>" class="text-dark">{{ $row->ten_lhp }}</a>
                    <?php endforeach; endif;?>
                </div>
            </div>
            <!-- Button to Open the Modal -->
            <a type="button" class="text-lghtgoldyellow" data-bs-toggle="modal" data-bs-target="#myModal">
                Thông báo
            </a>
        </div>
        <div class="rightNav">
            <a href="{{ URL::to('thong-tin-tai-khoan') }}"
                class="text-lghtgoldyellow">{{ Session::has('client_name') ? Session::get('client_name') : '' }}</a>
            <a href="{{ URL::to('dang-xuat') }}" class="text-lghtgoldyellow">Đăng xuất</a>

        </div>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <!-- end main menu-->
</nav>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thông báo mới</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-notice">
                <?php if(isset($notification) && !empty($notification)):
                    foreach($notification as $noti): ?>
                <div class="d-flex justify-content-between">
                    <p><b>{{ $noti->ho_ten }}</b> {{ $noti->mo_ta }}</p>
                    <span>{{ $noti->ngay_tao }}</span>
                </div>
                <h5 class="text-warning"><b>{{ $noti->noi_dung }}</b></h5>
                <hr>
                <?php endforeach; endif; ?>
                {{-- <h5>Tooltips in a modal</h5>
                <p><a href="#" class="tooltip-test" title="Tooltip">This link</a> and <a href="#"
                        class="tooltip-test" title="Tooltip">that link</a> have tooltips on hover.</p> --}}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-bgr" data-bs-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
