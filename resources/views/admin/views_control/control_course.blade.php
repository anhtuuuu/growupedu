@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    {{-- @include(config('asset.view_admin_partial')('notify_message')) --}}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><em class="fa fa-arrow-left fa-lg">&nbsp;</em></a>

                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                <div class="box-body">
                    <form id="f-content" action="<?php echo isset($row) ? URL::to('cap-nhat-hoc-phan') : URL::to('them-hoc-phan'); ?>" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <?php 
                            if(isset($row)):?>
                        <input type="hidden" value="{{$row->ma_hp}}" id="ma_hp" name="ma_hp" class="form-control" />
                        <?php
                        endif;?>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="post_cat_id" class="control-label">Bộ môn</label>
                                    <select class="form-control" name="ma_bm" id="ma_bm">
                                        <?php
                                        if(isset($table_bm) && is_array($table_bm) && !empty($table_bm)):
                                        foreach($table_bm as $row_bm):
                                        ?>
                                        <option value="{{$row_bm->ma_bm }}" <?php echo isset($row) && $row->ma_bm == $row_bm->ma_bm ? 'selected' : '' ?>>
                                            {{ $row_bm->ten_bm }}
                                        </option>
                                        <?php
                                        endforeach; 
                                        endif;
                                        ?>


                                    </select>
                                    @error('ma_bm')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group required">
                                    <label for="ten_hp" class="control-label">Tên học phần</label>
                                    <input type="text" class="form-control input-change" name="ten_hp" id="ten_hp"
                                        value="{{ isset($row) ? $row->ten_hp : old('ten_hp') }}">
                                    @error('ten_hp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group required">
                                    <label for="alias" class="control-label">Liên kết tĩnh</label>
                                    <input type="text" class="form-control slug-change" name="alias" id="alias"
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
