@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('search_nav'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em><b>Quản lý bài kiểm tra</b></h3>
                    <a class="btn btn-success pull-right" href=""><i class="fa fa-plus"></i>
                        Thêm</a>
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
                                        <th class="text-center" style="width:auto">Tên lớp</th>
                                        <th class="text-center">Tên giảng viên</th>
                                        <th class="text-center">Tên học phần</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="1">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td class="text-center">
                                            CĐ TH22 A
                                        </td>

                                        <td class="text-center">
                                            Nguyễn Ngọc Khánh Quỳnh
                                        </td>
                                        <td class="text-center">
                                            Toán rời rạc
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="inhome[]" class="change-inhome flat-blue"
                                                value="" > </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a href="">Sửa</a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href=""
                                                class="delete_bootbox">Xóa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="1">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td class="text-center">
                                            CĐ TH22 B
                                        </td>

                                        <td class="text-center">
                                            Huỳnh Quốc Thái
                                        </td>
                                        <td class="text-center">
                                            Toán rời rạc
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="inhome[]" class="change-inhome flat-blue"
                                                value="" > </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a href="">Sửa</a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href=""
                                                class="delete_bootbox">Xóa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="1">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td class="text-center">
                                            CĐ TH22 C
                                        </td>

                                        <td class="text-center">
                                            Nguyễn Phúc Tiếng
                                        </td>
                                        <td class="text-center">
                                            Toán rời rạc
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="inhome[]" class="change-inhome flat-blue"
                                                value="" > </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a href="">Sửa</a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href=""
                                                class="delete_bootbox">Xóa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="1">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td class="text-center">
                                            CĐ TH22 D
                                        </td>

                                        <td class="text-center">
                                            Huỳnh Anh Tú
                                        </td>
                                        <td class="text-center">
                                            Toán rời rạc
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="inhome[]" class="change-inhome flat-blue"
                                                value="" > </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a
                                                href="">Sửa</a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href=""
                                                class="delete_bootbox">Xóa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input style="width: 50px;" class="text-right form-control" name="order[]"
                                                type="text" value="1">
                                            <input class="text-right form-control" name="ids[]" type="hidden"
                                                value="">
                                        </td>
                                        <td class="text-center">
                                            CĐ TH22 E
                                        </td>

                                        <td class="text-center">
                                            Nguyễn Ngọc Khánh Quỳnh
                                        </td>
                                        <td class="text-center">
                                            Toán rời rạc
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="inhome[]" class="change-inhome flat-blue"
                                                value="" > </td>
                                        <td class="text-center">
                                            <em class="fa fa-edit fa-lg">&nbsp;</em> <a
                                                href="">Sửa</a>
                                            &nbsp;-&nbsp;
                                            <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href=""
                                                class="delete_bootbox">Xóa</a>
                                        </td>
                                    </tr>
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
                                    <li class="page"><a
                                            href="https://localhost/sportszone-local/danh-muc-bai-viet/blog/4"
                                            data-ci-pagination-page="4" rel="start">2</a></li>
                                    <li class="page"><a
                                            href="https://localhost/sportszone-local/danh-muc-bai-viet/blog/8"
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
