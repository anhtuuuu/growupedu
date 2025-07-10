@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý giảng viên</b></h3>
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
                                        <th class="text-center" style="width: 20px">STT</th>
                                        <th class="text-center" style="width:120px">Ảnh đại diện</th>
                                        <th class="text-center" style="width:auto">Họ tên</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Bộ môn</th>
                                        <th class="text-center">Số lượt đánh giá</th>
                                        <th class="text-center">Trung bính số sao</th>
                                        <th class="text-center">Đánh giá</th>
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
                                                    alt=""
                                                    src="{{ URL::to(config('asset.images_path') . $row->hinh_anh) }}"></a>
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ho_ten }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->email }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ten_bm }}
                                        </td>
                                        <td class="text-center">
                                            {{ $counts[$index] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $stars[$index] }}
                                        </td>
                                        <td class="text-center">
                                            <p class='text-bold text-primary'>
                                                {{ ($stars[$index] == 5 ? 'Tốt' : ($stars[$index] >= 4 ? 'Khá' : 'Cần cải thiện')) }}
                                            </p>
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
