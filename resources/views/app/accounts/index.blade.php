@extends('app.accounts.account')
@section('account')
    <link href="{{ asset("theme/css/plugins/jqGrid/ui.jqgrid.css")}}" rel="stylesheet">
    <script src="{{ asset("theme/js/plugins/bootbox/bootbox.js")}}"></script>
    <!-- jqGrid -->
    <script src="{{ asset("theme/js/plugins/jqGrid/i18n/grid.locale-en.js")}}"></script>
    <script src="{{ asset("theme/js/plugins/jqGrid/jquery.jqGrid.min.js")}}"></script>
<!-- tile -->
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
                    <table class="table table-striped table-bordered table-hover table-custom" id="accounts-list" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center"><label><input id="checkbox_all" onclick="checkBoxAll(this)" type="checkbox"></label></th>
                                <th class="text-center" width="4%">Mã người dùng</th>
                                <th class="text-center">Tên người dùng</th>
                                <th class="text-center">Tài khoản chính</th>
                                <th class="text-center">Tài khoản phụ</th>

                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center"></th>
                                <th class="text-center" width="4%">
                                    <input class="text-center" name="code" value="" placeholder="Mã người dùng" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="name" value="" placeholder="Tên người dùng" />
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <button data-toggle="modal" class="btn btn-primary " onclick="addCustomers()"><i
                            class="fa fa-plus" aria-hidden="true" ></i> Thêm khách hàng
                </button>
            </div>

            <div class="ibox-content">
                <div class="jqGrid_wrapper">
                    <table id="table_list_1"></table>
                    <div id="pager_list_1"></div>
                </div>

            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Chi tiết giao dịch</h5>
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
                    <form class="form-horizontal" method="POST" action="{{url('admin/transaction/putTransaction')}}"
                          name="create-shipper-form" role="form" id="create-transaction-form" data-parsley-validate>
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('account_type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Loại tài khoản</label>
                            <div class="col-sm-10">
                                <select id="vehicle_type_id" name="account_type" class="form-control" required>
                                    <option value="1">Tài khoản chính</option>
                                    <option value="2">Tài khoản phụ</option>
                                </select>
                            </div>
                        </div>
                        <hr class="line-dashed line-full"/>
                        <div class="form-group{{ $errors->has('transaction_type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Loại giao dịch</label>
                            <div class="col-sm-10">
                                <select id="vehicle_type_id" name="transaction_type" class="form-control" required>
                                    <option value="1">Cộng tiền vào tài khoản</option>
                                    <option value="2">Trừ tiền tài khoản</option>
                                </select>
                            </div>
                        </div>
                        <hr class="line-dashed line-full"/>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Số tiền (Vnđ)</label>
                            <div class="col-md-10">
                                <input type="text" name="amount" class="form-control"
                                       placeholder="Số tiền giao dịch (vnd)" value="{{ old('note') }}"
                                       required>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr class="line-dashed line-full"/>
                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Ghi chú</label>
                            <div class="col-md-10">
                                <textarea type="text" name="note" class="form-control"
                                       placeholder="Ghi chú" value="{{ old('note') }}"
                                       required ></textarea>

                            </div>
                        </div>
                        <input type="hidden" name="transaction_customers" id="transaction_customers">
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <span class="btn btn-primary pull-right" onclick="submitEvent()">Chấp nhận</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script >
    function submitEvent(){
        var users = [];
        for(var i = 0; i< mydata.length; i ++){
            users.push(parseInt(mydata[i].id));
        }
        $("#transaction_customers").val(JSON.stringify(users));
        $("#create-transaction-form").submit();

    }

    function checkBoxAll(selector){
        if($(selector).is(':checked')){
            $(".customer_select").each(function(){
                $(this).prop( "checked", true );
            });
        }else{
            $(".customer_select").each(function(){
                $(this).prop( "checked", false );
            });
        }

    }
    var mydata = [];
    function addCustomers(){
        $(".customer_select").each(function(){
            if($(this).is(':checked')){
                var user_id = $(this).attr("user_id");
                var user_code = $(this).closest("tr").find('td:eq(1)').find(".user_code").html()
                var user_name = $(this).closest("tr").find('td:eq(2)').find(".user_name").html()
                var user_main_account = $(this).closest("tr").find('td:eq(3)').find(".user_main_account").html()
                var user_second_account = $(this).closest("tr").find('td:eq(4)').find(".user_second_account").html()
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
                        user_code: user_code,
                        main: user_main_account,
                        second: user_second_account,
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
    $(document).ready(function () {
        $("#table_list_1").jqGrid({
            data: mydata,
            datatype: "local",
            height: 250,
            autowidth: true,
            shrinkToFit: true,
            rowNum: 14,
            trigger:'reloadGrid',
            rowList: [10, 20, 30],
            colNames: ['Mã KH', 'Tên', 'TK Chính', 'TK Phụ', "Xóa"],
            colModel: [
                {name: 'user_code', index: 'user_code', width: 60,align: "center"},
                {name: 'name', index: 'name', width: 90,align: "center"},
                {name: 'main', index: 'main', align: "center",width: 100},
                {name: 'second', index: 'second', width: 80, align: "center"},
                {name: 'function', index: 'function', width: 80, align: "center"},
            ],
            pager: "#pager_list_1",
            viewrecords: true,
            caption: "Danh sách khách hàng giao dịch",
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

        var user_main_account_render = {
            "render": function (data, type, row) {
                return render_user_main_account(data);
            },
            "targets": [3]
        };

        var user_second_account_render = {
            "render": function (data, type, row) {
                return render_user_second_account(data);
            },
            "targets": [4]
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
        renders.push(user_main_account_render);
        renders.push(user_second_account_render);
        renders.push(checkbox_render);
        config['colums'] = ["id","code", "name", "main", "second"];
        config['url'] = "/account/load_list";
        config['id'] = "accounts-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [0];
        config['hidden_global_seach'] = true;
        setAjaxDataTable(config);
    });
    function render_checkbox(data, row){
        return "<div class='text-center'><label> <input type='checkbox' user_id='"+data+"' class='customer_select'></label></div>";
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
    function render_user_main_account(data) {
        return "<div class='text-center user_main_account'>" + ((data == null) ? 0 :data) + " vnd</div>";
    }
    function render_user_second_account(data) {
        return "<div class='text-center user_second_account'>" + ((data == null) ? 0 :data) + " vnd</div>";
    }

    function render_money(data) {
        if (data == null) data = "0"
        return "<div class='text-center'>" + data + " đ</div>";
    }

</script>
@endsection
