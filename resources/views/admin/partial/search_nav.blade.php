<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form name="filter" method="get" action="{{ isset($filter_link) ? URL::to($filter_link) : '' }}">
            <nav class="search_bar navbar navbar-default" role="search">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#filter-bar-7adecd427b033de80d2a0e30cf74e735">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="filter-bar-7adecd427b033de80d2a0e30cf74e735">
                    <div class="navbar-form">
                        <div class="form-group search_title">
                            Loại chủ đề
                        </div>
                        <div class="form-group search_input">
                            <select class="form-control input-sm" name="cat_id">
                                {{-- <option value="0">Tất cả chủ đề</option> --}}
                                <?php if(isset($filter) && !empty($filter)):
                                    // for($i = 0; $i <= count($filter); $i++):
                                    foreach($filter as $index => $fil):?>
                                {{-- <option value="{{ $filter['value'][$i] }}" {{isset($value_filter) && $value_filter == $filter['value'][$i] ? 'selected' : ''}}>{{ $filter['title'][$i] }}</option> --}}
                                <option value="{{ $fil['value'] }}" {{isset($value_filter) && $value_filter == $fil['value'] ? 'selected' : ''}}>{{ $fil['title'] }}</option>
                                
                                <?php endforeach; endif; ?>
                            </select>
                        </div>

                        <div class="form-group search_title">
                            Từ khóa tìm kiếm
                        </div>
                        <div class="form-group search_input">
                            <input class="form-control input-sm" type="text" value="{{isset($key_word) ? $key_word : ''}}" maxlength="64"
                                name="key_word" placeholder="Từ khóa tìm kiếm">
                        </div>

                        <div class="form-group search_action pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
                        </div>
                        <br>

                    </div>
                </div>
            </nav>
        </form>
    </div>
</div>
