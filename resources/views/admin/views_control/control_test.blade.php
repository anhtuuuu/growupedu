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
                        <?php if (isset($row)) {
                            $contents = unserialize($row->noi_dung);
                            $answers = explode(';', $row->dap_an);
                        } ?>
                        <div class="row">
                            <?php if(isset($row)):?>
                            <input type="hidden" value="{{ $row->ma_bkt }}" id="ma_bkt" name="ma_bkt"
                                class="form-control" />
                            <?php endif;?>
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
                                    <input type="text" class="form-control" name="tieu_de" id="tieu_de"
                                        value="{{ isset($row) ? $row->tieu_de : old('tieu_de') }}">
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
                                                <input type="text" class="form-control" name="label[]" id="label"
                                                    value="{{ isset($contents) ? $contents[0]['label'] : old('label.0') }}">
                                            </div>
                                            @error('label.0')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="question">
                                                <label for="">Đáp án A</label>
                                                <input type="text" class="form-control" name="answer1[]" id="answer"
                                                    value="{{ isset($contents) ? $contents[0]['answer1'] : old('answer1.0') }}">
                                            </div>
                                            @error('answer1.0')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="">Đáp án B</label>
                                                <input type="text" class="form-control" name="answer2[]" id="answer"
                                                    value="{{ isset($contents) ? $contents[0]['answer2'] : old('answer2.0') }}">
                                            </div>
                                            @error('answer2.0')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="">Đáp án C</label>
                                                <input type="text" class="form-control" name="answer3[]" id="answer"
                                                    value="{{ isset($contents) ? $contents[0]['answer3'] : old('answer3.0') }}">
                                            </div>
                                            @error('answer3.0')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="">Đáp án D</label>
                                                <input type="text" class="form-control" name="answer4[]" id="answer"
                                                    value="{{ isset($contents) ? $contents[0]['answer4'] : old('answer4.0') }}">
                                            </div>
                                            @error('answer4.0')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="" class="text-danger">ĐÁP ÁN ĐÚNG</label>
                                                <select name="dap_an[]" class="form-control" id="dap_an">
                                                    <option value="1" <?php echo isset($answers) ? ($answers[0] == 1 ? 'selected' : '') : (old('dap_an.0') == 1 ? 'selected' : ''); ?>>A</option>
                                                    <option value="2" <?php echo isset($answers) ? ($answers[0] == 2 ? 'selected' : '') : (old('dap_an.0') == 2 ? 'selected' : ''); ?>>B</option>
                                                    <option value="3" <?php echo isset($answers) ? ($answers[0] == 3 ? 'selected' : '') : (old('dap_an.0') == 3 ? 'selected' : ''); ?>>C</option>
                                                    <option value="4" <?php echo isset($answers) ? ($answers[0] == 4 ? 'selected' : '') : (old('dap_an.0') == 4 ? 'selected' : ''); ?>>D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php foreach (isset($contents) ? $contents : old('label', []) as $index => $value): 
                                            if($index == 0) continue;
                                        ?>
                                        <div class="question-item">
                                            <div class="question">
                                                <label for="label control-label">Tiêu đề câu hỏi</label>
                                                <input type="text" class="form-control" name="label[]" id="label"
                                                    value="{{ isset($contents) ? $contents[$index]['label'] : old("label.$index") }}">
                                            </div>
                                            @error("label.$index")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="">Đáp án A</label>
                                                <input type="text" class="form-control" name="answer1[]"
                                                    id="answer"
                                                    value="{{ isset($contents) ? $contents[$index]['answer1'] : old("answer1.$index") }}">
                                            </div>
                                            @error("answer1.$index")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="">Đáp án B</label>
                                                <input type="text" class="form-control" name="answer2[]"
                                                    id="answer"
                                                    value="{{ isset($contents) ? $contents[$index]['answer2'] : old("answer2.$index") }}">
                                            </div>
                                            @error("answer2.$index")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="">Đáp án C</label>
                                                <input type="text" class="form-control" name="answer3[]"
                                                    id="answer"
                                                    value="{{ isset($contents) ? $contents[$index]['answer3'] : old("answer3.$index") }}">
                                            </div>
                                            @error("answer3.$index")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="">Đáp án D</label>
                                                <input type="text" class="form-control" name="answer4[]"
                                                    id="answer"
                                                    value="{{ isset($contents) ? $contents[$index]['answer4'] : old("answer4.$index") }}">
                                            </div>
                                            @error("answer4.$index")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="question">
                                                <label for="" class="text-danger">ĐÁP ÁN ĐÚNG</label>
                                                <select name="dap_an[]" class="form-control" id="dap_an">
                                                    <option value="1" <?php echo isset($answers) ? ($answers[$index] == 1 ? 'selected' : '') : (old("dap_an.$index") == 1 ? 'selected' : ''); ?>>A</option>
                                                    <option value="2" <?php echo isset($answers) ? ($answers[$index] == 2 ? 'selected' : '') : (old("dap_an.$index") == 2 ? 'selected' : ''); ?>>B</option>
                                                    <option value="3" <?php echo isset($answers) ? ($answers[$index] == 3 ? 'selected' : '') : (old("dap_an.$index") == 3 ? 'selected' : ''); ?>>C</option>
                                                    <option value="4" <?php echo isset($answers) ? ($answers[$index] == 4 ? 'selected' : '') : (old("dap_an.$index") == 4 ? 'selected' : ''); ?>>D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php endforeach;?>

                                    </div>
                                    <button type="button" class="btn btn-primary" id="add-question"><b>+</b> Thêm câu
                                        hỏi</button>
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
