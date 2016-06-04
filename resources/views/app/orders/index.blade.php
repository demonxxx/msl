@extends('app.orders.order')
@section('order')
<!-- tile -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách đơn hàng</h5>
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
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="orders-list" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Mã ĐH</th>
                                <th class="text-center" width="10%">Mã khách hàng</th>
                                <th class="text-center" width="10%">Mã tài xế</th>
                                <th class="text-center" width="10%">Phố đi</th>
                                <th class="text-center" width="10%">Quận đi</th>
                                <th class="text-center" width="10%">Phố đến</th>
                                <th class="text-center" width="10%">Quận đến</th>
                                <th class="text-center" width="10%">Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center" width="4%">
                                    <input class="text-center" name="code" value="" placeholder="Mã ĐH" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="shop_code" value="" placeholder="Mã khách hàng" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="shipper_code" value="" placeholder="Mã tài xế" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="street_from" value="" placeholder="Phố đi" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="district_from" value="" placeholder="Quận đi" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="street_to" value="" placeholder="Phố đến" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="district_to" value="" placeholder="Quận đến" />
                                </th>
                                <th class="text-center clear-filter"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script >
    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1, 2, 3, 4, 5, 6]
        };

        var function_render = {
            "render": function (data, type, row) {
                return render_function(data);
            },
            "targets": [7]
        };

        function render_common(data) {
            return "<div class='text-center' style='vertical-align: middle;'>" + data + "</div>";
        }

        function render_function(data) {
            var edit_url = base_url + "/order/" + data + "/edit";
            return "<div class='text-center'>" +
                    "<a class='btn btn-primary' disabled href='" + edit_url + "' style='width: 70px;'>Sửa</a>" +
                    "<a class='btn btn-danger' disabled style='width: 70px; margin-left: 10px;'>Xóa</a>" +
                    "</div>";
        }

        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(function_render);
        config['colums'] = ["code", "shop_code", "shipper_code", "street_from_name", "district_from_name", "street_to_name", "district_to_name", "id"];
        config['url'] = "/order/load_list";
        config['id'] = "orders-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [7];
        config['hidden_global_seach'] = true;
        setAjaxDataTable(config);
    });

</script>
@endsection


