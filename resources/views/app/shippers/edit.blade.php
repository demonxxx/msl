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
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mã tài xế</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="code" id="code"
                                               onfocusout="check_update_user_duplicate(this, 'code',{{$user_id}})"
                                               class="form-control" placeholder="Mã tài xế"
                                               data-parsley-trigger="change" value="{{$user->code}}" readonly required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tài khoản đăng nhập</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" id="username"
                                               onfocusout="check_update_user_duplicate(this, 'username')"
                                               value="{{$user->username}}"
                                               class="form-control" placeholder="Tài khoản đăng nhập"
                                               data-parsley-trigger="change" readonly required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Họ và tên tài xế</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Họ và tên shipper"
                                               data-parsley-trigger="change" value="{{$user->name}}" required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Số điện thoại.</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone_number"
                                               onfocusout="check_update_user_duplicate(this, 'phone_number',{{$user_id}})"
                                               class="form-control" placeholder="(XXX) XXXX XXX"
                                               data-parsley-trigger="change"
                                               pattern="^[\d\+\-\.\(\)\/\s]*$" value="{{$user->phone_number}}" required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Thư điện tử</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" id="email"
                                               onfocusout="check_update_user_duplicate(this, 'email',{{$user_id}})"
                                               class="form-control" placeholder="Email"
                                               data-parsley-trigger="change" value="{{$user->email}}">
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Địa chỉ nhà </label>
                                    <div class="col-sm-2">
                                        <input type="text" name="home_number" class="form-control"
                                               placeholder="Xóm/Số nhà"
                                               data-parsley-trigger="change" value="{{$shipper->home_number}}" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="home_ward" class="form-control" placeholder="Xã/Phường"
                                               data-parsley-trigger="change" value="{{$shipper->home_ward}}" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="home_district" class="form-control"
                                               placeholder="Quận/huyện"
                                               data-parsley-trigger="change" value="{{$shipper->home_district}}"
                                               required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="home_city" class="form-control"
                                               placeholder="Tỉnh/Thành phố"
                                               data-parsley-trigger="change" value="{{$shipper->home_city}}" required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Địa chỉ văn phòng </label>
                                    <div class="col-sm-2">
                                        <input type="text" name="office_number" class="form-control"
                                               placeholder="Xóm/Số nhà"
                                               data-parsley-trigger="change" value="{{$shipper->office_number}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="office_ward" class="form-control"
                                               placeholder="Xã/Phường"
                                               data-parsley-trigger="change" value="{{$shipper->office_ward}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="office_district" class="form-control"
                                               placeholder="Quận/huyện"
                                               data-parsley-trigger="change" value="{{$shipper->office_district}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="office_city" class="form-control"
                                               placeholder="Tỉnh/Thành phố"
                                               data-parsley-trigger="change" value="{{$shipper->office_city}}">
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Chứng minh nhân dân</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="identity_card" class="form-control"
                                               placeholder="Chứng minh nhân dân"
                                               data-parsley-trigger="change" value="{{$user->identity_card}}" required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Loại xe</label>
                                    <div class="col-sm-10">
                                        <select id="vehicle_type_id" name="vehicle_type_id" class="form-control"
                                                pre_value="{{$shipper->vehicle_type_id}}"
                                                data-parsley-trigger="change" required>
                                            <option value="0">Xe máy</option>
                                            <option value="1">Ô tô</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Biển số xe</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="licence_plate" class="form-control"
                                               placeholder="Biển số xe"
                                               data-parsley-trigger="change" value="{{$shipper->licence_plate}}"
                                               required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Loại tài xế</label>
                                    <div class="col-sm-10">
                                        <select id="shipper_type_id" name="shipper_type_id" class="form-control"
                                                pre_value="{{$shipper->shipper_type_id}}"
                                                data-parsley-trigger="change">
                                            <option value="0">Team</option>
                                            <option value="1">Doanh nghiệp</option>
                                            <option value="2">Tự do</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Đánh giá trung bình</label>
                                    <div class="col-sm-10">
                                        <input type="double" name="average_score" class="form-control" readonly=""
                                               value="5.0"
                                               data-parsley-trigger="change" value="{{$shipper->average_score}}"
                                               required>
                                    </div>
                                </div>
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tình trạng hồ sơ</label>
                                    <div class="col-sm-10">
                                        <select id="profile_status" name="profile_status" class="form-control"
                                                pre_value="{{$shipper->profile_status}}"
                                                data-parsley-trigger="change">
                                            <option value="0">20%</option>
                                            <option value="1">40%</option>
                                            <option value="2">60%</option>
                                            <option value="3">80%</option>
                                            <option value="4">100%</option>
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
            $('#vehicle_type_id').val($('#vehicle_type_id').attr("pre_value"));
            $('#shipper_type_id').val($('#shipper_type_id').attr("pre_value"));
            $('#average_score').val($('#average_score').attr("pre_value"));
            $('#profile_status').val($('#profile_status').attr("pre_value"));
        });
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


