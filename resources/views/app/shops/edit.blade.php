@extends('app.shops.shop')
@section('shop')
        <!-- tile -->
<script src="{{ asset("theme/js/plugins/parsley/parsley.min.js") }}"></script>
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
                        <form class="form-horizontal" method="POST" action="{{URL::to('/')."/shop/".$user_id."/update"}}" name="create-shop-form" role="form"
                              id="edit-shop-form" data-parsley-validate>
                            {!! csrf_field() !!}
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Họ và tên khách hàng (*)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Họ và tên khách hàng"
                                           data-parsley-trigger="change" value="{{$user->name}}" required>
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
                                           data-parsley-trigger="change" value="{{$shop->shop_name}}">
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
                                    <input type="text" name="phone_number" onfocusout="check_update_user_duplicate(this, 'phone_number',{{$user_id}})"
                                           class="form-control" placeholder="(XXX) XXXX XXX"
                                           data-parsley-trigger="change" value="{{$user->phone_number}}"
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
                                    <input type="email" name="email" id="email" onfocusout="check_update_user_duplicate(this, 'email',{{$user_id}})"
                                           class="form-control" placeholder="Email"
                                           data-parsley-trigger="change" value="{{$user->email}}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Địa chỉ cửa hàng (*)</label>
                                <div class="col-sm-2{{ $errors->has('office_number') ? ' has-error' : '' }}">
                                    <input type="text" name="office_number" class="form-control" placeholder="Xóm/Số nhà"
                                           data-parsley-trigger="change" value="{{$shop->office_number}}" required>
                                    @if ($errors->has('office_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2{{ $errors->has('office_ward') ? ' has-error' : '' }}">
                                    <input type="text" name="office_ward" class="form-control" placeholder="Xã/Phường"
                                           data-parsley-trigger="change" value="{{$shop->office_ward}}" required>
                                    @if ($errors->has('office_ward'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_ward') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2{{ $errors->has('office_district') ? ' has-error' : '' }}">
                                    <input type="text" name="office_district" class="form-control" placeholder="Quận/huyện"
                                           data-parsley-trigger="change" value="{{$shop->office_district}}" required>
                                    @if ($errors->has('office_district'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2{{ $errors->has('office_city') ? ' has-error' : '' }}">
                                    <input type="text" name="office_city" class="form-control" placeholder="Tỉnh/Thành phố"
                                           data-parsley-trigger="change" value="{{$shop->office_city}}" required>
                                    @if ($errors->has('office_city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('office_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Địa chỉ nhà </label>
                                <div class="col-sm-2{{ $errors->has('home_number') ? ' has-error' : '' }}">
                                    <input type="text" name="home_number" class="form-control" placeholder="Xóm/Số nhà"
                                           data-parsley-trigger="change" value="{{$shop->home_number}}">
                                    @if ($errors->has('home_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2{{ $errors->has('home_ward') ? ' has-error' : '' }}">
                                    <input type="text" name="home_ward" class="form-control" placeholder="Xã/Phường"
                                           data-parsley-trigger="change" value="{{$shop->home_ward}}">
                                    @if ($errors->has('home_ward'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_ward') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2{{ $errors->has('home_district') ? ' has-error' : '' }}">
                                    <input type="text" name="home_district" class="form-control" placeholder="Quận/huyện"
                                           data-parsley-trigger="change" value="{{$shop->home_district}}">
                                    @if ($errors->has('home_district'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2{{ $errors->has('home_city') ? ' has-error' : '' }}">
                                    <input type="text" name="home_city" class="form-control" placeholder="Tỉnh/Thành phố"
                                           data-parsley-trigger="change" value="{{$shop->home_city}}">
                                    @if ($errors->has('home_city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('identity_card') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Chứng minh nhân dân (*)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="identity_card" class="form-control" placeholder="Chứng minh nhân dân"
                                           data-parsley-trigger="change" value="{{$user->identity_card}}" 
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
                                            @if ($value->id == $shop->shop_type_id)
                                                <option selected="selected" value="{{$value->id}}">{{$value->name}}</option>
                                            @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="line-dashed line-full" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tình trạng hồ sơ</label>
                                <div class="col-sm-10">
                                    <select id="profile_status" name="profile_status" class="form-control" pre_value="{{$shop->profile_status}}"
                                            data-parsley-trigger="change">
                                        <option value="0">Chưa xác thực</option>
                                        <option value="1">Đã xác thực</option>
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
                        <div class="ibox-content">
                            <div class="col-sm-12 ">
                                <button class="btn btn-primary pull-right" onclick="register_shipper({{$user_id}})">Đăng kí tài xế</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--<label>{{count($errs)}}</label>--}}

    </div>

    <!-- /tile footer -->
</section>
<section class="tile">

    <div class="tile-body">
    </div>

    <!-- /tile footer -->
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $('#profile_status').val($('#profile_status').attr("pre_value"));
    });
    function check_update_user_duplicate(selector, colum_name, user_id) {
        $.ajax({
            url: "/shipper/check_update_user_duplicate",
            type: 'POST',
            data: {colum_name: colum_name, value: $(selector).val(), user_id: user_id},
            success: function (result) {
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
    function register_shipper(user_id) {
        $.ajax({
            url: "/shipper/register_shipper",
            type: 'POST',
            data: {user_id: user_id},
            success: function (result) {
                window.location.reload();
            },
            error: function(result){
                console.log(result);
            }
        });
    }
</script>
@endsection


