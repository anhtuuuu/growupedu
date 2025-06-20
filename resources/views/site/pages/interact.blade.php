@extends('site.layout')
@section('content')
    <!-- content -->
    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                            class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Menu</h3>
            </div>
            <?php
            ?>
            <div class="panel-section-class mt-4 d-flex align-items-center justify-content-center"
                style="--bg-avatar: url('<?php echo URL::to(config('asset.images_path') . $section_class[0]->hinh_anh); ?>')">
                <h2 class="text-dark p-5 m-0 bg-section-class"><b>{{ $section_class[0]->ten_lhp }}</b></h2>
            </div>
            <!--panel-Body-->
            <div class="panel-body">
                <div class="px-2 px-md-5">
                    <?php
                    if(isset($lessons) && !empty($lessons)):
                    foreach ($lessons as $row):?>
                    <div class="row avatar-tutor-section-class p-3 mb-3">

                        <div class="col-12 d-flex p-0">
                            <div class="d-flex justify-content pe-3">
                                <img class="avatar-lecture-small" src="<?php echo URL::to(config('asset.images_path') . $section_class[0]->avatar); ?>" alt="">
                            </div>
                            <div class="my-auto">
                                <h6 class="small-text"><b>{{ $section_class[0]->ho_ten }}</b></h6>
                                <h6 class="small-text">{{ $section_class[0]->ngay_tao }}</h6>
                            </div>
                        </div>
                        <div class="content-section-class mt-3"><h2><b>Đặt câu hỏi: 
                            {{ $section_class[0]->ten_lhp }}</b></h2>
                        </div>

                        <div class="comment-line px-0 pt-3 mt-3">
                            <div class="comment-list">
                                <?php 
                                    if(isset($interacts) && !empty($interacts)):
                                    foreach($interacts as $interact):
                                    if($row->ma_bg == $interact->ma_bg):
                                    ?>
                                <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item1">
                                    <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                        <img class="avatar-student-smaller" src="<?php echo URL::to(config('asset.images_path') . $interact->avatar); ?>" alt="">
                                    </div>
                                    <div class="my-auto col-10 p-1">
                                        <div class="d-flex">
                                            <h6 class="small-text"><b>{{ $interact->ho_ten }}</b></h6>
                                            <h6 class="small-text px-2">{{ $interact->ngay_tao }}</h6>
                                        </div>
                                        <h6 class="small-title">{{ $interact->noi_dung }}</h6>
                                    </div>
                                </div>
                                <?php endif; endforeach; endif; ?>
                            </div>
                            <button onclick="showHidenCmt(1)" class="small-text ms-5 coler-button-showall"
                                id="show-all-cmt">Tất cả bình luận (3)</button>
                            <form class="form-inline d-flex justify-content-between align-items-center row p-0 m-0 mt-3">
                                <div class="d-flex justify-content-center col-2 col-md-1 p-0">
                                    <img class="avatar-student-smaller"
                                        src="{{ URL::to(config('asset.images_path') . '1.png') }}" alt="">
                                </div>
                                <div class="form-group mb-0 col-8 col-md-10 py-0 px-1">
                                    <input type="password" class="form-control w-100 h-100 py-2" id="inputPassword2"
                                        placeholder="Thêm nhận xét...">
                                </div>
                                <div class="col-2 col-md-1 p-0">
                                    <button type="submit" class="btn btn-primary py-2 btn-bgr"><i
                                            class="fa fa-send"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>            
            <!-- end panel body -->
        </div>
    </div>
    <!-- end content -->
@endsection
@section('javascript')
    <script>
        var showAllCmt = document.getElementById('show-all-cmt');

        function showHidenCmt(index) {
            var commentItems = document.getElementsByClassName('comment-item' + index);
            for (var i = 0; i < commentItems.length; i++) {
                commentItems[i].classList.toggle('comment-hide');

            }
        }
    </script>
@endsection
