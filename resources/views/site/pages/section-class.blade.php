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
                    if(isset($chapters) && !empty($chapters)):
                    foreach ($chapters as $row):?>
                    <div class="row avatar-tutor-section-class p-3 mb-3">

                        <div class="col-12 d-flex p-0">
                            <div class="d-flex justify-content pe-3">
                                <img class="avatar-lecture-small" src="<?php echo URL::to(config('asset.images_path') . $section_class[0]->avatar); ?>" alt="">
                            </div>
                            <div class="my-auto">
                                <h6 class="small-text"><b>{{ $section_class[0]->ho_ten }}</b></h6>
                                <h6 class="small-text">{{ $row->ngay_tao }}</h6>
                            </div>
                        </div>
                        <h4 class="mt-3"><b>{{ $row->ten_chuong }}</b></h4>


                        <div class="comment-line px-0 pt-3 mt-3">
                            <div class="comment-list">
                                <?php 
                                    if(isset($contents) && !empty($contents)):
                                    foreach($contents as $content):
                                    if($row->ma_chuong == $content->ma_chuong):
                                    ?>
                                <a href="/{{$section_class[0]->alias}}/{{$lessons[0]->alias}}/{{$row->alias}}/{{$content->alias}}" class="card d-flex align-items-center mt-3 py-2 color-course">
                                    <div class="row col-12 d-flex p-0 m-0 comment-hide comment-item1" >
                                        <div class="d-flex col-2 justify-content-center col-2 col-md-1 ">
                                            <img class="" width="35px" src="<?php echo URL::to(config('asset.images_path') . 'bai.png'); ?>" alt="">
                                        </div>
                                        <div class="my-auto col-10 p-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="d-flex align-items-center m-0"><b>{{ $content->tieu_de }}</b>
                                                </h6>
                                                <h6 class="small-text px-2 m-0 d-flex align-items-center">
                                                    {{ $content->ngay_tao }}</h6>
                                            </div>
                                            {{-- <h6 class="small-title">{{ $content->noi_dung }}</h6> --}}
                                        </div>
                                    </div>
                                </a>
                                <?php endif; endforeach; endif; ?>
                            </div>

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
