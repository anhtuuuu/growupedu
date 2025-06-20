<nav role="navigation" class="">
    <div class="row px-3 px-md-5 position-relative">
        <!-- tìm kiếm -->
        <div class="col-5 col-md-3 position-absolute search p-0">
            <form method="post row p-0 position-relative">
                <input name="txtsearch" placeholder="Tìm kiếm..." class="textboxcss m-0 w-100" value="" list="subnames"
                    required></input>
                <button type="submit" name="btnsearch"
                    class="buttoncss m-0 text-lghtgoldyellow position-absolute end-0 "><i
                        class="fa fa-search"></i></button>
            </form>
        </div>

        <!-- logo -->

        <div class="d-flex justify-content-end justify-content-md-center p-0">
            <img class="p-0" src="{{URL::to(config('asset.images_path').'Nhat.png')}}" height="90" alt=""
                style="padding-left:5px;padding-top:2px;padding-bottom:5px;">
        </div>


    </div>

    <!-- main menu-->
    <div class="topnav d-flex justify-content-between" id="myTopnav">
        <div class="leftNav">
            <a href="{{URL::to('/')}}" class="text-lghtgoldyellow">Trang chủ</a>
            <div class="mdropdown">
                <button class="mdropbtn text-lghtgoldyellow">Khoa
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="mdropdown-content">
                    <a href="index.html" class="text-dark">Công nghệ thông tin</a>
                </div>
            </div>
            <div class="mdropdown">
                <button class="mdropbtn text-lghtgoldyellow">Lớp học phần
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="mdropdown-content">
                    <?php 
                    if(isset($load_section_class) &&  !empty($load_section_class) && is_array($load_section_class)):
                        foreach($load_section_class as $row): ?>
                    
                    <a href="{{$row->alias}}" class="text-dark">{{$row->ten_lhp}}</a>
                    <?php
                    endforeach;     
                    endif; ?>
                </div>
            </div>
        </div>
        <div class="rightNav">
            <a href="../account-manager.html" class="text-lghtgoldyellow">Quản lý tài khoản</a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <!-- end main menu-->
</nav>