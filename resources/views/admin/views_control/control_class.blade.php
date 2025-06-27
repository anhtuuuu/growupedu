@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                
                <form id="f-content" action="<?php echo isset($row) ? URL::to('cap-nhat-lop-hoc-phan') : URL::to('them-lop-hoc-phan'); ?>" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <?php 
                            if(isset($row)):?>
                        <input type="hidden" value="{{$row->ma_lhp}}" id="ma_lhp" name="ma_lhp" class="form-control" />
                        <?php
                        endif;?>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group required">
                                    <label for="ten_lhp" class="control-label">Tên Lớp học phần</label>
                                    <input type="text" class="form-control" name="ten_lhp" id="ten_lhp"
                                        value="{{ isset($row) ? $row->ten_lhp : old('ten_lhp') }}">
                                    @error('ten_lhp')
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
                                    <label for="post_cat_id" class="control-label">Học phần</label>
                                    <select class="form-control" name="ma_hp" id="ma_hp">
                                        <?php
                                        if(isset($table_hocphan) && is_array($table_hocphan) && !empty($table_hocphan)):
                                        foreach($table_hocphan as $row_hp):
                                        ?>
                                        <option value="{{$row_hp->ma_hp }}" <?php echo isset($row) && $row->ma_hp == $row_hp->ma_hp ? 'selected' : '' ?>>
                                            {{ $row_hp->ten_hp }}
                                        </option>
                                        <?php
                                        endforeach; 
                                        endif;
                                        ?>
                                    </select>
                                    @error('ma_hp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                 <div class="form-group">                                    
                                    <label for="post_cat_id" class="control-label">Bài giảng</label>
                                    <select class="form-control" name="ma_bg" id="ma_bg">
                                        <?php
                                        if(isset($table_baigiang) && is_array($table_baigiang) && !empty($table_baigiang)):
                                        foreach($table_baigiang as $row_bg):
                                        ?>
                                        <option value="{{$row_bg->ma_bg }}" <?php echo isset($row) && $row->ma_bg == $row_bg->ma_bg ? 'selected' : '' ?>>
                                            {{ $row_bg->ten_bg }}
                                        </option>
                                        <?php
                                        endforeach; 
                                        endif;
                                        ?>

                                    </select>
                                    @error('ma_bg')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>                    
                                <div class="form-group">
                                    <label class="control-label">Ảnh lớp học phần</label>
                                    <input type="file" class="file" name="hinh_anh">
                                    <input type="hidden" name="hinh_anh_clone" value="{{ isset($row) ? $row->hinh_anh : old('hinh_anh') }}">
                                    <div style="margin-top: 10px;">
                                        <img width="100" src="" alt=""
                                            class="img-thumbnail img-responsive">
                                    </div>

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
