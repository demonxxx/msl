@extends('app.discounts.discount')
@section('discount')
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
                        <h5>Thêm mã khuyến mại
                        </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{url('discount/store')}}"
                              name="create-discount-form" role="form" id="create-discount-form" data-parsley-validate>
                            {!! csrf_field() !!}
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Tên khuyến mại (*)</label>
                                <div class="col-md-10">
                                    <input type="text" name="name" id="name" maxlength="255"
                                           onfocusout="check_new_duplicate(this, 'name')"
                                           class="form-control" placeholder="Tên khuyến mại"
                                           value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('code_number') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Mã khuyến mại (*)</label>
                                <div class="col-md-10">
                                    <input type="text" name="code_number" id="code_number" maxlength="6"
                                           onfocusout="check_new_duplicate(this, 'code_number')"
                                           class="form-control" placeholder="Mã khuyến mại" 
                                           value="{{ old('code_number') }}" required>
                                    @if ($errors->has('code_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Loại khuyến mại</label>
                                <div class="col-md-10">
                                    <select id="type" name="type" class="form-control" onchange="check_amount()">
                                        <option selected="selected" value="0">Giảm %</option>
                                        <option value="1">Giảm số tiền</option>
                                    </select>
                                    @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Giá trị khuyến mại (*)</label>
                                <div class="col-md-10">
                                    <input type="number" name="amount" id="amount1" min="0" max="100"
                                           class="form-control" placeholder="Giá trị khuyến mại (%)" 
                                           value="{{ old('amount') }}" required>
                                    <input type="number" name="amount" id="amount2" min="1"
                                           class="form-control" placeholder="Giá trị khuyến mại (Nghìn VNĐ)" 
                                           onfocusout="compute_money(this)"
                                           value="{{ old('amount') }}" disabled style="display: none">
                                    @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Tổng số lượt sử dụng(*)</label>
                                <div class="col-md-10">
                                    <input type="number" name="total" id="total" min="1"
                                           class="form-control" placeholder="Tổng số lượt sử dụng" 
                                           value="{{ old('total') }}" required>
                                    @if ($errors->has('total'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('total_one_user') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Tổng số lượt dùng của một người(*)</label>
                                <div class="col-md-10">
                                    <input type="number" name="total_one_user" id="total_one_user" min="1"
                                           class="form-control" placeholder="Tổng số lượt dùng của một người" 
                                           value="{{ old('total_one_user') }}" required>
                                    @if ($errors->has('total_one_user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total_one_user') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Ngày áp dụng(*)</label>
                                <div class="col-md-10">
                                    <input type="datetime" name="start_time" id="start_time"
                                           class="form-control" placeholder="Ngày áp dụng" value="{{ old('start_time') }}" required>
                                    @if ($errors->has('start_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Ngày kết thúc(*)</label>
                                <div class="col-md-10">
                                    <input type="datetime" name="end_time" id="end_time"
                                           class="form-control" placeholder="Ngày kết thúc" value="{{ old('end_time') }}" required>
                                    @if ($errors->has('end_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Ghi chú</label>
                                <div class="col-md-10">
                                    <input type="text" name="description" id="description" maxlength="255"
                                           class="form-control" placeholder="Ghi chú" value="{{ old('description') }}">
                                    @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <button class="btn btn-primary pull-left" type="submit">Thêm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /tile footer -->
</section>

<script type="text/javascript">
    $(function() {
        $( "#start_time" ).datepicker({
            dateFormat: "yy-mm-dd",
            onSelect: function() {
                var minDate = $('#start_time').datepicker('getDate');
                $("#end_time").datepicker("change", { minDate: minDate });
            }
        });
        $( "#end_time" ).datepicker({ 
            dateFormat: "yy-mm-dd",
            onSelect: function() {
                var maxDate = $('#end_time').datepicker('getDate');
                $("#start_time").datepicker("change", { maxDate: maxDate });
            }
        });
    });
    function check_amount(){
        if ($( "#type" ).val() == 0) {
            $( "#amount2" ).attr("disabled","disabled");
            $( "#amount1" ).attr("required","required");
            $( "#amount2" ).removeAttr("required");
            $( "#amount1" ).removeAttr("disabled");
            $( "#amount1" ).show();
            $( "#amount2" ).hide();
        } else {
            $( "#amount1" ).attr("disabled","disabled");
            $( "#amount2" ).attr("required","required");
            $( "#amount1" ).removeAttr("required");
            $( "#amount2" ).removeAttr("disabled");
            $( "#amount2" ).show();
            $( "#amount1" ).hide();
        }
    }
    function compute_money(me){
        $( "#amount2" ).val($( "#amount2" ).val() *1000);
        $( "#amount2" ).text($( "#amount2" ).val());
    }
    function check_new_duplicate(selector, colum_name) {
        $.ajax({
            url: "/discount/check_new_duplicate",
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


