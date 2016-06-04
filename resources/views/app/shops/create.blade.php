@extends('app.shops.shop')
@section('shop')
    <script src="{{ asset("theme/js/plugins/parsley/parsley.min.js") }}"></script>
    <!-- tile -->
    <section class="tile">
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Thêm khách hàng
                            </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" action="{{url('shop/store')}}"
                                  name="create-shop-form" role="form"
                                  id="create-shop-form" data-parsley-validate>
                                {!! csrf_field() !!}
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Tài khoản đăng nhập (*)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username"
                                               onfocusout="check_user_duplicate(this, 'username')" id="username"
                                               class="form-control"
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
                                    <label class="col-sm-2 control-label">Mật khẩu (*)</label>
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
                                    <label class="col-sm-2 control-label">Nhập lại mật khẩu (*)</label>
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
                                    <label class="col-sm-2 control-label">Họ và tên khách hàng (*)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Họ và tên khách hàng"
                                               data-parsley-trigger="change" value="{{ old('name') }}" required>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('shop_name') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Tên cửa hàng</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="shop_name" id="shop_name" class="form-control"
                                               placeholder="Tên cửa hàng"
                                               data-parsley-trigger="change" value="{{ old('shop_name') }}">
                                        @if ($errors->has('shop_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('shop_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Số điện thoại (*)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone_number"
                                               onfocusout="check_user_duplicate(this, 'phone_number')"
                                               class="form-control" placeholder="(XXX) XXXX XXX"
                                               value="{{ old('phone_number') }}"
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
                                    <label class="col-sm-2 control-label">Thư điện tử (*)</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email"
                                               onfocusout="check_user_duplicate(this, 'email')" id="email"
                                               class="form-control" placeholder="Email"
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
                                    <label class="col-md-2 control-label">Địa chỉ cửa hàng (*)</label>
                                    <div class="col-md-2{{ $errors->has('office_city_id') ? ' has-error' : '' }}">
                                        <select name="office_city_id" id="office_city_id" class="form-control" value="{{ old('office_city_id') }}" onchange="selectCityOffice(this)" required>
                                            <option value="" class="first-select">Chọn thành phố</option>
                                            @foreach($cities AS $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('office_city_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_city_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2{{ $errors->has('office_district_id') ? ' has-error' : '' }}">
                                        <select name="office_district_id" id="office_district_id" class="form-control" value="{{ old('office_district_id') }}" onchange="selectDistrictOffice(this)" required>
                                            <option value="" class="first-select">Chọn Quận/Huyện</option>
                                        </select>
                                        @if ($errors->has('office_district_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_district_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2{{ $errors->has('office_ward_id') ? ' has-error' : '' }}">
                                        <select name="office_ward_id" id="office_ward_id" class="form-control" value="{{ old('office_ward_id') }}" required>
                                            <option value="" class="first-select">Chọn Xã/Phường</option>
                                        </select>
                                        @if ($errors->has('office_ward_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_ward_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-4{{ $errors->has('office_number') ? ' has-error' : '' }}">
                                        <input type="text" name="office_number" class="form-control"
                                               placeholder="Xóm/Số nhà" value="{{ old('office_number') }}" required>
                                        @if ($errors->has('office_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Địa chỉ nhà</label>
                                    <div class="col-md-2{{ $errors->has('home_city_id') ? ' has-error' : '' }}">
                                        <select name="home_city_id" id="home_city_id" class="form-control" value="{{ old('home_city_id') }}" onchange="selectCity(this)">
                                            <option value="" class="first-select">Chọn thành phố</option>
                                            @foreach($cities AS $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('home_city_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_city_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2{{ $errors->has('home_district_id') ? ' has-error' : '' }}">
                                        <select name="home_district_id" id="home_district_id" class="form-control" value="{{ old('home_district_id') }}" onchange="selectDistrict(this)">
                                            <option value="" class="first-select">Chọn Quận/Huyện</option>
                                        </select>
                                        @if ($errors->has('home_district_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_district_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2{{ $errors->has('home_ward_id') ? ' has-error' : '' }}">
                                        <select name="home_ward_id" id="home_ward_id" class="form-control" value="{{ old('home_ward_id') }}">
                                            <option value="" class="first-select">Chọn Xã/Phường</option>
                                        </select>
                                        @if ($errors->has('home_ward_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_ward_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-4{{ $errors->has('home_number') ? ' has-error' : '' }}">
                                        <input type="text" name="home_number" class="form-control"
                                               placeholder="Xóm/Số nhà" value="{{ old('home_number') }}">
                                        @if ($errors->has('home_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('identity_card') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Chứng minh nhân dân (*)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="identity_card" class="form-control"
                                               placeholder="Chứng minh nhân dân" value="{{ old('identity_card') }}" 
                                               pattern="^[\d\+\-\.\(\)\/\s]*$" required>
                                        @if ($errors->has('identity_card'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('identity_card') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full" />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Loại khách hàng</label>
                                    <div class="col-sm-10">
                                        <select id="shop_type_id" name="shop_type_id" class="form-control">
                                            @foreach ($shoptypes as $key => $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary pull-left" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{--<label>{{count($errs)}}</label>--}}


        </div>

        <!-- /tile footer -->
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
        });
        function selectCityOffice(selectObj) {
            if (selectObj.value !== "") {
                $("#office_district_id option:not(:first)").remove().end();
                $("#home_ward_id option:not(:first)").remove().end();
                $.ajax({
                    url: base_url + '/admin/settings/administrative_units/' + selectObj.value + '/get_unit_by_parrent',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        var optionContent = "";
                        for (key in response) {
                            optionContent += "<option value='" + response[key].id + "'>" + response[key].name + "</option>";
                        }
                        $("#office_district_id").append(optionContent);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            }
        }
        function selectDistrictOffice(selectObj) {
            if (selectObj.value !== "") {
                $("#office_ward_id option:not(:first)").remove().end();
                $.ajax({
                    url: base_url + '/admin/settings/administrative_units/' + selectObj.value + '/get_unit_by_parrent',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        var optionContent = "";
                        for (key in response) {
                            optionContent += "<option value='" + response[key].id + "'>" + response[key].name + "</option>";
                        }
                        $("#office_ward_id").append(optionContent);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            }
        }
        function selectCity(selectObj) {
            if (selectObj.value !== "") {
                $("#home_district_id option:not(:first)").remove().end();
                $("#home_ward_id option:not(:first)").remove().end();
                $.ajax({
                    url: base_url + '/admin/settings/administrative_units/' + selectObj.value + '/get_unit_by_parrent',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        var optionContent = "";
                        for (key in response) {
                            optionContent += "<option value='" + response[key].id + "'>" + response[key].name + "</option>";
                        }
                        $("#home_district_id").append(optionContent);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            }
        }
        function selectDistrict(selectObj) {
            if (selectObj.value !== "") {
                $("#home_ward_id option:not(:first)").remove().end();
                $.ajax({
                    url: base_url + '/admin/settings/administrative_units/' + selectObj.value + '/get_unit_by_parrent',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        var optionContent = "";
                        for (key in response) {
                            optionContent += "<option value='" + response[key].id + "'>" + response[key].name + "</option>";
                        }
                        $("#home_ward_id").append(optionContent);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            }
        }
        function check_user_duplicate(selector, colum_name) {
            $.ajax({
                url: "/shop/check_user_duplicate",
                type: 'POST',
                data: {colum_name: colum_name, value: $(selector).val()},
                success: function (result) {
                    if (result == "ok") {
                        $(selector).removeClass('parsley-error');
                        $(selector).addClass('parsley-success');
                        $("#error_" + colum_name).remove();
                    } else {
                        if ($("#error_" + colum_name).html() == undefined) {
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


