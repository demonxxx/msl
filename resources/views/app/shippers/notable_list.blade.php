@extends('app.shippers.shipper')
@section('shipper')
<link href="{{ asset("theme/css/plugins/dataTables/datatables.min.css") }}" rel="stylesheet">
<script src="{{ asset("theme/js/plugins/datatables/dataTables.min.js") }}"></script>
<script src="{{ asset("theme/js/plugins/datatables/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("theme/js/plugins/datatables/extensions/dataTables.bootstrap.js") }}"></script>
<script src="{{ asset("theme/js/plugins/datatables/extensions/Pagination/input.js") }}"></script>

<script src="{{ asset("js/datatable.ajax.js") }}"></script>
<script src="{{ asset("js/constants.js") }}"></script>
<!-- tile header -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Bảng tài xế</h5>
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
        </div>
    </div>
</div>
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
            html += "<button style='margin-right:5px;' class='btn btn-primary btn-sm btn-function' onclick='notable_shipper(" + row.shipper_id + "," + row.shop_id + "," + NOTABLE_SHIPPER_LIKE + ")'>Thích</button>";
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