@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                <div class="box-body">
                    <input type="hidden" value="' . $row['id'] . '" id="id" name="id" class="form-control" />

                    <form id="f-content" action="{{ URL::to('them-khoa') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group required">
                                    <label for="title" class="control-label">Tên khoa</label>
                                    <input type="text" class="form-control" name="ten_khoa" id="ten_khoa" value="{{ old('ten_khoa') }}">
                                </div>

                                <div class="form-group required">
                                    <label for="alias" class="control-label">Liên kết tĩnh</label>
                                    <input type="text" class="form-control" name="alias" id="alias" value="{{ old('alias') }}">
                                </div>
                            
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    <textarea class="form-control" name="mo_ta" data-autoresize rows="3">{{ old('mo_ta') }}</textarea>
                                </div>                                                             
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
