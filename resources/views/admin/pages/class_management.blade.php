@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý bài kiểm tra</b></h3>
                    <a class="btn btn-success pull-right" href="<?php echo URL::to('them-lop-hoc-phan'); ?>"><i class="fa fa-plus"></i>
                        Thêm</a>
                </div>
                <div class="box-body">
                        @include(config('asset.view_admin_partial')('notify_message'))
                    <form class="form-inline" name="main" method="post" action="them">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">
                                                                <input class="flat-blue check-all" name="check_all[]"
                                                                    type="checkbox" value="yes">
                                                            </th> -->
                                        <th class="text-center" style="width: 20px">STT</th>
                                        <th class="text-center" style="width: 20px">Ảnh LHP</th>
                                        <th class="text-center" style="width:auto">Tên lớp</th>
                                        <th class="text-center">Tên giảng viên</th>
                                        <th class="text-center">Tên học phần</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && !empty($rows) && is_array($rows)):
                                        foreach($rows as $index => $row): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="{{$index + 1}}">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td class="text-center">
                                            <img width="60px" src="<?php echo
                                            URL::to(config('asset.images_path').$row->hinh_anh) ?> " alt="">
                                                                                        
                                        </td>
                                        <td class="text-center">
                                            {{$row->ten_lhp}}
                                        </td>

                                        <td class="text-center">
                                            {{$row->ho_ten}}
                                        </td>
                                        <td class="text-center">
                                            {{$row->ten_hp}}
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="" class="change-inhome flat-blue"
                                                value="" <?php echo $row->hien_thi ? 'checked' : '' ?>>
                                        </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a href="<?php echo URL::to('cap-nhat-lop-hoc-phan/' . $row->ma_lhp); ?>">Sửa</a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href=""
                                                class="delete_bootbox">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>


                        </div>
                    </form>

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
