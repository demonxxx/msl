@extends('app.shops.shop')
@section('shop')

        <!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font">Thêm khách hàng</h1>
        <ul class="controls">
            <li class="dropdown">
                <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                    <i class="fa fa-spinner fa-spin"></i>
                </a>
                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                    <li>
                        <a role="button" tabindex="0" class="tile-toggle">
                            <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                            <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                        </a>
                    </li>
                    <li>
                        <a role="button" tabindex="0" class="tile-refresh">
                            <i class="fa fa-refresh"></i> Refresh
                        </a>
                    </li>
                    <li>
                        <a role="button" tabindex="0" class="tile-fullscreen">
                            <i class="fa fa-expand"></i> Fullscreen
                        </a>
                    </li>
                </ul>
            </li>
            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
        </ul>
    </div>
    <!-- /tile header -->
    <!-- tile body -->
    <div class="tile-body">

        @if (count($errors) > 0)
            {{--{{dd($errors)}}--}}
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{--<label>{{count($errs)}}</label>--}}
        <form class="form-horizontal" method="POST" action="{{url('shop/store')}}" name="create-shop-form" role="form"
              id="create-shop-form" data-parsley-validate>
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="col-sm-2 control-label">Mã khách hàng</label>
                <div class="col-sm-10">
                    <input type="text" name="code" id="code" onfocusout="check_user_duplicate(this, 'code')" class="form-control"
                           placeholder="Mã khách hàng" readonly="readonly" value="KH{{$shop_code}}" required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Tài khoản đăng nhập</label>
                <div class="col-sm-10">
                    <input type="text" name="username" onfocusout="check_user_duplicate(this, 'username')" id="username" class="form-control"
                           placeholder="Tài khoản đăng nhập" value="{{ old('username') }}" required>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Mật khẩu</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="password"
                           class="form-control" placeholder="Mật khẩu" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Nhập lại mật khẩu</label>
                <div class="col-sm-10">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control" placeholder="Mật khẩu" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Họ và tên khách hàng</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Họ và tên khách hàng"
                           data-parsley-trigger="change" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Số điện thoại.</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_number" onfocusout="check_user_duplicate(this, 'phone_number')"
                           class="form-control" placeholder="(XXX) XXXX XXX" value="{{ old('phone_number') }}"
                           pattern="^[\d\+\-\.\(\)\/\s]*$" required>
                    @if ($errors->has('phone_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Thư điện tử</label>
                <div class="col-sm-10">
                    <input type="email" name="email" onfocusout="check_user_duplicate(this, 'email')" id="email" class="form-control" placeholder="Email"
                           value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Địa chỉ nhà </label>
                <div class="col-sm-2{{ $errors->has('home_number') ? ' has-error' : '' }}">
                    <input type="text" name="home_number" class="form-control" placeholder="Xóm/Số nhà"
                           value="{{ old('home_number') }}" required>
                    @if ($errors->has('home_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('home_number') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-2{{ $errors->has('home_ward') ? ' has-error' : '' }}">
                    <input type="text" name="home_ward" class="form-control" placeholder="Xã/Phường"
                           value="{{ old('home_ward') }}" required>
                    @if ($errors->has('home_ward'))
                        <span class="help-block">
                            <strong>{{ $errors->first('home_ward') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-3{{ $errors->has('home_district') ? ' has-error' : '' }}">
                    <input type="text" name="home_district" class="form-control" placeholder="Quận/huyện"
                           value="{{ old('home_district') }}" required>
                    @if ($errors->has('home_district'))
                        <span class="help-block">
                            <strong>{{ $errors->first('home_district') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-3{{ $errors->has('home_city') ? ' has-error' : '' }}">
                    <input type="text" name="home_city" class="form-control" placeholder="Tỉnh/Thành phố"
                           value="{{ old('home_city') }}" required>
                    @if ($errors->has('home_city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('home_city') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Địa chỉ văn phòng </label>
                <div class="col-sm-2{{ $errors->has('office_number') ? ' has-error' : '' }}">
                    <input type="text" name="office_number" class="form-control" placeholder="Xóm/Số nhà"
                           value="{{ old('office_number') }}" required>
                    @if ($errors->has('office_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('office_number') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-2{{ $errors->has('office_ward') ? ' has-error' : '' }}">
                    <input type="text" name="office_ward" class="form-control" placeholder="Xã/Phường"
                           value="{{ old('office_ward') }}" required>
                    @if ($errors->has('office_ward'))
                        <span class="help-block">
                            <strong>{{ $errors->first('office_ward') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-3{{ $errors->has('office_district') ? ' has-error' : '' }}">
                    <input type="text" name="office_district" class="form-control" placeholder="Quận/huyện"
                           value="{{ old('office_district') }}" required>
                    @if ($errors->has('office_district'))
                        <span class="help-block">
                            <strong>{{ $errors->first('office_district') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-3{{ $errors->has('office_city') ? ' has-error' : '' }}">
                    <input type="text" name="office_city" class="form-control" placeholder="Tỉnh/Thành phố"
                           value="{{ old('office_city') }}"" required>
                    @if ($errors->has('office_city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('office_city') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group{{ $errors->has('identity_card') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Chứng minh nhân dân</label>
                <div class="col-sm-10">
                    <input type="number" name="identity_card" class="form-control" placeholder="Chứng minh nhân dân"
                           value="{{ old('identity_card') }}" required>
                    @if ($errors->has('identity_card'))
                        <span class="help-block">
                            <strong>{{ $errors->first('identity_card') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                <!-- SUBMIT BUTTON -->
                <button type="submit" class="btn btn-default" id="form4Submit">Submit</button>
            </div>
        </form>


    </div>

    <!-- /tile footer -->
</section>
<script type="text/javascript">
    $(document).ready(function () {
        // $('#form4Submit').on('click', function(){
        //     $('#form4').submit();
        // });
    });

    function check_user_duplicate(selector, colum_name) {
//        debugger;
        $.ajax({
            url: "/shop/check_user_duplicate",
            type: 'POST',
            data: {colum_name: colum_name, value: $(selector).val()},
            success: function (result) {
//                debugger;
                if(result == "ok"){
                    $(selector).removeClass('parsley-error');
                    $(selector).addClass('parsley-success');
                    $("#error_" + colum_name).remove();
                }else {
                    if($("#error_" + colum_name).html() == undefined) {
                        $(selector).removeClass('parsley-success');
                        $(selector).addClass('parsley-error');
                        $(selector).after(
                                "<ul class='parsley-errors-list filled' id='error_" + colum_name + "'>" +
                                "<li class='parsley-required'>" + $(selector).val() + " đã tồn tại!" + "</li></ul>"
                        );
                    }
                }
            }
        });
    }
</script>
@endsection


