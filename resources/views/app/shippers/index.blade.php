@extends('app.shippers.shipper')
@section('shipper')
<!-- tile -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách tài xế</h5>
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
                    <table class="table table-striped table-bordered table-hover" id="shippers-list" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">Mã TX</th>
                                <th class="text-center">Họ và tên</th>
                                <th class="text-center">CMT</th>
                                <th class="text-center">Quận/huyện</th>
                                <th class="text-center">SĐT</th>
                                <th class="text-center" width="10%">Đánh giá</th>
                                <th class="text-center" width="15%">Tổng đơn hàng</th>
                                <th class="text-center" width="15%">Tình trạng hồ sơ</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="code" value="" placeholder="Mã TX" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="name" value="" placeholder="Họ và tên" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="identity_card" value="" placeholder="CMT" />
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" name="home_district" value="" placeholder="Quận/huyện" />-->
                                    <select>
                                        <option value="">Tất cả</option>
                                        @foreach($districts AS $district)
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="phone_number" value="" placeholder="SĐT" />
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" name="average_score" value="" placeholder="Đánh giá" />-->
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" name="count_order" value="" placeholder="Tổng đơn hàng" />-->
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" name="profile_status" value="" placeholder="Tình trạng hồ sơ" />-->
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
    var shipperTable;
    var blockShipperFunction = function (id, name, message) {
        name = (name !== null) ? name : "";
        swal({
            title: "Bạn có chắc muốn " + message + " shipper " + name + "?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Chắc chắn!",
            cancelButtonText: "Hủy",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: base_url + "/shipper/" + id + "/update_isActive",
                type: 'GET',
                success: function (data, textStatus, jqXHR) {
                    if (data) {
                        swal("Thành công!", "Đã thay đổi trạng thái", "success");
                    } else {
                        swal("Không thành công!", "Không thay đổi trạng thái", "error");
                    }
                    shipperTable.draw();
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Không thành công!", "Không thay đổi trạng thái", "error");
                }
            });
        });
    };
    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1, 2, 3, 4, 5]
        };
        var order_render = {
            "render": function (data, type, row) {
                var html = "<div class='text-center'>";
                html += "<p>Tổng: " + data;
                html += " - Thành công: " + row.payed_ship_success;
                html += " - Thất bại: " + row.return_returning_cancel + "</p>";
                html += "</div>";
                return html;
            },
            "targets": [6]
        };
        var profile_render = {
            "render": function (data, type, row) {
                data = (data == null) ? "0" : data;
                return "<div class='text-center'>" + data + "%</div>";
            },
            "targets": [7]
        };

        var function_render = {
            "render": function (data, type, row) {
                return render_function(data, type, row);
            },
            "targets": [8]
        };

        function render_common(data) {
            data = (data == null) ? "" : data;
            return "<div class='text-center'>" + data + "</div>";
        }

        function render_function(data, type, row) {
            var edit_url = base_url + "/shipper/" + data + "/edit";
            var text = (row.isActive == 2) ? "Mở" : "Khóa";
            return "<div class='text-center'>" +
                    "<a class='btn btn-primary btn-sm' href='" + edit_url + "'>Sửa</a>" +
                    "<button class='btn btn-danger btn-sm' style='margin-left: 10px;' onclick='blockShipperFunction(" + row.shipper_id + ",\"" + row.name + "\",\"" + text + "\")'>" + text + "</button>" +
                    "</div>";
        }

        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(profile_render);
        renders.push(order_render);
        renders.push(function_render);
        config['colums'] = ["code", "name", "identity_card", "home_district", "phone_number", "average_score", "count_order", "profile_status", "id"];
        config['url'] = "/shipper/load_list";
        config['id'] = "shippers-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [8];
        config['hidden_global_seach'] = true;
        config['fnRowCallback'] = function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var rowClass = (aData.isActive == 2) ? "danger" : "";
            $(nRow).addClass(rowClass);
//            $('td', nRow).eq(0).find('div').addClass('text-info').bind("click", function (e) {
//                getShopDetails($(this).attr("shop-id"));
//            });
        };
        shipperTable = setAjaxDataTable(config);
    });
</script>
@endsection


