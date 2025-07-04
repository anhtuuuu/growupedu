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
                    if(isset($tests) && !empty($tests)):
                    foreach ($tests as $row):?>
                    <div class="ppcolumn pt-4">
                        <?php if(isset($check_submited) && !empty($check_submited)):
							foreach($check_submited as $check): 
							if($row->ma_bkt == $check->ma_bkt):
							?>
                        <a class="appt text-success">Đã thực hiện</a>
                        <?php break; else: ?>
                        <a href="<?php echo URL::to($row->alias_lhp . '/' . $row->ma_bkt . '/test'); ?>" class="appt">Xem chi tiết</a>
                        <?php break; endif; endforeach; endif; ?>
                        <img src="{{ URL::to(config('asset.images_path') . 'd-img.png') }}"
                            style="padding-bottom:5px;height:60px" />
                        <h5 style="word-wrap: break-word;">{{ $row->tieu_de }}</h5>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>


        <!-- end panel body -->
    </div>
@endsection
