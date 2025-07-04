@extends('site.layout')
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

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
                        <div class="content-section-class mt-3">
                            <h2><b>Đặt câu hỏi:
                                    {{ $section_class[0]->ten_lhp }}</b></h2>
                        </div>

                        <div class="comment-line px-0 pt-3 mt-3">
                            <div class="comment-list" id="comment-list">
                                <?php 
                                    $count = 0;
                                    if(isset($interacts) && !empty($interacts)):
                                    foreach($interacts as $interact):
                                    if($section_class[0]->ma_lhp == $interact->ma_lhp):
                                    ?>
                                <div class="row col-12 d-flex p-0 m-0 mt-3 comment-hide comment-item1">
                                    <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                        <img class="avatar-student-smaller" src="<?php echo URL::to(config('asset.images_path') . $interact->avatar); ?>" alt="">
                                    </div>
                                    <div class="my-auto col-8 p-1">
                                        <div class="d-flex">
                                            <h6 class="small-text"><b>{{ $interact->ho_ten }}</b></h6>
                                            <h6 class="small-text px-2">{{ $interact->ngay_tao }}</h6>
                                            <?php if(isset($is_lecturer) && !empty($is_lecturer)):?>
                                            <div class="btn-del">
                                                <a href="{{URL::to('/xoa-tuong-tac/'.$interact->id)}}" class="d-flex align-items-center" onclick="return confirm('Xác nhận xóa tương tác này?')"><em
                                                        class="fa fa-trash-o fa-lg text-danger">&nbsp;</em></a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <h6 class="small-title" style="word-wrap: break-word;">{{ $interact->noi_dung }}
                                        </h6>
                                    </div>
                                </div>
                                <?php $count++; endif; endforeach; endif; ?>
                            </div>
                            <button onclick="showHidenCmt(1)" class="small-text ms-5 coler-button-showall"
                                id="show-all-cmt">Hiển thị tất cả bình luận</button>
                            <form id="tuong-tac"
                                class="form-inline d-flex justify-content-between align-items-center row p-0 m-0 mt-3">
                                @csrf
                                <div class="d-flex justify-content-center col-2 col-md-1 p-0">
                                    <img class="avatar-student-smaller"
                                        src="{{ URL::to(config('asset.images_path') . Session::get('client_avatar')) }}"
                                        alt="">
                                </div>
                                <input type="hidden" hidden name="ma_lhp" value="{{ $section_class[0]->ma_lhp }}">
                                <div class="form-group mb-0 col-8 col-md-10 py-0 px-1">
                                    <input type="text" class="form-control w-100 h-100 py-2" id=""
                                        name="noi_dung" placeholder="Thêm nhận xét...">
                                </div>
                                <div class="col-2 col-md-1 p-0">
                                    <button type="submit" class="btn btn-primary py-2 btn-bgr"><i
                                            class="fa fa-send"></i></button>
                                </div>
                            </form>
                            @error('noi_dung')
                                <div class="text-danger px-1 px-md-5 mx-5">{{ $message }}</div>
                            @enderror
                            <div class="text-danger px-1 px-md-5 mx-5" id="message"></div>
                        </div>
                    </div>

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

        $(document).ready(function() {
            $('#tuong-tac').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/gui-tuong-tac',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#comment-list').append(response);
                        $('#tuong-tac')[0].reset();
                    },
                    error: function(xhr) {
                        $('#message').html('Có lỗi xảy ra!');
                    }
                });
            });
        });
    </script>
@endsection
