@extends('app.shops.shop')
@section('shop')
@include('partials.flash')
        <!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font">Sửa khách hàng</h1>
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
        <form class="form-horizontal" method="POST" action="{{URL::to('/')."/shop/".$user_id."/update"}}" name="create-shop-form" role="form"
              id="edit-shop-form" data-parsley-validate>
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="col-sm-2 control-label">Mã khách hàng</label>
                <div class="col-sm-10">
                    <input type="text" name="code" id="code" onfocusout="check_update_user_duplicate(this, 'code',{{$user_id}})" 
                           class="form-control" placeholder="Mã khách hàng"
                           data-parsley-trigger="change" value="{{$user->code}}" readonly required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tài khoản đăng nhập</label>
                <div class="col-sm-10">
                    <input type="text" name="username" id="username" onfocusout="check_update_user_duplicate(this, 'username')"  value="{{$user->username}}"
                           class="form-control" placeholder="Tài khoản đăng nhập" data-parsley-trigger="change" readonly required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Họ và tên khách hàng</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Họ và tên khách hàng"
                           data-parsley-trigger="change" value="{{$user->name}}"
                           required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Số điện thoại.</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_number" onfocusout="check_update_user_duplicate(this, 'phone_number',{{$user_id}})" 
                           class="form-control" placeholder="(XXX) XXXX XXX"
                           data-parsley-trigger="change" value="{{$user->phone_number}}"
                           pattern="^[\d\+\-\.\(\)\/\s]*$" required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Thư điện tử</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" onfocusout="check_update_user_duplicate(this, 'email',{{$user_id}})" 
                           class="form-control" placeholder="Email"
                           data-parsley-trigger="change" value="{{$user->email}}" required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Địa chỉ nhà </label>
                <div class="col-sm-2">
                    <input type="text" name="home_number" class="form-control" placeholder="Xóm/Số nhà"
                           data-parsley-trigger="change" value="{{$shop->home_number}}" required>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="home_ward" class="form-control" placeholder="Xã/Phường"
                           data-parsley-trigger="change" value="{{$shop->home_ward}}" required>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="home_district" class="form-control" placeholder="Quận/huyện"
                           data-parsley-trigger="change" value="{{$shop->home_district}}" required>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="home_city" class="form-control" placeholder="Tỉnh/Thành phố"
                           data-parsley-trigger="change" value="{{$shop->home_city}}" required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Địa chỉ văn phòng </label>
                <div class="col-sm-2">
                    <input type="text" name="office_number" class="form-control" placeholder="Xóm/Số nhà"
                           data-parsley-trigger="change" value="{{$shop->office_number}}" required>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="office_ward" class="form-control" placeholder="Xã/Phường"
                           data-parsley-trigger="change" value="{{$shop->office_ward}}" required>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="office_district" class="form-control" placeholder="Quận/huyện"
                           data-parsley-trigger="change" value="{{$shop->office_district}}" required>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="office_city" class="form-control" placeholder="Tỉnh/Thành phố"
                           data-parsley-trigger="change" value="{{$shop->office_city}}" required>
                </div>
            </div>
            <hr class="line-dashed line-full"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Chứng minh nhân dân</label>
                <div class="col-sm-10">
                    <input type="number" name="identity_card" class="form-control" placeholder="Chứng minh nhân dân"
                           data-parsley-trigger="change" value="{{$user->identity_card}}" required>
                </div>
            </div>
            <hr class="line-dashed line-full" />
            <div class="form-group">
                <label class="col-sm-2 control-label">Loại khách hàng</label>
                <div class="col-sm-10">
                    <select id="shop_type" name="shop_type" class="form-control" pre_value="{{$shop->shop_type}}" 
                            data-parsley-trigger="change">
                        <option value="0">Khách hàng lớn</option>
                        <option value="1">Khách hàng tiềm năng</option>
                        <option value="2">Khách hàng tự do</option>
                    </select>
                </div>
            </div>
            <hr class="line-dashed line-full" />
            <div class="form-group">
                <label class="col-sm-2 control-label">Tình trạng hồ sơ</label>
                <div class="col-sm-10">
                    <select id="profile_status" name="profile_status" class="form-control" pre_value="{{$shop->profile_status}}" 
                            data-parsley-trigger="change">
                        <option value="0">20%</option>
                        <option value="1">40%</option>
                        <option value="2">60%</option>
                        <option value="3">80%</option>
                        <option value="4">100%</option>
                    </select>
                </div>
            </div>
            <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                <!-- SUBMIT BUTTON -->
                <button type="submit" class="btn btn-default" id="form4Submit">Submit</button>
            </div>
        </form>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- /tile footer -->
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $('#shop_type').val($('#shop_type').attr("pre_value"));
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
</script>
@endsection


