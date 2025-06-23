@extends('site.layout')
@section('content')
<div class="col-xs-12 col-sm-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
									class="fa fa-angle-double-left" data-toggle="offcanvas"
									title="Maximize Panel"></span></a>Menu</h3>
					</div>
					<!--panel-Body-->
					<div class="panel-body">
						<div class="content-row px-5">
					<?php
                    if(isset($contents) && !empty($contents)):
                    foreach ($contents as $row):?>
							<div class="ppcolumn pt-4">
								<a href="{{$row->lien_ket}}"
									class="appt">Xem chi tiết</a>
								<img src="{{URL::to(config('asset.images_path').'p-img.png')}}" style="padding-bottom:5px;" />
								<h3 style="word-wrap: break-word;">{{$row->tieu_de}}</h3>
							</div>
							{{-- <div class="ppcolumn pt-4">
								<a href="displayf7fc.html?url=data/Python_Basics.pdf&amp;title=Python%20Basics%20:%20Comments,%20Variable,%20DataTypes,%20Operators&amp;subject=PYTHON&amp;durl=data/Python_Basics.pptx"
									class="appt">Xem chi tiết</a>
								<img src="{{URL::to(config('asset.images_path').'p-img.png')}}" style="padding-bottom:5px;" />
								<h3 style="word-wrap: break-word;">Bài Giảng 2</h3>
							</div> --}}
						<?php endforeach; endif; ?>
						</div>

					</div>
				</div>


				<!-- end panel body -->
			</div>
@endsection