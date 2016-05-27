@extends('app.shippers.shipper')
@section('shipper')
<section class="tile">
    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>Danh sách tài xế</strong></h1>
        <ul class="controls">
            <!--<li><a href="{{url( '/shipper/create' )}}"><i class="fa fa-plus mr-5"></i> Thêm tài xế</a></li>-->
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
            <table class="table table-striped table-hover table-custom" id="shippers-notable-list" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">Mã tài xế</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center">Số điện thoại</th>
                        <th class="text-center">Số lượt chuyển hàng</th>
                        <th class="text-center">Chức năng</th>
                    </tr>
                    <tr class="table-header-search">
                        <th class="text-center" width="4%">
                            <input class="text-center" name="code" value="" placeholder="Mã TX" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="name" value="" placeholder="Họ và tên" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="identity_card" value="" placeholder="CMT" />
                        </th>
                        <th></th>
                        <th class="text-center clear-filter"></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</section>
<script>
    var notable_shipper_table;
    function notable_shipper(shipper_id, shop_id, notable) {
        var string = [shipper_id, shop_id, notable].join("/");
        $.ajax({
            url: base_url + "/shipper/" + string + "/notable_shipper",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                notable_shipper_table.draw();
            }
        });
    }
    $(document).ready(function () {
        function render_common(data) {
            return "<div class='text-center'>" + data + "</div>";
        }

        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1, 2, 3]
        };

        var function_render = {
            "render": function (data, type, row) {
                var html = "<div class='text-center'>";
                html += "<button class='btn btn-primary btn-sm btn-function' onclick='notable_shipper(" + row.shipper_id + "," + row.shop_id + "," + NOTABLE_SHIPPER_LIKE + ")'>Thích</button>";
                html += "<button class='btn btn-danger btn-sm btn-function' onclick='notable_shipper(" + row.shipper_id + "," + row.shop_id + "," + NOTABLE_SHIPPER_BLOCK + ")'>Khóa</button>"
                "</div>";
                return html;
            },
            "targets": [4]
        };

        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(function_render);
        config['colums'] = ["code", "name", "phone_number", "ship_number", "shipper_id", "shop_id", "type"];
        config['url'] = "/shipper/load_notable_list";
        config['id'] = "shippers-notable-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [4];
        config['hidden_global_seach'] = true;
        config['columns_length'] = 5;
        config['createdRow'] = function (row, data, index) {
            if (data.type != null) {
                if (data.type == 1) {
                    $(row).addClass("success");
                } else {
                    $(row).addClass("danger");
                }
            }
        }
        notable_shipper_table = setAjaxDataTable(config);
    });
</script>
@endsection