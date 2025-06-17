@extends('site.layout')
@section('content')
	<div class="container-fluid mt-4">
		<div class="row row-offcanvas ">
			<!-- content -->
			<div class="col-xs-12 col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">

					</div>
					<!--panel-Body-->
					<div class="panel-body">
						<div class="content-row">
							<div class="row">
								<div class="col-md-6">
									<form class="">
										<h2>Thông tin cá nhân:</h2>
										<ul class="m-0">
											<li class="list-group-item"><b>Họ tên: </b> Nguyễn Thị Tuyết Nhật</li>
											<li class="list-group-item"><b>MSSV: </b>0306221453</li>
											<li class="list-group-item"><b>Giới tính: </b>Nữ</li>
											<li class="list-group-item"><b>Email: </b>0306221453@caothang.edu.vn</li>
											<li class="list-group-item"><b>Ngày sinh: </b>11/10/2003</li>
										</ul>
										<div class="form-group pl-2r mt-4">
											<label for="phone">Số điện thoại: </label>
											<input type="text" class="form-control" id="phone" value="091234565"
												placeholder="Số điện thoại">
										</div>
										<h2>Đổi mật khẩu:</h2>
										<div class="form-group pl-2r mt-4">
											<label for="passwork">Mật khẩu cũ: </label>
											<input type="text" class="form-control" id="passwork"
												placeholder="Mật khẩu cũ">
										</div>
										<div class="form-group pl-2r mt-4">
											<label for="newPasswork">Mật khẩu mới: </label>
											<input type="text" class="form-control" id="newPasswork"
												placeholder="Mật khẩu mới">
										</div>
										<div class="form-group pl-2r mt-4">
											<label for="confirmPasswork">Nhập lại mật khẩu: </label>
											<input type="text" class="form-control" id="confirmPasswork"
												placeholder="Nhập lại mật khẩu">
										</div>
										<div class="d-flex justify-content-center">
											<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
										</div>
									</form>
								</div>
								<div class="col-md-6 mt-5 mt-md-0 pl-2 border border-top-0 border-right-0 border-bottom-0">
									<h2>Lớp học phần:</h2>
									<table class="table">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Lớp học phần</th>
												<th scope="col">Tiến độ</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th scope="row">1</th>
												<td><a href="">CĐTH22WEBC - LT php cơ bản</a></td>
												<td>50%</td>
											</tr>
											<tr>
												<th scope="row">2</th>
												<td><a href="">CĐTH22WEBC - LT php cơ bản</a></td>
												<td>50%</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- end panel body -->
				</div>
			</div>
			<!-- end content -->
		</div>
		<!-- Google Ad Multiflex1 <div class="container">
        <div class="row">
		<div class="col-sm-12
<!-- Google Ad Multiflex1 Start
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8096140274719176"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="autorelaxed"
     data-ad-client="ca-pub-8096140274719176"
     data-ad-slot="3158072222"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
</div></div>
END-->
		<footer class="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<h6>About</h6>
						<p class="text-justify">Study Glance provides Tutorials , Power point Presentations(ppts),
							Lecture Notes, Important & previously asked questions, Objective Type questions, Laboratory
							programs and we provide Syllabus of various subjects.</p>
					</div>
					<div class="col-xs-6 col-md-3" style="padding-left:100px;">
						<h6>Categories</h6>
						<ul class="footer-links">
							<li><a href="../Tutorialindex.html">Tutorials</a></li>
							<li><a href="../ppts/index.html">PPTs</a></li>
							<li><a href="../lecturenotes/index.html">Lecture Notes</a></li>
						</ul>
					</div>
					<div class="col-xs-6 col-md-3" style="padding-left:100px;">
						<h6></h6><br>
						<ul class="footer-links">

							<li><a href="../questions/index.html">Questions</a></li>
							<li><a href="../labprograms/index.html">Lab Programs</a></li>
							<li><a href="../syllabus/index.html">Syllabus</a></li>
						</ul>
					</div>


				</div>
				<hr>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-6 col-xs-12">
						<p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by
							<a href="#">StudyGlance</a>.
						</p>
						<p><!-- hitwebcounter Code START -->

							<img src="https://hitwebcounter.com/counter/counter.php?page=7760160&amp;style=0007&amp;nbdigits=5&amp;type=ip&amp;initCount=0"
								Alt="" border="0" />
						</p>
					</div>

					<div class="col-md-4 col-sm-6 col-xs-12">
						<ul class="social-icons">
							<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</div>
@endsection