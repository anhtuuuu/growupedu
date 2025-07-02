@extends('site.layout')
@section('content')
    <?php if(isset($row) && !empty($row)): ?>
    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                            class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Menu</h3>
            </div>
            <!--panel-Body-->
            <div class="panel-body">
                <div class="content-row">
                    <center>
                        <h1>{{ $row->tieu_de }}</h1>
                    </center>
                    <hr>
                    <?php if(!empty($row->video)): ?>
                    <h3 style="color:#ff9900;"><img src="../images/clogo.png" width="40" alt="">&nbsp;Video bài
                        học:</h3><br>
                    <iframe width="100%" src="https://www.youtube.com/embed/<?php echo str_replace('https://youtu.be/','', $row->video)?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <?php endif; ?>
                    <p>{{ $row->mo_ta }}</p>
                    <br>
                    <h3 style="color:#ff9900;"><img src="../images/clogo.png" width="40" alt="">&nbsp;Nội dung chi tiết:
                    </h3><br>
                    {!! $row->noi_dung !!}
                    <br>
                    <?php if (isset($lecturer)): ?>
                    <h3 style="color:#ff9900;"><img src="../images/clogo.png" width="40" alt="">&nbsp;Thông tin
                        giảng viên: </h3><br>
                    <ul class="m-0">
                        <li class="list-group-item"><b>Họ tên: </b>{{ $lecturer->ho_ten }}</li>
                        <li class="list-group-item"><b>Email: </b>{{ $lecturer->email }}</li>
                        <li class="list-group-item"><b>Ngày sinh: </b>{{ $lecturer->sdt }}</li>
                        <li class="list-group-item"><b>Liên kết: </b><a href="{{ $lecturer->lien_ket }}">{{ $lecturer->lien_ket }}</a></li>
                    </ul>
                    <?php endif; ?>
                </div>


                <!-- end panel body -->
            </div>
        </div>
        <?php endif; ?>
    @endsection
