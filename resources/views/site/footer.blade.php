<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <h6>Thông tin liên hệ</h6>
                <ul class="footer-links">
                    <li><b>Địa chỉ: </b>{{ Session::get('config_address') }}</li>
                    <li><b>SĐT: </b>{{ Session::get('config_phone') }}</li>
                    <li><b>Email: </b>{{ Session::get('config_email') }}</li>
                    <li><b>Website: </b><a href="">{{ Session::get('config_website') }}</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-md-3" style="padding-left:100px;">
                <h6>Lớp học phần</h6>

                <ul class="footer-links">
                    <?php if(isset($load_section_class) && !empty($load_section_class) && is_array($load_section_class)): 
                    foreach($load_section_class as $value): ?>
                    <li class="list-group-item"><a href="{{ URL::to($value->alias) }}"><i
                                class="glyphicon glyphicon-list-alt"></i>
                            {{ $value->ten_lhp }}</a></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2025 <a href="#">{{ Session::get('config_site_name') }}</a>.</p>
            </div>

            <!-- <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div> -->
        </div>
    </div>
</footer>
