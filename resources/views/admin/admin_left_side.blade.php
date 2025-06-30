<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://th.bing.com/th/id/OIP.uzGed-nXH0q-PqTfZqgEDQAAAA?w=218&h=219&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3"
                    class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Chào <?php echo Session::has('admin_name') ? Session::get('admin_name') : 'Admin'; ?>!</p>
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <?php if(Session::has('admin_role')):?>
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li>
                <a href="" class="">
                    <i class="fa fa-dashboard"></i> <span>Bảng điều khiển</span>
                </a>
            </li>
            <?php if(Session::get('admin_role') == 1): ?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Cấu hình</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Cấu hình chung</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Cấu hình site</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý tài khoản</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-tai-khoan') }}"><i class="fa fa-angle-double-right"></i>Danh
                            sách tài khoản</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm tài khoản</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý khoa</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-khoa') }}"><i class="fa fa-angle-double-right"></i>Danh sách
                            khoa</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm khoa</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý bộ môn</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-bo-mon') }}"><i class="fa fa-angle-double-right"></i>Danh sách
                            bộ môn</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm bộ môn</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý học phần</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-hoc-phan') }}"><i class="fa fa-angle-double-right"></i>Danh sách
                            học phần</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm học phần</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(Session::get('admin_role') == 2): ?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý lớp học phần</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-lop-hoc-phan') }}"><i class="fa fa-angle-double-right"></i> Danh
                            sách lớp học phần</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i> Thêm lớp học phần</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý bài giảng</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-bai-giang') }}"><i class="fa fa-angle-double-right"></i>Danh
                            sách bài giảng</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm bài giảng</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý chương</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-chuong') }}"><i class="fa fa-angle-double-right"></i>Danh sách
                            chương</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm chương</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý bài</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-bai') }}"><i class="fa fa-angle-double-right"></i>Danh sách
                            bài</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm bài</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý sinh viên</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-sinh-vien') }}"><i class="fa fa-angle-double-right"></i>Danh
                            sách sinh viên</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm sinh viên</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý giảng viên</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-giang-vien') }}"><i class="fa fa-angle-double-right"></i>Danh
                            sách giảng viên</a></li>
                    {{-- <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm </a></li> --}}
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý đánh giá</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-danh-gia') }}"><i class="fa fa-angle-double-right"></i>Danh
                            sách đánh giá</a></li>
                    {{-- <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm </a></li> --}}
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cogs"></i> <span>Quản lý bài kiểm tra</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('/danh-sach-bai-kiem-tra') }}"><i
                                class="fa fa-angle-double-right"></i>Danh sách bài kiểm tra</a></li>
                    {{-- <li><a href=""><i class="fa fa-angle-double-right"></i>Thêm </a></li> --}}
                </ul>
            </li>
            <?php endif;?>
        </ul>
        <?php endif; ?>
    </section>
</aside>
