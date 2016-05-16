@extends('app.shippers.shipper')
@section('shipper')
<!-- tile -->
<section class="tile">

<!-- tile header -->
<div class="tile-header dvd dvd-btm">
    <h1 class="custom-font">Thêm tài xế</h1>
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

    <form class="form-horizontal" method="POST" action="{{url('shipper/store')}}" name="create-shipper-form" role="form" id="create-shipper-form" data-parsley-validate>
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-sm-2 control-label">Mã shipper</label>
            <div class="col-sm-10">
                <input type="text" name="code" id="code" onfocusout="check_new_user_duplicate(this, 'code')" class="form-control" 
                       placeholder="Mã shipper" readonly="readonly" value="TX{{$shipper_code}}" data-parsley-trigger="change" required>
            </div>
        </div>
        <hr class="line-dashed line-full"/>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tài khoản đăng nhập</label>
            <div class="col-sm-10">
                <input type="text" name="username" id="username" onfocusout="check_new_user_duplicate(this, 'username')" 
                       class="form-control" placeholder="Tài khoản đăng nhập" data-parsley-trigger="change" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Họ và tên shipper</label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control" placeholder="Họ và tên shipper" data-parsley-trigger="change"
                    required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Số điện thoại.</label>
            <div class="col-sm-10">
                <input type="text" name="phone_number" onfocusout="check_new_user_duplicate(this, 'phone_number')"
                       class="form-control" placeholder="(XXX) XXXX XXX" data-parsley-trigger="change"
                       pattern="^[\d\+\-\.\(\)\/\s]*$" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Thư điện tử</label>
            <div class="col-sm-10">
                <input type="email" name="email" id="email" onfocusout="check_new_user_duplicate(this, 'email')" 
                       class="form-control" placeholder="Email" data-parsley-trigger="change" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Địa chỉ nhà </label>
            <div class="col-sm-2">
                <input type="text" name="home_number" class="form-control" placeholder="Xóm/Số nhà" data-parsley-trigger="change" required>
            </div>
            <div class="col-sm-2">
                <input type="text" name="home_ward" class="form-control" placeholder="Xã/Phường" data-parsley-trigger="change" required>
            </div>
            <div class="col-sm-2">
                <input type="text" name="home_district" class="form-control" placeholder="Quận/huyện" data-parsley-trigger="change" required>
            </div>
            <div class="col-sm-2">
                <input type="text" name="home_city" class="form-control" placeholder="Tỉnh/Thành phố" data-parsley-trigger="change" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Chứng minh nhân dân</label>
            <div class="col-sm-10">
                <input type="number" name="identity_card" class="form-control" placeholder="Chứng minh nhân dân" data-parsley-trigger="change" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Loại xe</label>
            <div class="col-sm-10">
                <select name="vehicle_type_id" class="form-control" placeholder="Loại xe" data-parsley-trigger="change" required>
                    <option value="0">Xe máy</option>
                    <option value="1">Ô tô</option>
                </select>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Biển số xe</label>
            <div class="col-sm-10">
                <input type="text" name="licence_plate" class="form-control" placeholder="Biển số xe" data-parsley-trigger="change" required>
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
    $(document).ready(function(){
        // $('#form4Submit').on('click', function(){
        //     $('#form4').submit();
        // });
    });
    
    function check_new_user_duplicate(selector, colum_name) {
        $.ajax({
            url: "/shipper/check_new_user_duplicate",
            type: 'POST',
            data: {colum_name: colum_name, value: $(selector).val()},
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


