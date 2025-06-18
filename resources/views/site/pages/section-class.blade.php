@extends('site.layout')
@section('content')
 <!-- content -->
            <div class="col-xs-12 col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                                    class="fa fa-angle-double-left" data-toggle="offcanvas"
                                    title="Maximize Panel"></span></a>Menu</h3>
                    </div>
                    <?php
                        // foreach($section_class as $class):
                        //     echo $class->ngay_tao;
                        // endforeach;
                    ?>
                    <div class="panel-section-class mt-4 d-flex align-items-center justify-content-center"
                        style="--bg-avatar: url('<?php echo URL::to(config('asset.images_path'). $section_class[0]->hinh_anh )?>')">
                        <h2 class="text-dark p-5 m-0 bg-section-class"><b>CĐ TH22WEB C - Thiết kế website</b></h2>
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
                                        <img class="avatar-lecture-small" src="<?php echo URL::to(config('asset.images_path'). $section_class[0]->avatar )?>" alt="">
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="small-text"><b>{{$section_class[0]->ho_ten}}</b></h6>
                                        <h6 class="small-text">11/06/2025</h6>
                                    </div>
                                </div>
                                <div class="content-section-class">
                                   {{$lessons[0]->ten_bg}}
                                </div>

                                <div class="comment-line px-0 pt-3 mt-3">
                                    <div class="comment-list">
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item1">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'8.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Nguyễn Thị Tuyết Nhật học sinh lớp CĐ
                                                    TH22WEBC tôi rất cute hột me nhưng tui hay cáu bửng vô cơ, tôi chả
                                                    làm cái chó gì nhưng tui luôn cảm thấy mình burn out không có lý do
                                                    và tôi muốn gửi một tín hiệu đến vũ trụ rằng tui muốn có một công
                                                    việc tốt vừa sức khi ra trường</h6>
                                            </div>
                                        </div>
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item1">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'2.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Thỏ vì tôi không đủ ranh mãnh, ăn
                                                    uống thì thanh cảnh, tính chẳng được lưu manh, còn tôi tên là hổ tôi
                                                    không ở xa lắm sống ở bên kia đồi, bên kia đồi xanh xanh.</h6>
                                            </div>
                                        </div>
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item1">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'3.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Nguyễn Thị Tuyết Nhật học sinh lớp CĐ
                                                    TH22WEBC tôi rất cute hột me nhưng tui hay cáu bửng vô cơ, tôi chả
                                                    làm cái chó gì nhưng tui luôn cảm thấy mình burn out không có lý do
                                                    và tôi muốn gửi một tín hiệu đến vũ trụ rằng tui muốn có một công
                                                    việc tốt vừa sức khi ra trường</h6>
                                            </div>
                                        </div>
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item1">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'4.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Nguyễn Thị Tuyết Nhật học sinh lớp CĐ
                                                    TH22WEBC tôi rất cute hột me nhưng tui hay cáu bửng vô cơ, tôi chả
                                                    làm cái chó gì nhưng tui luôn cảm thấy mình burn out không có lý do
                                                    và tôi muốn gửi một tín hiệu đến vũ trụ rằng tui muốn có một công
                                                    việc tốt vừa sức khi ra trường</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <button onclick="showHidenCmt(1)" class="small-text ms-5 coler-button-showall" id="show-all-cmt">Tất cả bình luận (3)</button>
                                    <form
                                        class="form-inline d-flex justify-content-between align-items-center row p-0 m-0 mt-3">
                                        <div class="d-flex justify-content-center col-2 col-md-1 p-0">
                                            <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'1.png')}}" alt="">
                                        </div>
                                        <div class="form-group mb-0 col-8 col-md-10 py-0 px-1">
                                            <input type="password" class="form-control w-100 h-100 py-2"
                                                id="inputPassword2" placeholder="Thêm nhận xét...">
                                        </div>
                                        <div class="col-2 col-md-1 p-0">
                                            <button type="submit" class="btn btn-primary py-2 btn-bgr"><i
                                                    class="fa fa-send"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                                <?php endforeach;
								endif;
								?>
                            {{-- <div class="row avatar-tutor-section-class p-3 mb-3">
                                <div class="col-12 d-flex p-0">
                                    <div class="d-flex justify-content pe-3">
                                        <img class="avatar-lecture-small" src="{{URL::to(config('asset.images_path').'1.png')}}" alt="">
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="small-text"><b>Dương Trọng Đính</b></h6>
                                        <h6 class="small-text">11/06/2025</h6>
                                    </div>
                                </div>
                                <div class="content-section-class">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit architecto ratione
                                    eligendi ut aperiam praesentium, aliquid sit! Nemo ullam nostrum quidem ea earum
                                    nobis commodi, consectetur enim ipsam vel odio!
                                </div>

                                <div class="comment-line px-0 pt-3 mt-3">
                                    <div class="comment-list">
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item2">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'8.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Nguyễn Thị Tuyết Nhật học sinh lớp CĐ
                                                    TH22WEBC tôi rất cute hột me nhưng tui hay cáu bửng vô cơ, tôi chả
                                                    làm cái chó gì nhưng tui luôn cảm thấy mình burn out không có lý do
                                                    và tôi muốn gửi một tín hiệu đến vũ trụ rằng tui muốn có một công
                                                    việc tốt vừa sức khi ra trường</h6>
                                            </div>
                                        </div>
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item2">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'2.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Thỏ vì tôi không đủ ranh mãnh, ăn
                                                    uống thì thanh cảnh, tính chẳng được lưu manh, còn tôi tên là hổ tôi
                                                    không ở xa lắm sống ở bên kia đồi, bên kia đồi xanh xanh.</h6>
                                            </div>
                                        </div>
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item2">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'3.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Nguyễn Thị Tuyết Nhật học sinh lớp CĐ
                                                    TH22WEBC tôi rất cute hột me nhưng tui hay cáu bửng vô cơ, tôi chả
                                                    làm cái chó gì nhưng tui luôn cảm thấy mình burn out không có lý do
                                                    và tôi muốn gửi một tín hiệu đến vũ trụ rằng tui muốn có một công
                                                    việc tốt vừa sức khi ra trường</h6>
                                            </div>
                                        </div>
                                        <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item2">
                                            <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                                <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'4.png')}}" alt="">
                                            </div>
                                            <div class="my-auto col-10 p-1">
                                                <div class="d-flex">
                                                    <h6 class="small-text"><b>Nguyễn Thị Tuyết Nhật</b></h6>
                                                    <h6 class="small-text px-2">11/06/2025</h6>
                                                </div>
                                                <h6 class="small-title">Tôi tên là Nguyễn Thị Tuyết Nhật học sinh lớp CĐ
                                                    TH22WEBC tôi rất cute hột me nhưng tui hay cáu bửng vô cơ, tôi chả
                                                    làm cái chó gì nhưng tui luôn cảm thấy mình burn out không có lý do
                                                    và tôi muốn gửi một tín hiệu đến vũ trụ rằng tui muốn có một công
                                                    việc tốt vừa sức khi ra trường</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <button onclick="showHidenCmt(2)" class="small-text ms-5 coler-button-showall" id="show-all-cmt">Tất cả bình luận (3)</button>
                                    <form
                                        class="form-inline d-flex justify-content-between align-items-center row p-0 m-0 mt-3">
                                        <div class="d-flex justify-content-center col-2 col-md-1 p-0">
                                            <img class="avatar-student-smaller" src="{{URL::to(config('asset.images_path').'1.png')}}" alt="">
                                        </div>
                                        <div class="form-group mb-0 col-8 col-md-10 py-0 px-1">
                                            <input type="password" class="form-control w-100 h-100 py-2"
                                                id="inputPassword2" placeholder="Thêm nhận xét...">
                                        </div>
                                        <div class="col-2 col-md-1 p-0">
                                            <button type="submit" class="btn btn-primary py-2 btn-bgr"><i
                                                    class="fa fa-send"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
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
        function showHidenCmt(index){
            var commentItems= document.getElementsByClassName('comment-item'+index);
            for(var i = 0; i<commentItems.length; i++){
                commentItems[i].classList.toggle('comment-hide');               

            }
        }
    </script>
@endsection