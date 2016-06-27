@extends('app.shops.shop')
@section('shop')
<style>
    .modal70 > .modal-dialog {
        width:70% !important;
    }
    .modal80 > .modal-dialog {
        width:80% !important;
    }
    .modal-body {
        padding: 10px 30px 0px 30px !important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách khách hàng</h5>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="shops-list">
                        <thead>
                            <tr>
                                <th class="text-center">Mã KH</th>
                                <th class="text-center">Họ và tên</th>
                                <th class="text-center">Tên cửa hàng</th>
                                <th class="text-center">Số điện thoại</th>
                                <th class="text-center">Tổng số<br />đơn hàng</th>
                                <th class="text-center">Tổng số<br />cửa hàng</th>
                                <th class="text-center">Quận/huyện</th>
                                <th class="text-center">Trạng thái<br />hồ sơ</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 50px;" name="code" value="" placeholder="Mã KH" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 90px;" name="name" value="" placeholder="Họ và tên" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="shop_name" value="" placeholder="Tên CH" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="phone_number" value="" placeholder="SĐT" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 90px;" name="" value="" placeholder="Đơn hàng" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 90px;" name="" value="" placeholder="Cửa hàng" />
                                </th>
                                <th class="text-center">
                                    <select>
                                        <option value="">Tất cả</option>
                                        @foreach($districts AS $district)
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 90px;" name="" value="" placeholder="TT hồ sơ" />
                                </th>
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
    var shopTable;
    var blockShopFunction = function (id, name, message) {
        name = (name != null) ? name : "";
        swal({
            title: "Bạn có chắc muốn " + message + " shop " + name + "?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Chắc chắn!",
            cancelButtonText: "Hủy",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: base_url + "/shop/" + id + "/update_isActive",
                type: 'GET',
                success: function (data, textStatus, jqXHR) {
                    if (data) {
                        swal("Thành công!", "Đã thay đổi trạng thái", "success");
                    } else {
                        swal("Không thành công!", "Không thay đổi trạng thái", "error");
                    }
                    shopTable.draw();
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Không thành công!", "Không thay đổi trạng thái", "error");
                }
            });
        });
    };

    var getShopDetails = function (shop_id) {
        $.ajax({
            url: base_url + "/shop/" + shop_id + "/details",
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                bootbox.dialog({
                    message: data.html,
                    title: "Thông tin chi tiết",
                    buttons: {
                        main: {
                            label: "Đóng",
                            className: "btn-primary",
                            callback: function () {

                            }
                        }
                    },
                    className: "modal70"
                });
            }, error: function (jqXHR, textStatus, errorThrown) {
                $.notify("Không thể lấy thông tin shop, kiểm tra lại!", "error");
            }
        });
    }


    var getOrders = function (shop_id, shop_name) {
        $.ajax({
            url: base_url + "/order/" + shop_id + "/show_list_order",
            type: 'GET',
            dataType: 'html',
            success: function (data, textStatus, jqXHR) {
                bootbox.dialog({
                    message: data,
                    title: "Lịch sử đơn hàng của khách hàng " + shop_name,
                    buttons: {
                        main: {
                            label: "Đóng",
                            className: "btn-primary",
                            callback: function () {

                            }
                        }
                    },
                    className: "modal80"
                });
            }, error: function (jqXHR, textStatus, errorThrown) {
                $.notify("Không thể lấy lịch sử đơn hàng, hãy thử lại!", "error");
            }
        });
    }

    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                data = (data !== null) ? data : "";
                return "<div class='text-center' shop-id='" + row.shop_id + "'>" + data + "</div>";
            },
            "targets": [0, 1, 2, 3, 4, 5, 6]
        };

        var profile_status_render = {
            "render": function (data, type, row) {
                return "<div class='text-center'>" + data + "%</div>";
            },
            "targets": [7]
        };
        var function_render = {
            "render": function (data, type, row) {
                var edit_url = base_url + "/shop/" + data + "/edit";
                var text = (row.isActive == 2) ? "Mở" : "Khóa";
                return "<div class='text-center'>" +
                        "<a class='btn btn-primary btn-sm' href='" + edit_url + "'>Sửa</a>" +
                        "<button class='btn btn-danger btn-sm' onclick='blockShopFunction(" + row.shop_id + ",\"" + row.shop_name + "\",\"" + text + "\")' style='margin-left: 10px;'>" + text + "</button>" +
                        "</div>";
            },
            "targets": [8]
        };

        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(profile_status_render);
        renders.push(function_render);
        config['colums'] = ["user_code", "name", "shop_name", "phone_number", "count_order", "count_agency", "office_district", "profile_status", "id"];
        config['url'] = "/shop/load_list";
        config['id'] = "shops-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [8];
        config['hidden_global_seach'] = true;
        config['fnRowCallback'] = function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var rowClass = (aData.isActive == 2) ? "danger" : "";
            $(nRow).addClass(rowClass);
            $('td', nRow).eq(0).find('div').addClass('text-info').hover(function () {
                $(this).css('cursor', 'pointer');
            }).bind("click", function (e) {
                getShopDetails($(this).attr("shop-id"));
            });
            $('td', nRow).eq(4).find('div').addClass('text-info').hover(function () {
                $(this).css('cursor', 'pointer');
            }).bind("click", function (e) {
                getOrders($(this).attr("shop-id"), aData.shop_name);
            });
        };
        shopTable = setAjaxDataTable(config);
    });
</script>
@endsection


