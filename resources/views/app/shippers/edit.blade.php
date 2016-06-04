@extends('app.shippers.shipper')
@section('shipper')
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
                            <h5>Sửa thông tin tài xế
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
                            <form class="form-horizontal" method="POST"
                                  action="{{URL::to('/')."/shipper/".$user_id."/update"}}" name="edit-shipper-form"
                                  role="form" id="edit-shipper-form" data-parsley-validate>
                                {!! csrf_field() !!}
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Họ và tên tài xế (*)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Họ và tên shipper"
                                               data-parsley-trigger="change" value="{{$user->name}}" required>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Số điện thoại (*)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone_number"
                                               onfocusout="check_update_user_duplicate(this, 'phone_number',{{$user_id}})"
                                               class="form-control" placeholder="(XXX) XXXX XXX"
                                               data-parsley-trigger="change"
                                               pattern="^[\d\+\-\.\(\)\/\s]*$" value="{{$user->phone_number}}" required>
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
                                        <input type="email" name="email" id="email"
                                               onfocusout="check_update_user_duplicate(this, 'email',{{$user_id}})"
                                               class="form-control" placeholder="Email"
                                               data-parsley-trigger="change" value="{{$user->email}}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Địa chỉ nhà (*)</label>
                                    <div class="col-md-2{{ $errors->has('home_city_id') ? ' has-error' : '' }}">
                                        <select name="home_city_id" id="home_city_id" class="form-control" value="{{ old('home_city_id') }}" onchange="selectCity(this)" required>
                                            <option value="" class="first-select">Chọn thành phố</option>
                                            @foreach($cities AS $city)
                                                @if ($city->id == $shipper->home_city_id)
                                                    <option selected="selected" value="{{$city->id}}">{{$city->name}}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('home_city_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_city_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2{{ $errors->has('home_district_id') ? ' has-error' : '' }}">
                                        <select name="home_district_id" id="home_district_id" class="form-control" value="{{ old('home_district_id') }}" onchange="selectDistrict(this)" required>
                                            <option value="" class="first-select">Chọn Quận/Huyện</option>
                                            @foreach($districts AS $district)
                                                @if ($district->id == $shipper->home_district_id)
                                                    <option selected="selected" value="{{$district->id}}">{{$district->name}}</option>
                                                @else
                                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('home_district_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_district_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2{{ $errors->has('home_ward_id') ? ' has-error' : '' }}">
                                        <select name="home_ward_id" id="home_ward_id" class="form-control" value="{{ old('home_ward_id') }}" required>
                                            <option value="" class="first-select">Chọn Xã/Phường</option>
                                            @foreach($wards AS $ward)
                                                @if ($ward->id == $shipper->home_ward_id)
                                                    <option selected="selected" value="{{$ward->id}}">{{$ward->name}}</option>
                                                @else
                                                    <option value="{{$ward->id}}">{{$ward->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('home_ward_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_ward_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-4{{ $errors->has('home_number') ? ' has-error' : '' }}">
                                        <input type="text" name="home_number" class="form-control"
                                               placeholder="Xóm/Số nhà" value="{{ $shipper->home_number }}" required>
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
                                        <input type="number" name="identity_card" class="form-control"
                                               placeholder="Chứng minh nhân dân"
                                               data-parsley-trigger="change" value="{{$user->identity_card}}" required>
                                        @if ($errors->has('identity_card'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('identity_card') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('shipper_type_id') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Loại tài xế</label>
                                    <div class="col-sm-10">
                                        <select id="shipper_type_id" name="shipper_type_id" class="form-control" required>
                                            @foreach ($shippertypes as $key => $value)
                                                @if ($value->id == $shipper->shipper_type_id)
                                                    <option selected="selected" value="{{$value->id}}">{{$value->name}}</option>
                                                @else
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('shipper_type_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('shipper_type_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('vehicle_type_id') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Loại xe</label>
                                    <div class="col-sm-10">
                                        <select id="vehicle_type_id" name="vehicle_type_id" class="form-control">
                                            @foreach ($vehicletypes as $key => $value)
                                                @if ($value->id == $shipper->vehicle_type_id)
                                                    <option selected="selected" value="{{$value->id}}">{{$value->name}}</option>
                                                @else
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('vehicle_type_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('vehicle_type_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('licence_plate') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Biển số xe (*)</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="licence_plate" class="form-control"
                                               placeholder="Biển số xe"
                                               data-parsley-trigger="change" value="{{$shipper->licence_plate}}"
                                               required>
                                        @if ($errors->has('licence_plate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('licence_plate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group{{ $errors->has('licence_driver_number') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 control-label">Giấy phép lái xe số</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="licence_driver_number" class="form-control"
                                               placeholder="Giấy phép lái xe số" value="{{ $shipper->licence_driver_number }}" 
                                               pattern="^[\d\+\-\.\(\)\/\s]*$" required>
                                        @if ($errors->has('licence_driver_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('licence_driver_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Đánh giá trung bình</label>
                                    <div class="col-sm-10">
                                        <input type="double" name="average_score" class="form-control" readonly=""
                                               data-parsley-trigger="change" value="{{$shipper->average_score}}">
                                    </div>
                                </div>
                                @can('admin')
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tình trạng hồ sơ</label>
                                    <div class="col-sm-10">
                                        <select id="profile_status" name="profile_status" class="form-control"
                                                pre_value="{{$shipper->profile_status}}"
                                                data-parsley-trigger="change">
                                                    <option value="Chưa xác thực">Chưa xác thực</option>
                                                    <option value="Đang xác thực">Đang xác thực</option>
                                                    <option value="Đã xác thực">Đã xác thực</option>
                                        </select>
                                    </div>
                                </div>
                                @endcan
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
            $('#average_score').val($('#average_score').attr("pre_value"));
            $('#profile_status').val($('#profile_status').attr("pre_value"));
        });
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
        function check_update_user_duplicate(selector, colum_name, user_id) {
            $.ajax({
                url: "/shipper/check_update_user_duplicate",
                type: 'POST',
                data: {colum_name: colum_name, value: $(selector).val(), user_id: user_id},
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


