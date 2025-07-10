<header class="main-header">
    <a href="" class="logo" target="_blank"><?php echo Session::has('admin_role') && Session::get('admin_role') == 1 ? "Administrator" : 'Giảng viên' ?></a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://th.bing.com/th/id/OIP.uzGed-nXH0q-PqTfZqgEDQAAAA?w=218&h=219&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3"
                            class="user-image" alt="" />
                        <span class="hidden-xs">
                            <?php echo Session::has('admin_name') ? Session::get('admin_name') : '' ?><i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="https://th.bing.com/th/id/OIP.uzGed-nXH0q-PqTfZqgEDQAAAA?w=218&h=219&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3"
                                class="img-circle" alt="" />
                            <p>
                                <?php echo Session::has('admin_name') ? Session::get('admin_name') : '' ?>
                                <small>Tham gia từ
                                    <?php echo Session::has('admin_joined') ? Session::get('admin_joined') : '' ?>
                                </small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{URL::to('thong-tin-ca-nhan')}}" class="btn btn-default btn-flat">Thông tin cá nhân</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{URL::to('logout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
