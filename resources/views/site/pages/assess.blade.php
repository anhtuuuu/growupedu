@extends('site.layout')
@section('content')
			<!-- content -->
			<div class="col-xs-12 col-sm-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
									class="fa fa-angle-double-left" data-toggle="offcanvas"
									title="Maximize Panel"></span></a>Menu</h3>
					</div>
					<!--panel-Body-->
					<div class="panel-body">
						<div class="content-row">
							<h2>Đánh giá :</h2>
							<div class="row">
								<div class="col-md-6">
									<label class="pl-2r mt-4">Lớp học phần: CĐTH22WEBC - LT php cơ bản</label>
									<label class="pl-2r mt-4">Chất lượng lớp học phần:
										<label class="star" onclick="chooseStar(1)" for="oneStar"><i
												class="fa fa-star"></i></label>
										<label class="star" onclick="chooseStar(2)" for="twoStar"><i
												class="fa fa-star"></i></label>
										<label class="star" onclick="chooseStar(3)" for="threeStar"><i
												class="fa fa-star"></i></label>
										<label class="star" onclick="chooseStar(4)" for="fourStar"><i
												class="fa fa-star"></i></label>
										<label class="star" onclick="chooseStar(5)" for="fiveStar"><i
												class="fa fa-star"></i></label>

										<input hidden type="radio" name="star" value="1" id="oneStar">
										<input hidden type="radio" name="star" value="2" id="twoStar">
										<input hidden type="radio" name="star" value="3" id="threeStar">
										<input hidden type="radio" name="star" value="4" id="fourStar">
										<input hidden type="radio" name="star" value="5" id="fiveStar" checked>
									</label>
									<form class="">
										<div class="form-group pl-2r mt-4">
											<label class="mb-3" for="content">Nội dung đánh giá: </label>
											<textarea type="text" class="form-control" id="content"
												placeholder="Nội dung đánh giá">
											</textarea>
										</div>
										<div class="d-flex justify-content-center">
											<button type="submit" class="btn btn-primary">Gửi</button>
										</div>
									</form>
								</div>
								<div class="col-md-6">
									<!--<img src="../images/php.png" width="40"alt="">&nbsp;&nbsp; <b>PHP TUTORIAL</b>-->
								</div>
							</div>
						</div>
					</div>
					<!-- end panel body -->
				</div>
			</div>
			<!-- end content -->
@endsection