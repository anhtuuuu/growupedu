@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{ URL::to('danh-sach-danh-gia') }}" class="btn btn-primary"><em class="fa fa-rotate-right fa-lg">&nbsp;</em></a>

                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý đánh giá</b></h3>
                    {{-- <a class="btn btn-success pull-right" href=""><i class="fa fa-plus"></i> Thêm</a> --}}
                </div>
                <div class="box-body">
                    <?php if(isset($rows) && !empty($rows)):?>
                    <form class="form-inline" name="main" method="post" action=" ">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">
                                                                        <input class="flat-blue check-all" name="check_all[]"
                                                                            type="checkbox" value="yes">
                                                                    </th> -->
                                        <th class="text-center" style="width: 20px">STT</th>
                                        <th class="text-center" style="width:auto">Họ tên</th>
                                        <th class="text-center">Lớp học phần</th>
                                        <th class="text-center">Số sao</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach($rows as $index => $row): ?>
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
                                            {{ $row->ho_ten }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ten_lhp }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->so_sao }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ngay_tao }}
                                        </td>
                                        <td class="text-center">
                                            <em class="fa fa-eye fa-lg">&nbsp;</em> <a href="<?php echo URL::to('/chi-tiet-danh-gia/'.$row->id) ?>"><b>Xem</b></a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em><a onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu này?')"
                                                href="<?php echo URL::to('xoa-danh-gia/' . $row->id); ?>">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <?php else:  ?>
                    <div class="callout callout-warning">
                        <h4>Thông báo!</h4>
                        <p><b>Không</b> có đánh giá nào!</p>
                    </div>
                    <?php endif;  ?>

                </div>
                <div class="box-footer clearfix">
                    {{ isset($rows) ? $rows->links() : '' }}
                </div>
            </div>
        </div>
    </div>
@endsection
