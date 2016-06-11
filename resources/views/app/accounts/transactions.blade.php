@extends('app.accounts.account')
@section('account')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách giao dịch</h5>
                    <div class="ibox-tools">
                        <a href="{{url( '/admin/transaction/create' )}}" class="btn btn-primary"><i class="fa fa-plus mr-5"></i> Tạo giao dịch</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-custom" id="transaction-list"
                               style="width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center">Mã GD</th>
                                <th class="text-center">Số tiền</th>
                                <th class="text-center">Loại GD</th>
                                <th class="text-center">Loại TK</th>
                                <th class="text-center">Số đối tượng</th>
                                <th class="text-center">Tổng số tiền</th>
                                <th class="text-center">Ghi chú</th>
                                <th class="text-center">Người thực hiện</th>
                                <th class="text-center">Ngày giờ</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th><input type="email" style="max-width: 100px;" placeholder="Mã GD" class="form-control"></th>
                                <th><input type="email" style="max-width: 80px;"  placeholder="Số tiền" class="form-control"></th>
                                <th><select class="form-control m-b" name="account">
                                        <option value="">-Tất cả-</option>
                                        <option value="1">Cộng tiền</option>
                                        <option value="2">Trừ tiền</option>
                                    </select>
                                </th>
                                <th><select class="form-control m-b" name="account">
                                        <option value="">-Tất cả-</option>
                                        <option value="1">TK Chính</option>
                                        <option value="2">TK Phụ</option>
                                    </select></th>
                                <th><input type="email" style="max-width: 80px;" placeholder="Tổng số" class="form-control"></th>
                                <th><input type="email" style="max-width: 100px;" placeholder="Tổng tiền" class="form-control"></th>
                                <th><input type="email" style="max-width: 100px;" placeholder="Ghi chú" class="form-control"></th>
                                <th><input type="email" style="max-width: 100px;" placeholder="Tên" class="form-control"></th>
                                <th><input type="email" style="max-width: 100px;" placeholder="Thời gian" class="form-control"></th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            var common_render = {
                "render": function (data, type, row) {
                    return render_common(data);
                },
                "targets": [0,1,4,6,7,8]
            };

            var transaction_type_render = {
                "render": function (data, type, row) {
                    return render_transaction_type(data);
                },
                "targets": [2]
            };

            var account_type_render = {
                "render": function (data, type, row) {
                    return render_account_type(data);
                },
                "targets": [3]
            };

            var total_amount_render = {
                "render": function (data, type, row) {
                    return render_total_amount(data, row);
                },
                "targets": [5]
            };

            var function_render = {
                "render": function (data, type, row) {
                    return render_function(data, row);
                },
                "targets": [9]
            };


            var config = [];
            var renders = [];
            renders.push(common_render);
            renders.push(transaction_type_render);
            renders.push(account_type_render);
            renders.push(total_amount_render);
            renders.push(function_render);
            config['colums'] = ["code", "amount", "transaction_type", "account_type", "total_user", "total_user","note",
                "creator_name","transaction_date", "id"];
            config['url'] = "/admin/transaction/loadTransactionHistories";
            config['id'] = "transaction-list";
            config['data_array'] = renders;
            config['clear_filter'] = true;
            config['sort_off'] = [8];
            config['hidden_global_seach'] = true;
            setAjaxDataTable(config);
        });

        function render_common(data) {
            return "<div class='text-center'>" + data + "</div>";
        }

        function render_transaction_type(data){
            return "<div class='text-center'>" + (parseInt(data) == 1 ? "Cộng tiền ":"Trừ tiền") + "</div>";
        }

        function render_account_type(data){
            return "<div class='text-center'>" + (parseInt(data) == 1 ? "Tài khoản chính":"Tài khoản phụ") + "</div>";
        }

        function render_total_amount(data, row){
            return "<div class='text-center'>" + (parseInt(row.total_user) * parseInt(row.amount)) + "</div>";
        }

        function render_function(data, row){
            return "<div class='text-center'><a class='btn btn-primary' href='/admin/transaction/detail/"+row.id+"'>Chi tiết</a></div>";
        }


    </script>
@endsection
