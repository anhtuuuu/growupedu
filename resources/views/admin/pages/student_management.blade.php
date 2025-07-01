@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý sinh viên</b></h3>
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
                                        <th class="text-center">Lớp học phần</th>
                                        <th class="text-center">Ngày tham gia</th>
                                        <th class="text-center">Tiến độ</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && !empty($rows) && is_array($rows)):
                                        foreach($rows as $index => $row): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="{{ $index + 1 }}">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td>
                                            <a class="img-fancybox d-flex justify-content-center"
                                                href="https://static.vecteezy.com/system/resources/previews/019/896/008/original/male-user-avatar-icon-in-flat-design-style-person-signs-illustration-png.png"
                                                title=""><img width="40" class="img-rounded img-responsive"
                                                    alt=""
                                                    src="{{ URL::to(config('asset.images_path') . $row->avatar) }}"></a>
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ho_ten }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->email }}
                                        </td>
                                        <td class="text-center">
                                            <p class='text-bold text-primary'>
                                                {{ $row->ten_lhp }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            {{ $row->ngay_tham_gia }}
                                        </td>
                                        <td class="text-center">
                                            {{ $row->tien_do }}%
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-bgr">Xuất chứng chỉ</button>
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em><a
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu này?')"
                                                href="<?php echo URL::to('xoa-sinh-vien/' . $row->id); ?>">Xóa</a>

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
