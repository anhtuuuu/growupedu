@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    {{-- @include(config('asset.view_admin_partial')('search_nav')) --}}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><em class="fa fa-arrow-left fa-lg">&nbsp;</em></a>

                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý bài</b></h3>
                    <a class="btn btn-success pull-right" href="<?php echo URL::to('them-bai'); ?>"><i class="fa fa-plus"></i>
                        Thêm</a>
                </div>
                <div class="box-body">
                    @include(config('asset.view_admin_partial')('notify_message'))
                    <form class="form-inline" name="main" method="post" action="">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">STT</th>
                                        <th class="text-center" style="width:auto">Tiêu đề</th>
                                        <th class="text-center">Bài giảng</th>
                                        <th class="text-center">Chương</th>
                                        <th class="text-center">Trạng thái hiển thị</th>
                                        <th class="text-center" style="width: 160px;">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && !empty($rows)):
                                        foreach($rows as $index => $row): ?>
                                    <tr>
                                        <!-- <td class="text-center">
                                                                    <input type="checkbox" class="flat-blue check"
                                                                        value="" name="idcheck[]">
                                                                </td> -->
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
                                            {{ $row->ten_bg }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ten_chuong }}
                                        </td>
                                        <td class="text-center" style="width: 150px">
                                            <input type="checkbox" name="inhome[]" class="change-inhome-content flat-blue"
                                                value="{{$row->ma_bai}}" <?php echo $row->hien_thi ? 'checked' : ''; ?>>
                                        </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a
                                                href="<?php echo URL::to('cap-nhat-bai/' . $row->ma_bai); ?>"><b>Sửa</b></a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em><a
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu này?')"
                                                href="<?php echo URL::to('xoa-bai/' . $row->ma_bai); ?>">Xóa</a>

                                        </td>
                                    </tr>
                                    <?php endforeach; endif; ?>
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
