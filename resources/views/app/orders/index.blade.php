@extends('app.orders.order')
@section('order')
<!-- tile -->
<section class="tile">
    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>Danh sách đơn hàng</strong></h1>
        <ul class="controls">
            <li><a href="{{url( '/order/create' )}}"><i class="fa fa-plus mr-5"></i> Thêm đơn hàng</a></li>
            <li class="dropdown">
                <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">Công cụ <i class="fa fa-angle-down ml-5"></i></a>
                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                    <li>
                        <a href>Xuất file XLS</a>
                    </li>
                    <li>
                        <a href>Xuất file CSV</a>
                    </li>
                    <li>
                        <a href>Xuất file XML</a>
                    </li>
                    <li role="presentation" class="divider"></li>
                    <li>
                        <a href>In hóa đơn</a>
                    </li>
                </ul>
            </li>
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

        <div class="table-responsive">
            <table class="table table-striped table-hover table-custom" id="orders-list" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">Mã ĐH</th>
                        <th class="text-center">Tên đơn hàng</th>
                        <th class="text-center">Tên người nhận</th>
                        <th class="text-center">SĐT người nhận</th>
                        <th class="text-center">Phường/xã Từ</th>
                        <th class="text-center">Quận/huyện Từ</th>
                        <th class="text-center">Phường/xã Đến</th>
                        <th class="text-center">Quận/huyện Đến</th>
                        <th class="text-center">Chức năng</th>
                    </tr>
                    <tr class="table-header-search">
                        <th class="text-center" width="4%">
                            <input class="text-center" name="code" value="" placeholder="Mã ĐH" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="name" value="" placeholder="Tên đơn hàng" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="recipient_name" value="" placeholder="Tên người nhận" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="recipient_phone" value="" placeholder="SĐT người nhận" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="ward_from" value="" placeholder="Phường/xã Từ" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="district_from" value="" placeholder="Quận/huyện Từ" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="ward_to" value="" placeholder="Phường/xã Đến" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="district_to" value="" placeholder="Quận/huyện Đến" />
                        </th>
                        <th class="text-center clear-filter"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- /tile body -->
</section>
<!-- /tile -->

<script >
    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1, 2, 3, 4, 5, 6, 7]
        };

        var function_render = {
            "render": function (data, type, row) {
                return render_function(data);
            },
            "targets": [8]
        };

        function render_common(data) {
            return "<div class='text-center'>" + data + "</div>";
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
        config['colums'] = ["code", "name", "recipient_name", "recipient_phone", "ward_from", "district_from", "ward_to", "district_to", "id"];
        config['url'] = "/order/load_list";
        config['id'] = "orders-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [8];
        config['hidden_global_seach'] = true;
        setAjaxDataTable(config);
    });

</script>
@endsection


