@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            <div class="box box-solid">
                <div class="box-header">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><em class="fa fa-arrow-left fa-lg">&nbsp;</em></a>

                    <h3 class="box-title">Chi tiết đánh giá</h3>
                </div>
                <div class="box-body">
                    <?php if(isset($data_assess) && isset($data_class) && !empty($data_assess) && !empty($data_class)): ?>
                    <div id="accordion" class="box-group">
                        <div class="panel box box-primary">
                            <div class="box-header">
                                <h4 class="box-title">
                                    Thông tin đánh giá
                                </h4>
                            </div>
                            <div class="box-body">
                                <p>Họ tên: <b>{{$data_assess->ho_ten}}</b></p>
                                <p>Học phần: <b>{{$data_class->ten_hp}}</b></p>
                                <p>Lớp học phần: <b>{{$data_assess->ten_lhp}}</b></p>
                                <p>Giảng viên: <b>{{$data_class->ho_ten}}</b></p>
                                <p>Số sao: <b>{{$data_assess->so_sao}}</b></p>
                                <p>Ngày tạo: <b>{{$data_assess->ngay_tao}}</b></p>
                            </div>
                        </div>
                        <div class="panel box box-success">
                            <div class="box-header">
                                <h4 class="box-title">
                                    Nội dung đánh giá:
                                </h4>
                            </div>
                            <div class="box-body">
                                {{$data_assess->noi_dung}}
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
@endsection
