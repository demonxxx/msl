@extends('app.shippers.shipper')
@section('shipper')
@include('partials.flash')
<!-- tile -->
<section class="tile">

<!-- tile header -->
<div class="tile-header dvd dvd-btm">
    <h1 class="custom-font">Sửa tài xế</h1>
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
    <form class="form-horizontal" method="POST" action="{{URL::to('/')."/shipper/".$user_id."/update"}}" name="edit-shipper-form" 
          role="form" id="edit-shipper-form" data-parsley-validate>
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-sm-2 control-label">Mã shipper</label>
            <div class="col-sm-10">
                <input type="text" name="code" id="code" onfocusout="check_update_user_duplicate(this, 'code',{{$user_id}})" 
                       class="form-control" placeholder="Mã shipper" 
                       data-parsley-trigger="change" value="{{$user->code}}" readonly="readonly" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Họ và tên tài xế</label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control" placeholder="Họ và tên shipper" 
                       data-parsley-trigger="change" value="{{$user->name}}" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Số điện thoại.</label>
            <div class="col-sm-10">
                <input type="text" name="phone_number" onfocusout="check_update_user_duplicate(this, 'phone_number',{{$user_id}})" 
                       class="form-control" placeholder="(XXX) XXXX XXX" data-parsley-trigger="change"
                       pattern="^[\d\+\-\.\(\)\/\s]*$" value="{{$user->phone_number}}" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Thư điện tử</label>
            <div class="col-sm-10">
                <input type="email" name="email" id="email" onfocusout="check_update_user_duplicate(this, 'email',{{$user_id}})" 
                       class="form-control" placeholder="Email" 
                       data-parsley-trigger="change" value="{{$user->email}}" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Địa chỉ nhà </label>
            <div class="col-sm-3">
                <input type="text" name="home_ward" class="form-control" placeholder="Xã/Phường" 
                       data-parsley-trigger="change" value="{{$shipper->home_ward}}" required>
            </div>
            <div class="col-sm-3">
                <input type="text" name="home_district" class="form-control" placeholder="Quận/huyện" 
                       data-parsley-trigger="change" value="{{$shipper->home_district}}" required>
            </div>
            <div class="col-sm-3">
                <input type="text" name="home_city" class="form-control" placeholder="Tỉnh/Thành phố" 
                       data-parsley-trigger="change" value="{{$shipper->home_city}}" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Địa chỉ văn phòng </label>
            <div class="col-sm-3">
                <input type="text" name="office_ward" class="form-control" placeholder="Xã/Phường" 
                       data-parsley-trigger="change" value="{{$shipper->office_ward}}" required>
            </div>
            <div class="col-sm-3">
                <input type="text" name="office_district" class="form-control" placeholder="Quận/huyện" 
                       data-parsley-trigger="change" value="{{$shipper->office_district}}" required>
            </div>
            <div class="col-sm-3">
                <input type="text" name="office_city" class="form-control" placeholder="Tỉnh/Thành phố" 
                       data-parsley-trigger="change" value="{{$shipper->office_city}}" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Chứng minh nhân dân</label>
            <div class="col-sm-10">
                <input type="number" name="identity_card" class="form-control" placeholder="Chứng minh nhân dân" 
                       data-parsley-trigger="change" value="{{$user->identity_card}}" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Loại xe</label>
            <div class="col-sm-5">
                <input type="number" name="vehicle_type" class="form-control" placeholder="Loại xe" 
                       data-parsley-trigger="change" value="{{$shipper->vehicle_type}}" required>
            </div>
        </div>
        <hr class="line-dashed line-full" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Biển số xe</label>
            <div class="col-sm-5">
                <input type="text" name="licence_plate" class="form-control" placeholder="Biển số xe" 
                       data-parsley-trigger="change" value="{{$shipper->licence_plate}}" required>
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
    $(document).ready(function(){
        // $('#form4Submit').on('click', function(){
        //     $('#form4').submit();
        // });
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


