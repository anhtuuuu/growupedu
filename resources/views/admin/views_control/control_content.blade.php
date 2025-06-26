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

                    <form id="f-content" action="{{ URL::to('them-bai') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group required">
                                    <label for="post_cat_id" class="control-label">Bài giảng</label>
                                    <select class="form-control" name="alias_bg" id="lessons">
                                        <option value="" disabled selected>-- Chọn bài giảng --</option>
                                        <?php
                                        if(isset($lessons) && is_array($lessons) && !empty($lessons)):
                                        foreach($lessons as $row):
                                        ?>
                                        <option value="{{ $row->alias }}">{{ $row->ten_bg }}</option>
                                        <?php
                                        endforeach;
                                        endif;
                                        ?>
                                    </select>
                                    @error('alias_bg')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="post_cat_id" class="control-label">Chương</label>
                                    <select class="form-control" name="ma_chuong" id="chapter">

                                    </select>
                                    @error('ma_chuong')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group required">
                                    <label for="title" class="control-label">Tiêu đề</label>
                                    <input type="text" class="form-control" name="tieu_de" id="tieu_de"
                                        value="{{ old('tieu_de') }}">
                                    @error('tieu_de')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group required">
                                    <label for="alias" class="control-label">Liên kết tĩnh</label>
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        value="{{ old('alias') }}">
                                    @error('alias')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    <textarea class="form-control" name="mo_ta" data-autoresize rows="3">{{ old('mo_ta') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nội dung</label>
                                    <textarea class="form-control" id="editor" name="noi_dung" data-autoresize rows="3">{{ old('noi_dung') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="video" class="control-label">Liên kết video</label>
                                    <input type="text" class="form-control" name="video" id="video"
                                        value="{{ old('video') }}">
                                </div>
                                <div class="form-group">
                                    <label for="lien_ket" class="control-label">Liên kết file bài giảng</label>
                                    <input type="text" class="form-control" name="lien_ket" id="lien_ket"
                                        value="{{ old('lien_ket') }}">
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
