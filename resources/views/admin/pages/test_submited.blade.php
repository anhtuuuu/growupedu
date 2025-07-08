@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý bài kiểm tra đã nộp</b></h3>
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
                                        <th class="text-center">Họ tên</th>
                                        <th class="text-center">Điểm số</th>
                                        <th class="text-center">Ngày nộp</th>
                                        {{-- <th class="text-center">Chức năng</th> --}}
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
                                                {{ $row->ho_ten }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            {{ $row->diem_so }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ngay_nop }}
                                        </td>
                                        {{-- <td class="text-center">
                                            <em class="fa fa-eye fa-lg">&nbsp;</em> <a href="<?php echo URL::to('xem-dap-an/' . $row->id); ?>">Xem đáp án</a>
                                        </td> --}}
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                        </div>
                    </form>
                    <?php else:  ?>
                    <div class="callout callout-warning">
                        <h4>Thông báo!</h4>
                        <p><b>Không</b> có bài kiểm tra nào đã nộp!</p>
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
