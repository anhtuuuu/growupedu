@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý bài kiểm tra</b></h3>
                    <a class="btn btn-success pull-right" href="<?php echo URL::to('them-bai-kiem-tra'); ?>"><i class="fa fa-plus"></i>
                        Thêm</a>
                </div>
                <div class="box-body">
                    <?php if(isset($rows) && !empty($rows)):?>
                    <form class="form-inline" name="main" method="post" action="">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">
                                                                        <input class="flat-blue check-all" name="check_all[]"
                                                                            type="checkbox" value="yes">
                                                                    </th> -->
                                        <th class="text-center" style="width: 20px">STT</th>
                                        <th class="text-center" style="width:auto">Tiêu đề</th>
                                        <th class="text-center">Lớp học phần</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach($rows as $index => $row): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="{{ $index + 1 }}">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td class="text-center">
                                            {{ $row->tieu_de }}
                                        </td>

                                        <td class="text-center">
                                            <p class='text-bold text-primary'>
                                                {{ $row->ten_lhp }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ngay_tao }}
                                        </td>

                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a href="<?php echo URL::to('cap-nhat-bai-kiem-tra/'. $row->ma_bkt); ?>">Sửa</a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em><a onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu này?')"
                                                href="<?php echo URL::to('xoa-bai-kiem-tra/' . $row->ma_bkt); ?>">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                        </div>
                    </form>
                    <?php else:  ?>
                    <div class="callout callout-warning">
                        <h4>Thông báo!</h4>
                        <p><b>Không</b> có bài kiểm tra nào!</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="box-footer clearfix">
                    {{ isset($rows) ? $rows->links() : '' }}
                </div>
            </div>
        </div>
    </div>
@endsection
