@extends(config('asset.view_admin')('admin_layout'))
@section('content')
    @include(config('asset.view_admin_partial')('notify_message'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><em class="fa fa-arrow-left fa-lg">&nbsp;</em></a>

                    <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Thông tin </h3>
                </div>
                <div class="box-body">
                    <form id="f-content" action="{{URL::to('cap-nhat-cau-hinh')}}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group required">
                                    <label for="ten_site" class="control-label">Tên site</label>
                                    <input type="text" class="form-control" name="ten_site" id="ten_site"
                                        value="{{ isset($row) ? $row->ten_site : old('ten_site') }}">
                                    @error('ten_site')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="dia_chi" class="control-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="dia_chi" id="dia_chi"
                                        value="{{ isset($row) ? $row->dia_chi : old('dia_chi') }}">
                                    @error('dia_chi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="sdt" class="control-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="sdt" id="sdt"
                                        value="{{ isset($row) ? $row->sdt : old('sdt') }}">
                                    @error('sdt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ isset($row) ? $row->email : old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label for="website" class="control-label">Website</label>
                                    <input type="text" class="form-control" name="website" id="website"
                                        value="{{ isset($row) ? $row->website : old('website') }}">
                                    @error('website')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Logo</label>
                                    <input type="file" class="file" name="logo">
                                    <input type="hidden" name="logo_clone" value="{{ isset($row) ? $row->logo : old('logo') }}">
                                    <div style="margin-top: 10px;">
                                        <img width="100" src="" alt=""
                                            class="img-thumbnail img-responsive">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Favicon <small class="text-danger">(ưu tiên ảnh 32x32)</small></label>
                                    <input type="file" class="file" name="favicon">
                                    <input type="hidden" name="favicon_clone" value="{{ isset($row) ? $row->favicon : old('favicon') }}">
                                    <div style="margin-top: 10px;">
                                        <img width="100" src="" alt=""
                                            class="img-thumbnail img-responsive">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lien_ket" class="control-label">Liên kết</label>
                                    <input type="text" class="form-control" name="lien_ket" id="lien_ket"
                                        value="{{ isset($row) ? $row->lien_ket : old('lien_ket') }}">
                                    @error('lien_ket')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="facebook" class="control-label">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" id="facebook"
                                        value="{{ isset($row) ? $row->facebook : old('facebook') }}">
                                    @error('facebook')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-success">Lưu thay đổi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
