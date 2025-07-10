@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><em class="fa fa-arrow-left fa-lg">&nbsp;</em></a>

                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                <div class="box-body">
                    <input type="hidden" value="' . $row['id'] . '" id="id" name="id" class="form-control" />

                    <form id="f-content" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group required">
                                    <label for="title" class="control-label">Tiêu đề</label>
                                    <input type="text" class="form-control input-change" name="title" id="title" value="">

                                </div>

                                <div class="form-group required">
                                    <label for="alias" class="control-label">Liên kết tĩnh</label>
                                    <input type="text" class="form-control slug-change" name="alias" id="alias" value="">
                                </div>

                                <div class="form-group">
                                    <label for="post_cat_id" class="control-label">Chủ đề</label>
                                    <select class="form-control" name="post_cat_id" id="post_cat_id">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Hình minh họa cho phần giới thiệu</label>
                                    <input type="file" class="file" name="homeimg[]">

                                    <div style="margin-top: 10px;">
                                        <img width="100" src="" alt=""
                                            class="img-thumbnail img-responsive">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label">Chú thích cho hình minh họa</label>
                                    <input type="text" class="form-control" name="homeimgalt" value=""
                                        maxlength="255">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Giới thiệu ngắn gọn</label>
                                    <textarea class="form-control" name="hometext" data-autoresize rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nội dung chi tiết</label>
                                    <textarea class="form-control" name="hometext" data-autoresize rows="3"></textarea>
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
