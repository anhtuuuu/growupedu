@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                
                <form id="f-content" action="<?php echo isset($row) ? URL::to('cap-nhat-bo-mon') : URL::to('them-bo-mon'); ?>" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <?php 
                            if(isset($row)):?>
                        <input type="hidden" value="{{$row->ma_bm}}" id="ma_bm" name="ma_bm" class="form-control" />
                        <?php
                        endif;?>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="post_cat_id" class="control-label">Khoa</label>
                                    <select class="form-control" name="ma_khoa" id="ma_khoa">
                                        <?php
                                        if(isset($table_khoa) && is_array($table_khoa) && !empty($table_khoa)):
                                        foreach($table_khoa as $row_khoa):
                                        ?>
                                        <option value="{{$row_khoa->ma_khoa }}" <?php echo isset($row) && $row->ma_khoa == $row_khoa->ma_khoa ? 'selected' : '' ?>>
                                            {{ $row_khoa->ten_khoa }}
                                        </option>
                                        <?php
                                        endforeach; 
                                        endif;
                                        ?>

                                    </select>
                                    @error('ma_khoa')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group required">
                                    <label for="ten_bm" class="control-label">Tên bm</label>
                                    <input type="text" class="form-control" name="ten_bm" id="ten_bm"
                                        value="{{ isset($row) ? $row->ten_bm : old('ten_bm') }}">
                                    @error('ten_bm')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group required">
                                    <label for="alias" class="control-label">Liên kết tĩnh</label>
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        value="{{ isset($row) ? $row->alias : old('alias') }}">
                                    @error('alias')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    <textarea class="form-control" name="mo_ta" data-autoresize rows="3">{{ isset($row) ? $row->mo_ta : old('mo_ta') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-success">{{ isset($row) ? 'Lưu thay đổi' : 'Thêm mới' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
