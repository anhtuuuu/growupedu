@extends('site.layout')
@section('content')
    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                            class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Menu</h3>
            </div>
            <!--panel-Body-->
            <?php
            if (isset($submitted_tests) && !empty($submitted_tests) && is_array($submitted_tests)):
            ?>
            <h1 class='m-5'><b>Bảng điểm lớp: {{ $submitted_tests[0]->ten_lhp }}</b></h1>
            <table class="table table-bordered mb-5">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th scope="col">MSSV</th>
                        <th scope="col">Họ và Tên</th>
                        <th scope="col">Điểm</th>

                    </tr>
                </thead>
                <tbody>
                    
                        @foreach ($submitted_tests as $index=>$row)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $row->ma_tk }}</td>
                                <td>{{ $row->ho_ten }}</td>
                                <td>{{ $row->diem_so }}</td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
			<?php else: ?>
			<h1 class="mb-5 py-5">Không tìm thấy dữ liệu</h1>
    			<div class="pb-5"></div>

			<?php endif; ?>
        </div>


        <!-- end panel body -->
    </div>
@endsection
