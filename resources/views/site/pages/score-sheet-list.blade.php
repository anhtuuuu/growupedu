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
                <div class="content-row px-5">
                    <?php
                    if(isset($submitted_tests) && !empty($submitted_tests)):
                    foreach ($submitted_tests as $row):?>
                    <div class="ppcolumn p-4">
                        <a href="<?php echo URL::to($row->alias_lhp . '/' . $row->ma_bkt . '/bang-diem'); ?>" class="appt">Xem chi tiết</a>
                        <img src="{{ URL::to(config('asset.images_path') . 'x-img.png') }}"
                            style="padding-bottom:5px; height: 60px;" />
                        <h5 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $row->tieu_de }}</h5>
                    </div>
                    <?php endforeach;?>
                    <?php else: ?>
                    <h3>Chưa có bảng điểm nào.</h3>
                    <?php endif; ?>
                </div>

            </div>
        </div>


        <!-- end panel body -->
    </div>
@endsection
