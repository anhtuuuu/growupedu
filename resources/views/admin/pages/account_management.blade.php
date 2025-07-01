@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý tài khoản</b></h3>
                    <a class="btn btn-success pull-right" href="<?php echo URL::to('them-tai-khoan'); ?>"><i class="fa fa-plus"></i> Thêm</a>
                </div>
                <div class="box-body">

                    <form class="form-inline" name="main" method="post" action="">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">
                                                                                <input class="flat-blue check-all" name="check_all[]"
                                                                                    type="checkbox" value="yes">
                                                                            </th> -->
                                        <th class="text-center" style="width: 20px">Sắp xếp</th>
                                        <th class="text-center" style="width:120px">Ảnh đại diện</th>
                                        <th class="text-center" style="width:auto">Họ tên</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Vai trò</th>
                                        <th class="text-center">Trạng thái kích hoạt</th>
                                        <th class="text-center" style="width: 160px;">Chức năng</th>
                                        <!-- <th class="text-center">Nổi bật</th>
                                                                    <th class="text-center">Mới nhất</th> -->
                                        <!-- <th class="text-center">Chức năng</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && !empty($rows)):
                                        foreach($rows as $index => $row): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="{{ $index + 1 }}">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td>
                                            <a class="img-fancybox d-flex justify-content-center" href=""
                                                title=""><img width="40" class="img-rounded img-responsive"
                                                    alt="" src="<?php echo URL::to(config('asset.images_path') . $row->hinh_anh); ?>"></a>
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ho_ten }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->email }}
                                        </td>
                                        <td class="text-center">
                                            <p class='text-bold text-primary'>
                                                {{ $row->vai_tro }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="inhome[]" class="change-inhome flat-blue"
                                                value="" <?php echo $row->kich_hoat ? 'checked' : ''; ?>>
                                        </td>
                                        <td class="text-center">
                                            <form action="<?php echo URL::to('xoa-tai-khoan/' . $row->ma_tk); ?>" method="post"
                                                onsubmit="return confirmSubmit();">
                                                {{ csrf_field() }}

                                                <em class="fa fa-edit fa-lg">&nbsp;</em> <a
                                                    href="<?php echo URL::to('cap-nhat-tai-khoan/' . $row->ma_tk); ?>">Sửa</a>
                                                &nbsp;-&nbsp;
                                                <em class="fa fa-trash-o fa-lg">&nbsp;</em>
                                                <button class="delete_bootbox">
                                                    Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif;?>
                                </tbody>
                            </table>


                        </div>
                    </form>
                </div>
                <div class="box-footer clearfix">
                    {{ isset($rows) ? $rows->links() : '' }}

                </div>
            </div>
        </div>
    </div>
@endsection
