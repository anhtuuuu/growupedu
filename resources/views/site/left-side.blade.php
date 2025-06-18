<?php if(isset($left_side_none)): ?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas p-0 w-20" role="navigation">
    <?php if($type_side_none == 'home'): ?>
    <ul class="list-group panel" id="non-printable">
        <li class="list-group-item"><img src="images/tutorials_icons.png" width="20" alt="">&nbsp;<b>Lớp học
                phần</b></li>
        <?php foreach($left_side_none as $value): ?>
        <li class="list-group-item"><a href="{{ $value->alias }}"><i class="glyphicon glyphicon-list-alt"></i>
                {{ $value->ten_lhp }}</a></li>
        <?php endforeach; ?>
    </ul>

    <?php elseif($type_side_none == 'lesson'): ?>
    <ul class="list-group panel">
        <li class="list-group-item"><img src="images/tutorials_icons.png" width="20" alt="">&nbsp;<b>Danh
                sách bài giảng</b></li>
        <!--<li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>-->
        <?php foreach($left_side_none as $value): ?>
        <li class="list-group-item"><a href="bai-giang/{{ $value->alias_bg }}"><i
                    class="glyphicon glyphicon-list-alt"></i>
                {{ $value->ten_bg }}</a></li>
        <?php endforeach; ?>

        <li class="list-group-item"><a href="ppts/index.html"><img src="images/ppt_icons.png" width="20"
                    alt="">&nbsp;<b>Bài kiểm tra</b></a></li>
        <li class="list-group-item"><a href="lecturenotes/index.html"><img src="images/note_icons.png" width="20"
                    alt="">&nbsp;<b>Bảng điểm</b></a></li>
        <li class="list-group-item"><a href="ppts/index.html"><img src="images/ppt_icons.png" width="20"
                    alt="">&nbsp;<b>Đánh giá</b></a></li>
    </ul>

    <?php elseif($type_side_none == 'chapter'): ?>
    <ul class="list-group panel" id="non-printable">
        <?php foreach($left_side_none['courses'] as $course): ?>
        <li class="list-group-item" style="text-transform: uppercase;text-align: left;"><img src="images/clogo.png"
                width="30" alt="">&nbsp;&nbsp; <b>{{ $course->ten_chuong }}</b></li>

        <?php foreach($left_side_none['contents'] as $content):
                if($content->chuong == $course->chuong): ?>
        <li class="list-group-item "><a href="<?php echo URL::to('bai-giang/'.$course->alias_lesson.'/'.$course->alias.'/'.$content->alias) ?>"><i class="fa  fa-chevron-circle-right"></i>{{$content->tieu_de}}</a></li>
        <?php endif; endforeach; ?>
        <?php endforeach; ?>

        <li class="list-group-item"><a href="questions/index.html"><img src="../images/faq_icons.png" width="20"
                    alt="">&nbsp;<b>Các file bài giảng</b></a></li>
        <li class="list-group-item"><a href="questions/index.html"><img src="../images/faq_icons.png" width="20"
                    alt="">&nbsp;<b>Đặt câu hỏi</b></a></li>
    </ul>
    <?php else: ?>
    <h1>none</h1>
    <?php endif;  ?>
</div>
<?php endif; ?>
