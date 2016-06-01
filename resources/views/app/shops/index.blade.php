@extends('app.shops.shop')
@section('shop')
    <link href="{{ asset("theme/css/plugins/dataTables/datatables.min.css") }}" rel="stylesheet">
    <script src="{{ asset("theme/js/plugins/datatables/dataTables.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/dataTables.bootstrap.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/Pagination/input.js") }}"></script>

    <script src="{{ asset("js/datatable.ajax.js") }}"></script>
    <script src="{{ asset("js/constants.js") }}"></script>
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
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="shops-list">
                            <thead>
                            <tr>
                                <th class="text-center">Mã KH</th>
                                <th class="text-center">Họ và tên</th>
                                <th class="text-center">Tên cửa hàng</th>
                                <th class="text-center">Số điện thoại</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">CMT</th>
                                <th class="text-center">Tổng số đơn hàng</th>
                                <th class="text-center">Tổng số cửa hàng</th>
                                <th class="text-center">Đ/c cửa hàng</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

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
                "targets": [0, 1, 2, 3, 4, 5, 6, 7]
            };
            
            var office_address_render = {
                "render": function (data, type, row) {
                    return "<div class='text-center'>" + row.office_number + ", " + row.office_ward + ", " + row.office_district + ", " + row.office_city + "</div>";

                },
                "targets": [8]
            };

            var function_render = {
                "render": function (data, type, row) {
                    return render_function(data);
                },
                "targets": [9]
            };

            var data = {};
            var renders = [];
            renders.push(common_render);
            renders.push(function_render);
            renders.push(office_address_render);
            data.colums = ["shop_code", "name", "shop_name", "phone_number",  "email", "identity_card", "count_order", "count_agency", "office_city", "id"];
            data.url = "/shop/load_list";
            data.id = "shops-list";
            data.renders = renders;
            setDatatable(data);
        });

        function render_common(data) {
            return "<div class='text-center'>" + data + "</div>";
        }

        function render_function(data) {
            var edit_url = base_url + "/shop/" + data + "/edit";
            var delete_url = base_url + "/shop/" + data + "/delete";
            return "<div class='text-center'>" +
                    "<a class='btn btn-primary' href='" + edit_url + "' style='width: 70px;'>Sửa</a>" +
                    "<a class='btn btn-danger' disabled href='" + delete_url + "' style='width: 70px; margin-left: 10px;'>Xóa</a>" +
                    "</div>";
        }
    </script>
@endsection


