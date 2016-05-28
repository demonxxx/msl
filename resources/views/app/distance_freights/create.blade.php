@extends('templates.admin')
@section('content')
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
                        <h5>Thêm đơn giá
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
                                    <input type="number" name="from" id="from" class="form-control" placeholder="Khoảng cách từ" value="{{old('from')}}" required>
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
                                    <input type="number" name="to" id="to" class="form-control" placeholder="Khoăng cách đến" value="{{old('to')}}" required>
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
                                    <input type="number" name="freight" id="freight" class="form-control" placeholder="Giá cước" value="{{old('freight')}}" required>
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
                                <button type="submit" class="btn btn-default" id="form4Submit">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--<label>{{count($errs)}}</label>--}}
    </div>
</section>
@endsection