@extends('templates.admin')
@section('content')
<div class="page page-shop-products">
    <div class="pageheader">
        <h2>Shipper</h2>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html"><i class="fa fa-home"></i>MSL Việt Nam</a>
                </li>
                <li>
                    <a href="{{url('/distance_freights')}}">Bảng giá</a>
                </li>
                <li>
                    <a href="{{url('/distance_freights/create')}}">Thêm mới</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- page content -->
    <div class="pagecontent">
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">Thêm đơn giá</h1>
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
                                            <i class="fa fa-refresh"></i> Làm mới
                                        </a>
                                    </li>
                                    <li>
                                        <a role="button" tabindex="0" class="tile-fullscreen">
                                            <i class="fa fa-expand"></i> Toàn màn hình
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

                        <form class="form-horizontal" method="POST" action="{{url('distance_freights/store')}}" name="create-shipper-form" role="form" id="create-shipper-form" data-parsley-validate>
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tên đơn giá<span style="color:red;">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="name" id="code" onfocusout="check_new_user_duplicate(this, 'code')" class="form-control" placeholder="Tên đơn giá" value="{{old('name')}}" required>
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Mã đơn giá</label>
                                <div class="col-md-10">
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Mã đơn giá" value="FR{{$dist_freight_code}}" readonly required>
                                    @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full" />
                            <div class="form-group">
                                <label class="col-md-2 control-label">Khoảng cách từ<span style="color:red;">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="from" id="from" class="form-control" placeholder="Khoảng cách từ" value="{{old('from')}}" required>
                                    @if ($errors->has('from'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Khoăng cách đến<span style="color:red;">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="to" id="to" class="form-control" placeholder="Khoăng cách đến" value="{{old('to')}}" required>
                                    @if ($errors->has('to'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('to') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Giá cước<span style="color:red;">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="freight" id="freight" class="form-control" placeholder="Giá cước" value="{{old('freight')}}" required>
                                    @if ($errors->has('freight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('freight') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Loại xe<span style="color:red;">*</span></label>
                                <div class="col-md-10">
                                    <select name="vehicle_type_id" class="form-control" placeholder="Loại xe" value="{{ old('vehicle_type_id') }}" required>
                                        <?php foreach ($vehicle_list AS $vehicle) : ?>
                                            <option value="<?php echo $vehicle->id; ?>"><?php echo $vehicle->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    @if ($errors->has('vehicle_type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vehicle_type_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class = "tile-footer text-right bg-tr-black lter dvd dvd-top">
                                <!--SUBMIT BUTTON -->
                                <button type = "submit" class = "btn btn-default" id = "form4Submit">Submit</button>
                            </div>
                        </form>

                    </div>

                    <!--/tile footer -->
                </section>
            </div>
            <!--/col -->
        </div>
        <!--/row -->
    </div>
    <!--/page content -->
</div>
@endsection