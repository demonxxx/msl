
@extends('app.orders.order')
@section('order')
    <link rel="stylesheet" href="{{ asset("app/orders/order.css") }}">
    <!-- tile -->
    <section class="tile">

        <!-- tile header -->
        <div class="tile-header dvd dvd-btm">
            <h1 class="custom-font">Thêm đơn hàng</h1>
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
            <form class="form-horizontal" method="POST" action="{{url('order/store')}}" name="create-shop-form"
                  id="create-order-form" data-parsley-validate>
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phương tiện vận chuyển</label>
                    <input type="hidden" value="1" name="order_type_id">
                    <div class="col-sm-10">
                        <select name="vehicle_type_id" class="form-control mb-10" value="{{ old('vehicle_type_id') }}" required>
                            <option value="1">Xe máy</option>
                            <option value="2">Ô tô</option>
                        </select>
                    </div>
                </div>
                <hr class="line-dashed line-full"/>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tên đơn hàng</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control" pvalue="{{ old('name') }}" laceholder="Tên đơn hàng" required>
                    </div>
                </div>
                <section>
                    <h4 class="page-header custom-font"><strong>Thông tin người nhận</strong></h4>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Họ tên người nhận</label>
                        <div class="col-sm-10">
                            <input type="text" name="recipient_name" id="recipient_name" value="{{ old('recipient_name') }}" class="form-control" placeholder="Họ tên người nhận" required>
                        </div>
                    </div>
                    <hr class="line-dashed line-full"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" name="recipient_phone" id="recipient_phone" value="{{ old('recipient_phone') }}" class="form-control" placeholder="Số điện thoại" required>

                        </div>
                    </div>
                    <hr class="line-dashed line-full"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Địa chỉ nhận</label>
                        <div class="col-sm-10">
                            <input type="text" name="full_address_to" id="full_address_to" value="{{ old('full_address_to') }}" class="form-control" placeholder="Địa chỉ nhận hàng" required>

                        </div>
                    </div>
                </section>
                <section>
                    <h4 class="page-header custom-font"><strong>Thông tin chi tiết đơn hàng</strong></h4>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <input type="text" name="full_address_from" id="full_address_from" value="{{ old('full_address_from') }}" class="form-control" placeholder="Địa chỉ" required>
                        </div>
                    </div>
                    <hr class="line-dashed line-full"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Giá trị hàng hóa</label>
                        <div class="col-sm-10">
                            <input type="text" name="order_values" id="order_values" class="form-control" value="{{ old('order_values') }}" placeholder="Giá trị" required>
                        </div>
                    </div>
                    <hr class="line-dashed line-full"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mã khuyến mại (nếu có)</label>
                        <div class="col-sm-10">
                            <input type="text" name="discount_code" id="discount_code" class="form-control"  placeholder="Mã khuyến mại" >
                        </div>
                    </div>
                    <hr class="line-dashed line-full"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ghi chú</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control" placeholder="Ghi chú" required>
                        </div>
                    </div>
                </section>
                <section>
                    <h4 class="page-header custom-font"><strong>Dịch vụ đi kèm</strong></h4>
                </section>
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

        });
    </script>
@endsection


