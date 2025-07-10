@extends('site.layout')
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                            class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Menu</h3>
            </div>
            <!--panel-Body-->
            <div class="panel-body">
                <div class="content-row px-3">
                    <?php                    
                    if(isset($tests) && !empty($tests)):
                    foreach ($tests as $row): $check_ex = 0;?>
                    <div class="ppcolumn p-4">
                        <?php if(isset($check_submited) && !empty($check_submited)):
							foreach($check_submited as $check): 
							if($row->ma_bkt == $check->ma_bkt): ?>
                        <a class="appt text-success">Đã thực hiện</a>
                        <?php $check_ex = 1; endif; endforeach; endif; ?>
                        <?php if($check_ex == 0)
                        if($row->han_nop < now()):
                        ?>
                        <a class="appt text-danger">Hết hạn</a>
                        <?php elseif($row->bat_dau > now()): ?>
                        <a class="appt text-warning">Sắp diễn ra</a>
                        <?php else: ?>
                        <a href="<?php echo URL::to($row->alias_lhp . '/' . $row->ma_bkt . '/test'); ?>" class="appt">Xem chi tiết</a>
                        <?php endif; ?>
                        <img src="{{ URL::to(config('asset.images_path') . 'd-img.png') }}"
                            style="padding-bottom:5px;height:50px" />
                        <h5 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>{{ $row->tieu_de }}</b></h5>
                        <div class="">
                            <span>Bắt đầu: <b>{{ $row->bat_dau }}</b></span><br>
                            <span>Kết thúc: <b>{{ $row->han_nop }}</b></span>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>


        <!-- end panel body -->
    </div>
@endsection
