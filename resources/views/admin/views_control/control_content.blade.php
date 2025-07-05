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

                    <form id="f-content" action="<?php echo isset($row) ? URL::to('cap-nhat-bai') : URL::to('them-bai'); ?>" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <?php if(isset($row)): ?>
                        <input type="hidden" value="{{ $row->ma_bai }}" id="ma_bai" name="ma_bai"
                            class="form-control" />
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group required">
                                    <label for="post_cat_id" class="control-label">Bài giảng</label>
                                    <select class="form-control" name="alias_bg" id="lessons">
                                        <option value="" disabled selected>-- Chọn bài giảng --</option>
                                        <?php
                                        if(isset($lessons) && is_array($lessons) && !empty($lessons)):
                                        foreach($lessons as $lesson):
                                        ?>
                                        <option <?php echo isset($lesson_id) && $lesson_id == $lesson->ma_bg ? 'selected' : ''; ?> value="{{ $lesson->alias }}">{{ $lesson->ten_bg }}
                                        </option>
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
                                        <?php
                                            if(isset($chapters) && !empty($chapters) && is_array($chapters)):
                                            foreach($chapters as $chapter):
                                            ?>
                                        <option <?php echo isset($chapter_id) && $chapter_id == $chapter->ma_chuong ? 'selected' : '';
                                        ?> value="{{ $chapter->ma_chuong }}">
                                            {{ $chapter->ten_chuong }}</option>
                                        <?php
                                            endforeach;
                                    endif;
                                            ?>
                                    </select>
                                    @error('ma_chuong')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group required">
                                    <label for="title" class="control-label">Tiêu đề</label>
                                    <input type="text" class="form-control" name="tieu_de" id="tieu_de"
                                        value="{{ isset($row) ? $row->tieu_de : old('tieu_de') }}">
                                    @error('tieu_de')
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
                                <div class="form-group">
                                    <label class="control-label">Nội dung</label>
                                    <div class="import_file import_file_w">
                                        <label for="upload-docx"><img src="<?php echo URL::to(config('asset.images_path') . 'd-img.png'); ?>" alt="">File docx</label>
                                        <input type="file" id="upload-docx" accept=".docx" />
                                    </div>

                                    <textarea class="form-control" id="editor" name="noi_dung">{{ isset($row) ? $row->noi_dung : old('noi_dung') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="video" class="control-label">Liên kết video</label>
                                    <input type="text" class="form-control" name="video" id="video"
                                        value="{{ isset($row) ? $row->video : old('video') }}">
                                    <div class="note">
                                        (Hướng dẫn lấy link:)
                                        <ul>
                                            <li>Bước 1: Vào video youtube muốn liên kết</li>
                                            <li>Bước 2: Nhấn chia sẻ và nhấn copy link</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lien_ket" class="control-label">Liên kết file bài giảng</label>
                                    <input type="text" class="form-control" name="lien_ket" id="lien_ket"
                                        value="{{ isset($row) ? $row->lien_ket : old('lien_ket') }}">
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
