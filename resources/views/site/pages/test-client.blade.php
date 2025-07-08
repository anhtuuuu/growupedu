@extends('site.layout')
@section('content')

    <!-- content -->
    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                            class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Menu</h3>
            </div>
            <!--panel-Body-->
            <div class="panel-body">
                <div class="content-row px-2 px-md-5">
                    <form action="{{ URL::to('nop-bai-kiem-tra') }}" method="post">
                        {{ csrf_field() }}
                        <div class="d-flex justify-content-center m-3">
                            <h1><b>{{ $tieu_de_test }}</b></h1>
                        </div>
                        <input hidden type="hidden" name="ma_bkt" value="{{ $test[0]->ma_bkt ?? '' }}">
                        <?php
					    if (isset($array_question) && !empty($array_question) && is_array($array_question)):
						foreach ($array_question as $index=>$row): ?>
                        <div class="row">
                            <div class="col-12 question p-4">
                                <h5 class="mb-3"><b>{{ $row['label'] }}</b></h5>
                                @error('question.0')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input hidden type="hidden" name="question[{{ $index }}]">
                                <ul>
                                    <li><input type="radio" value="1" name="question[{{ $index }}]">
                                        <p>{{ $row['answer1'] }}</p>
                                    </li>
                                    <li><input type="radio" value="2" name="question[{{ $index }}]">
                                        <p>{{ $row['answer2'] }}</p>
                                    </li>
                                    <li><input type="radio" value="3" name="question[{{ $index }}]">
                                        <p>{{ $row['answer3'] }}</p>
                                    </li>
                                    <li><input type="radio" value="4" name="question[{{ $index }}]">
                                        <p>{{ $row['answer4'] }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php endforeach;?>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn px-4 py-2 btn-bgr"><b>Nộp Bài</b></button>
                        </div>
                        <?php else: ?>
                        <h1>Dữ liệu không tồn tại</h1>
                        <?php endif; ?>
                    </form>
                </div>
            </div>


            <!-- end panel body -->
        </div>
    </div>
    <!-- end content -->
@endsection
