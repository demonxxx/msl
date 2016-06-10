@extends('app.discounts.discount')
@section('discount')
<!-- tile -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách khuyến mại</h5>
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
                    <table class="table table-striped table-bordered table-hover" id="discounts-list" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">Mã</th>
                                <th class="text-center">Loại mã</th>
                                <th class="text-center">Tên mã</th>
                                <th class="text-center">Giá trị</th>
                                <th class="text-center" width="10%">Tổng số lượt dùng</th>
                                <th class="text-center" width="10%">Ngày bắt đầu</th>
                                <th class="text-center" width="10%">Ngày kết thúc</th>
                                <th class="text-center" width="15%">Ghi chú</th>
                                <th class="text-center" width="5%">Trạng thái</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="code" value="" placeholder="Mã" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="type" value="" placeholder="Loại mã" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="code_number" value="" placeholder="Tên mã" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="amount" value="" placeholder="Giá trị" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 150px;" name="total" value="" placeholder="Tổng số lượt dùng" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="start_time" value="" placeholder="Ngày bắt đầu" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="end_time" value="" placeholder="Ngày kết thúc" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="description" value="" placeholder="Ghi chú" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="status" value="" placeholder="Trạng thái" />
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
        "targets": [0, 2, 3, 4, 5, 6, 7]
    };
    var type_render = {
        "render": function (data, type, row) {
            if (data == "0") data = "Khuyến mại(%)";
            else if (data == "1") data = "Khuyến mại($)";
            else if (data == "2") data = "Quà tặng($)";
            return "<div class='text-center'>" + data + "</div>";
        },
        "targets": [1]
    };
    
    var status_render = {
        "render": function (data, type, row) {
            if (data == "0") data = "Khóa";
            else if (data == "1") data = "Kích hoạt";
            return "<div class='text-center'>" + data + "</div>";
        },
        "targets": [8]
    };
    
    var function_render = {
        "render": function (data, type, row) {
            var readonly = "";
            var show_url = base_url + "/discount/" + data + "/show";
            var lock_url = base_url + "/discount/" + data + "/lock";
            if (row.status == "0") {
                lock_url = "javascript:void(0)";
                readonly = "disabled";
            }
            return "<div class='text-center'>" +
                    "<a class='btn btn-primary btn-sm' href='" + show_url + "'>Xem</a>" +
                    "<a class='btn btn-danger btn-sm' " + readonly + " href='" + lock_url + "' style='margin-left: 10px;'>Khóa</a>" +
                    "</div>";
        },
        "targets": [9]
    };

    function render_common(data) {
        data = (data == null) ? "" : data;
        return "<div class='text-center'>" + data + "</div>";
    }

    var config = [];
    var renders = [];
    renders.push(common_render);
    renders.push(type_render);
    renders.push(status_render);
    renders.push(function_render);
    config['colums'] = ["code", "type", "code_number", "amount", "total", "start_time", "end_time", "description", "status", "id"];
    config['url'] = "/discount/load_list";
    config['id'] = "discounts-list";
    config['data_array'] = renders;
    config['clear_filter'] = true;
    config['sort_off'] = [9];
    config['hidden_global_seach'] = true;
    setAjaxDataTable(config);
});
</script>
@endsection


