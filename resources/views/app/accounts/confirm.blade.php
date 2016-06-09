@extends('app.accounts.account')
@section('account')
{{--    <link href="{{ asset("theme/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css")}}" rel="stylesheet">--}}
    <link href="{{ asset("theme/css/plugins/jqGrid/ui.jqgrid.css")}}" rel="stylesheet">
{{--    <link href="{{ asset("theme/css/style.css")}}" rel="stylesheet">--}}
    <script src="{{ asset("theme/js/plugins/bootbox/bootbox.js")}}"></script>
    <script src="{{ asset("theme/js/plugins/peity/jquery.peity.min.js")}}"></script>
    <!-- jqGrid -->
    <script src="{{ asset("theme/js/plugins/jqGrid/i18n/grid.locale-en.js")}}"></script>
    <script src="{{ asset("theme/js/plugins/jqGrid/jquery.jqGrid.min.js")}}"></script>


<!-- tile -->
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content p-xl">
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong>Thực hiện giao dịch</strong><br>
                            {{$admin->name}}<br>
                            {{$admin->email}}<br>
                            <abbr title="Phone">Phone:</abbr> {{$admin->phone_number}}
                        </address>
                    </div>

                    <div class="col-sm-6 text-right">
                        <h4>Giao dịch số.</h4>
                        <h4 class="text-navy">{{$transaction_code}}</h4>
                        <p>
                            <span><strong>Ngày giờ giao dịch:</strong> {{$transaction_date}}</span><br/>
                        </p>
                    </div>
                </div>

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
                        <form class="form-horizontal"data-parsley-validate>
                            {!! csrf_field() !!}

                            <div class="form-group"><label class="col-lg-2 control-label">Loại tài khoản</label>
                                <div class="col-lg-10">
                                    <p class="form-control-static">
                                        @if($account_type == ACCOUNT_TYPE_MAIN)
                                            Tài khoản chính
                                        @elseif($account_type == ACCOUNT_TYPE_SECOND)
                                            Tài khoản phụ
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group"><label class="col-lg-2 control-label">Loại giao dịch</label>
                                <div class="col-lg-10"><p class="form-control-static">
                                        @if($transaction_type == TRANSACTION_TYPE_ADD)
                                            Cộng tiền vào tài khoản
                                        @elseif($transaction_type == TRANSACTION_TYPE_SUB)
                                            Trừ tiền tài khoản
                                        @endif
                                    </p></div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group"><label class="col-lg-2 control-label">Số tiền (vnd)</label>
                                <div class="col-lg-10"><p class="form-control-static">
                                        {{$amount}} vnd
                                    </p></div>
                            </div>
                            <hr class="line-dashed line-full"/>
                            <div class="form-group"><label class="col-lg-2 control-label">Ghi chú</label>
                                <div class="col-lg-10"><p class="form-control-static">{{$note}}</p></div>
                            </div>
                        </form>
                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Tổng số khách hàng :</strong></td>
                            <td>{{$total_user}}</td>
                        </tr>

                        <tr>
                            <td><strong>Tổng số tiền giao dịch :</strong></td>
                            <td>{{$total_amount}} vnd</td>
                        </tr>
                        </tbody>
                    </table>
                        <div class="text-right">
                            <a class="btn btn-danger" href="{{url('/admin/transaction/cancelTransaction')}}"><i class="fa fa-dollar"></i> Hủy giao dịch</a>
                            <a class="btn btn-primary" href="{{url('/admin/transaction/handleTransaction')}}"><i class="fa fa-dollar"></i> Thực hiện giao dịch</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script >

    $(document).ready(function () {
        // Examle data for jqGrid
        // Configuration for jqGrid Example 1
        $("#table_list_1").jqGrid({
            url: "/admin/transaction/getTransactionUsers",
            datatype: "json",
            height: 250,
            autowidth: true,
            shrinkToFit: true,
            rowNum: 14,
            rowList: [10, 20, 30],
            colNames: ['Mã KH', 'Tên', 'TK Chính', 'TK Phụ'],
            colModel: [
                {name: 'code', index: 'id', width: 60, align: "center", sorttype: "int"},
                {name: 'name', index: 'invdate', align: "center", width: 90},
                {name: 'main', index: 'name', align: "center",width: 100},
                {name: 'second', index: 'amount', width: 80, align: "center"},
            ],
            pager: "#pager_list_1",
            viewrecords: true,
            caption: "Danh sách khách hàng",
            hidegrid: false
        });
    });

</script>
@endsection
