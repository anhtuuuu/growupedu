@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý chương</b></h3>
                    <a class="btn btn-success pull-right" href="<?php echo URL::to('them-chuong'); ?>"><i class="fa fa-plus"></i> Thêm</a>
                </div>
                <div class="box-body">
                    @include(config('asset.view_admin_partial')('notify_message'))
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
                                        <th class="text-center">Bài giảng</th>
                                        <th class="text-center">Mô tả</th>
                                        <th class="text-center" style="width: 160px;">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && !empty($rows) && is_array($rows)):
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
                                            {{ $row->ten_chuong }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ten_bg }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->mo_ta }}
                                        </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a
                                                href="<?php echo URL::to('cap-nhat-chuong/' . $row->ma_chuong); ?>"><b>Sửa</b></a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em><a onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu này?')"
                                                href="<?php echo URL::to('xoa-chuong/' . $row->ma_chuong); ?>">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>


                        </div>
                    </form>
                    <!-- <div class="callout callout-warning">
                                            <h4>Thông báo!</h4>
                                            <p><b>Không</b> có bài viết nào!</p>
                                        </div> -->
                </div>
                <div class="box-footer clearfix">
                    <section id="blog-pagination" class="blog-pagination section">
                        <div class="container">
                            <div class="">
                                <ul class="pagination">
                                    <li><a href="" class="active">1</a></li>
                                    <li class="page"><a href="https://localhost/sportszone-local/danh-muc-bai-viet/blog/4"
                                            data-ci-pagination-page="4" rel="start">2</a></li>
                                    <li class="page"><a href="https://localhost/sportszone-local/danh-muc-bai-viet/blog/8"
                                            data-ci-pagination-page="8">3</a></li>
                                    <li class="next page"><a
                                            href="https://localhost/sportszone-local/danh-muc-bai-viet/blog/4"
                                            data-ci-pagination-page="4" rel="next">»</a></li>
                                    <li class="next page"><a
                                            href="https://localhost/sportszone-local/danh-muc-bai-viet/blog/20"
                                            data-ci-pagination-page="20">→</a></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
