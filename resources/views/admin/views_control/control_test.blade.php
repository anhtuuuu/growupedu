@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                <div class="box-body">
                    <input type="hidden" value="' . $row['id'] . '" id="id" name="id" class="form-control" />

                    <form id="f-content" action="<?php echo isset($row) ? URL::to('cap-nhat-bai-kiem-tra') : URL::to('them-bai-kiem-tra'); ?>" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="ma_lhp" class="control-label">Lớp học phần</label>
                                    <select class="form-control" name="ma_lhp" id="ma_lhp">
                                        <?php if(isset($class) && !empty($class) && is_array($class)):
                                            foreach($class as $cls):
                                        ?>
                                        <option value="{{ $cls->ma_lhp }}">{{ $cls->ten_lhp }}</option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div class="form-group required">
                                    <label for="tieu_de" class="control-label">Tiêu đề</label>
                                    <input type="text" class="form-control" name="tieu_de" id="tieu_de" value="">
                                    @error('tieu_de')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Danh sách câu hỏi</label>
                                    <div class="questions" id="questions">
                                        <div class="question-item">
                                            <div class="question">
                                                <label for="label control-label">Tiêu đề câu hỏi</label>
                                                <input type="text" class="form-control" name="label[]" id="label">
                                                @error('label')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="question">
                                                <label for="">Đáp án A</label>
                                                <input type="text" class="form-control" name="answer1[]" id="answer">
                                                @error('answer1')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="question">
                                                <label for="">Đáp án B</label>
                                                <input type="text" class="form-control" name="answer2[]" id="answer">
                                                @error('answer2')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="question">
                                                <label for="">Đáp án C</label>
                                                <input type="text" class="form-control" name="answer3[]" id="answer">
                                                @error('answer3')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="question">
                                                <label for="">Đáp án D</label>
                                                <input type="text" class="form-control" name="answer4[]" id="answer">
                                                @error('answer4')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="question">
                                                <label for="" class="text-danger">ĐÁP ÁN ĐÚNG</label>
                                                <select name="dap_an[]" class="form-control" id="dap_an">
                                                    <option value="1">A</option>
                                                    <option value="2">B</option>
                                                    <option value="3">C</option>
                                                    <option value="4">D</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add-question"><b>+</b> Thêm câu
                                        hỏi</button>
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
