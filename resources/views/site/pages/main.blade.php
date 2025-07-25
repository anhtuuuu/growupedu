@extends('site.layout')
@section('content')
    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                            class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Menu</h3>
            </div>
            <!--panel-Body-->
            <div class="panel-body">
                <div class="content-row px-3">
                    <!-- card-start -->
                    <div class="row">
                          <?php
                        if(isset($section_class_none) && !empty($section_class_none)):
                        foreach ($section_class_none as $row):?>
                            <div class="col-12 col-md-6 col-lg-4 p-3">
                                <a href="{{URL::to($row->alias)}}">
                                <div class="card">
                                    <div class="bg-card card-img-top"
                                        style="--bg-avatar: url('{{ URL::to(config('asset.images_path') . $row->hinh_anh) }}')">
                                    </div>

                                    <div class="d-flex justify-content-end pe-3 avatar-tutor ">
                                        <img class="avatar-lecture" src="{{ URL::to(config('asset.images_path') . $row->avatar) }}"
                                            alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title hv-link"><a href="{{$row->alias}}" class="text-dark">{{$row->ten_lhp}}</a></h5>
                                        <p class="card-text hv-link"><a href="" class="text-dark">{{$row->mo_ta}}</a></p>
                                    </div>
                                    <div class="card-body d-flex justify-content-end">
                                        <a href="{{URL::to($row->alias.'/test')}}" class="card-link"><i class="fa fa-file mx-3"></i></a>
                                        <a href="{{URL::to($row->alias.'/'.$row->alias_bg.'/files-bai-giang')}}" class="card-link"><i class="fa fa-folder"></i></a>
                                    </div>
                                </div>
                                </a>
                            </div>
                        <?php endforeach;
                        endif;
                        ?>
                    </div>
                    <!-- card-finish -->
                </div>
            </div>
        </div>
        <!-- end panel body -->
    </div>
@endsection
