@extends('app.discounts.discount')
@section('discount')
<script src="{{ asset("theme/js/plugins/parsley/parsley.min.js") }}"></script>
<link href="{{ asset("theme/css/plugins/jqGrid/ui.jqgrid.css")}}" rel="stylesheet">
<script src="{{ asset("theme/js/plugins/bootbox/bootbox.js")}}"></script>
<!-- jqGrid -->
<script src="{{ asset("theme/js/plugins/jqGrid/i18n/grid.locale-en.js")}}"></script>
<script src="{{ asset("theme/js/plugins/jqGrid/jquery.jqGrid.min.js")}}"></script>
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
                        <h5>Danh sách tài khoản</h5>
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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-custom" id="users-list" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center"><label><input id="checkbox_all" onclick="checkBoxAll(this)" type="checkbox"></label></th>
                                        <th class="text-center" width="4%">Mã người dùng</th>
                                        <th class="text-center">Tên người dùng</th>
                                        <th class="text-center">SĐT</th>

                                    </tr>
                                    <tr class="table-header-search">
                                        <th class="text-center"></th>
                                        <th class="text-center" width="4%">
                                            <input class="text-center" name="code" value="" placeholder="Mã người dùng" />
                                        </th>
                                        <th class="text-center">
                                            <input class="text-center" name="name" value="" placeholder="Tên người dùng" />
                                        </th>
                                        <th class="text-center">
                                            <input class="text-center" name="phone_number" value="" placeholder="SĐT" />
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <button data-toggle="modal" class="btn btn-primary " onclick="addCustomers()"><i
                                    class="fa fa-plus" aria-hidden="true" ></i> Thêm tài khoản
                        </button>
                    </div>
                    <div class="ibox-content">
                        <div class="jqGrid_wrapper">
                            <table id="table_list_1"></table>
                            <div id="pager_list_1"></div>
                        </div>

                    </div>
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
                            <input type="hidden" name="list_users" id="list_users">
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <button class="btn btn-primary pull-left" onclick="submitEvent()">Thêm</button>
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
        $("#table_list_1").jqGrid({
            data: mydata,
            datatype: "local",
            height: 250,
            autowidth: true,
            shrinkToFit: true,
            rowNum: 14,
            trigger:'reloadGrid',
            rowList: [10, 20, 30],
            colNames: ['Mã TK', 'Tên TK', 'SĐT', "Xóa"],
            colModel: [
                {name: 'code', index: 'code', width: 60,align: "center"},
                {name: 'name', index: 'name', width: 90,align: "center"},
                {name: 'phone_number', index: 'phone_number', align: "center",width: 100},
                {name: 'function', index: 'function', width: 80, align: "center"},
            ],
            pager: "#pager_list_1",
            viewrecords: true,
            caption: "Danh sách tài khoản",
            hidegrid: false
        }).trigger('reloadGrid');
        var user_code_render = {
            "render": function (data, type, row) {
                return render_user_code(data);
            },
            "targets": [1]
        };
        
        var user_name_render = {
            "render": function (data, type, row) {
                return render_user_name(data);
            },
            "targets": [2]
        };

        var user_phone_number_render = {
            "render": function (data, type, row) {
                return render_user_phone_number(data);
            },
            "targets": [3]
        };
        
        var checkbox_render = {
            "render": function (data, type, row) {
                var checkbox = render_checkbox(data, row);
                return checkbox;
            },
            "targets": [0]
        };

        var config = [];
        var renders = [];
        renders.push(user_code_render);
        renders.push(user_name_render);
        renders.push(user_phone_number_render);
        renders.push(checkbox_render);
        config['colums'] = ["id","code", "name", "phone_number"];
        config['url'] = "/discount/load_list_user";
        config['id'] = "users-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [0];
        config['hidden_global_seach'] = true;
        setAjaxDataTable(config);
    });
    function render_checkbox(data, row){
        return "<div class='text-center'><label> <input type='checkbox' user_id='"+data+"' class='user_select'></label></div>";
    }
    function render_common(data) {
        return "<div class='text-center'>" + data + "</div>";
    }
    function render_user_code(data) {
        return "<div class='text-center user_code'>" + data + "</div>";
    }
    function render_user_name(data) {
        return "<div class='text-center user_name'>" + data + "</div>";
    }
    function render_user_phone_number(data) {
        return "<div class='text-center user_phone_number'>" + ((data == null) ? "N/A" :data) + "</div>";
    }
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
    function submitEvent(){
        var users = [];
        for(var i = 0; i< mydata.length; i ++){
            users.push(parseInt(mydata[i].id));
        }
        $("#list_users").val(JSON.stringify(users));
        $("#create-discount-form").submit();

    }

    function checkBoxAll(selector){
        if($(selector).is(':checked')){
            $(".user_select").each(function(){
                $(this).prop( "checked", true );
            });
        }else{
            $(".user_select").each(function(){
                $(this).prop( "checked", false );
            });
        }

    }
    var mydata = [];
    function addCustomers(){
        $(".user_select").each(function(){
            if($(this).is(':checked')){
                var user_id = $(this).attr("user_id");
                var user_code = $(this).closest("tr").find('td:eq(1)').find(".user_code").html()
                var user_name = $(this).closest("tr").find('td:eq(2)').find(".user_name").html()
                var user_phone_number = $(this).closest("tr").find('td:eq(3)').find(".user_phone_number").html()
                var ok = 1;
                for(var i = 0; i < mydata.length; i ++){
                    if(parseInt(mydata[i].id) == parseInt(user_id)){
                        ok = 0;
                    }
                }
                if(ok == 1){
                    mydata.push({
                        id:user_id ,
                        name:user_name,
                        code: user_code,
                        phone_number: user_phone_number,
                        function:"<a href='javascript:void(0)' onclick='removeCustomer("+user_id+")'><i class='fa fa-minus-circle' ></i></a>"
                    });
                }
            }
        });
        $("#table_list_1").jqGrid('clearGridData')
                .jqGrid('setGridParam', { data: mydata })
                .trigger('reloadGrid');
    }

    function removeCustomer(id){
        for (var i = 0; i < mydata.length; i ++){
            if(parseInt(mydata[i].id) == id){
                mydata.splice(i,1);
            }
        }
        $("#table_list_1").jqGrid('clearGridData')
                .jqGrid('setGridParam', { data: mydata })
                .trigger('reloadGrid');
    }
</script>
@endsection


