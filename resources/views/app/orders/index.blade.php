@extends('app.orders.order')
@section('order')
<!-- tile -->
<style>
    .modal90 > .modal-dialog {
        width:90% !important;
    }
    .modal-body {
        padding: 10px 30px 0px 30px !important;
    }
</style>
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
                                <th class="text-center" >Mã ĐH</th>
                                <th class="text-center" >Mã khách hàng</th>
                                <th class="text-center" >Mã tài xế</th>
                                <th class="text-center" >Phố đi</th>
                                <th class="text-center" >Quận đi</th>
                                <th class="text-center" >Phố đến</th>
                                <th class="text-center" >Quận đến</th>
                                <th class="text-center" >Trạng thái</th>
                                <th class="text-center" >Chức năng</th>
                            </tr>
                            <tr class="table-header-search">
                                <th class="text-center" >
                                    <input class="text-center" style="max-width: 100px;" name="code" value="" placeholder="Mã ĐH" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="shop_code" value="" placeholder="Mã khách hàng" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" style="max-width: 100px;" name="shipper_code" value="" placeholder="Mã tài xế" />
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" style="max-width: 100px;" name="street_from" value="" placeholder="Phố đi" />-->
                                    <select style="max-width: 100px;">
                                        <option value="">Phố đi</option>
                                        @foreach($wards as $wasd)
                                        <option value="{{$wasd->id}}">{{$wasd->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" style="max-width: 100px;" name="district_from" value="" placeholder="Quận đi" />-->
                                    <select style="max-width: 100px;">
                                        <option value="">Quận đi</option>
                                        @foreach($districts as $district)
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" style="max-width: 100px;" name="street_to" value="" placeholder="Phố đến" />-->
                                    <select style="max-width: 100px;">
                                        <option value="">Phố đến</option>
                                        @foreach($wards as $wasd)
                                        <option value="{{$wasd->id}}">{{$wasd->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" style="max-width: 100px;" name="district_to" value="" placeholder="Quận đến" />-->
                                    <select style="max-width: 100px;">
                                        <option value="">Quận đến</option>
                                        @foreach($districts as $district)
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-center">
                                    <!--<input class="text-center" style="max-width: 100px;" name="status" value="" placeholder="Trạng thái" />-->
                                    <select style="max-width: 100px;">
                                        <option value="">Trạng thái</option>
                                        <option value="1">Đang xử lý</option>
                                        <option value="2">Đã nhận đơn</option>
                                        <option value="3">Đã nhận hàng</option>
                                        <option value="4">Đang vận chuyển</option>
                                        <option value="5">Vận chuyển thành công</option>
                                        <option value="6">Đã thanh toán</option>
                                        <option value="7">Hủy đơn hàng</option>
                                        <option value="8">Đã trả hàng</option>
                                        <option value="9">Đang trả hàng</option>
                                    </select>
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
    function orderDetails(id) {
        $.ajax({
            url: base_url + "/order/" + id + "/details",
            type: "GET",
            dataType: 'html',
            success: function (data, textStatus, jqXHR) {
                bootbox.dialog({
                    message: data,
                    title: "Chi tiết đơn hàng",
                    buttons: {
                        main: {
                            label: "Đóng",
                            className: "btn-primary"
                        }
                    },
                    className: "modal90"
                });
            }, error: function (jqXHR, textStatus, errorThrown) {
                $.notify("Có lỗi, thử lại sau", "error");
            }
        });
    }
    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1, 2, 3, 4, 5, 6]
        };

        var status_render = {
            "render": function (data, type, row) {
                var status = '';
                switch (parseInt(data)) {
                    case 1:
                        status = 'Đang xử lý';
                        break;
                    case 2:
                        status = 'Đã nhận đơn';
                        break;
                    case 3:
                        status = 'Đã nhận hàng';
                        break;
                    case 4:
                        status = 'Đang vận chuyển';
                        break;
                    case 5:
                        status = 'Vận chuyển thành công';
                        break;
                    case 6:
                        status = 'Đã thanh toán';
                        break;
                    case 7:
                        status = 'Hủy đơn hàng';
                        break;
                    case 8:
                        status = 'Đã trả hàng';
                        break;
                    case 9:
                        status = 'Đang trả hàng';
                        break;
                    default:
                        status = 'Đang xử lý';
                }

                return "<div class='text-center'>" + status + "</div>";
            },
            "targets": [7]
        };
        var function_render = {
            "render": function (data, type, row) {
                return "<div class='text-center'><button class='btn btn-primary btn-sm' onclick='orderDetails(" + row.id + ")'>Chi tiết</button></div>";
            },
            "targets": [8]
        };

        function render_common(data) {
            return "<div class='text-center' style='vertical-align: middle;'>" + (data == null ? "-" : data) + "</div>";
        }

        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(status_render);
        renders.push(function_render);
        config['colums'] = ["code", "shop_code", "shipper_code", "street_from_name", "district_from_name", "street_to_name", "district_to_name", "status", "id"];
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


