@extends('app.shops.shop')
@section('shop')
    <link href="{{ asset("theme/css/plugins/dataTables/datatables.min.css") }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{ asset("theme/js/plugins/datatables/css/jquery.dataTables.min.css") }}">--}}
    <script src="{{ asset("theme/js/plugins/datatables/dataTables.min.js") }}"></script>
{{--    <link rel="stylesheet" href="{{ asset("theme/js/plugins/datatables/datatables.bootstrap.min.css") }}">--}}
    <script src="{{ asset("theme/js/plugins/datatables/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/dataTables.bootstrap.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/Pagination/input.js") }}"></script>

    <script src="{{ asset("js/datatable.ajax.js") }}"></script>
    <script src="{{ asset("js/constants.js") }}"></script>

    {{--<section class="tile">--}}
    {{--<!-- tile header -->--}}

    {{--<!-- /tile header -->--}}
    {{--<!-- tile body -->--}}
    {{--<div class="tile-body">--}}

    {{--<div class="table-responsive">--}}
    {{--<table class="table table-striped table-hover table-custom" id="shops-list">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th class="text-center">Mã KH</th>--}}
    {{--<th class="text-center">Họ và tên</th>--}}
    {{--<th class="text-center">Email đăng nhập</th>--}}
    {{--<th class="text-center">CMT</th>--}}
    {{--<th class="text-center">Đ/c nhà</th>--}}
    {{--<th class="text-center">Đ/c văn phòng</th>--}}
    {{--<th class="text-center">Chức năng</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /tile body -->--}}
    {{--</section>--}}
    <!-- /tile -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Basic Data Tables example with responsive plugin</h5>
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
                                <th class="text-center">Email đăng nhập</th>
                                <th class="text-center">CMT</th>
                                <th class="text-center">Đ/c nhà</th>
                                <th class="text-center">Đ/c văn phòng</th>
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
                "targets": [0, 1, 2, 3]
            };

            var home_address_render = {
                "render": function (data, type, row) {
                    return "<div class='text-center'>" + row.home_number + ", " + row.home_ward + ", " + row.home_district + ", " + row.home_city + "</div>";

                },
                "targets": [4]
            };

            var office_address_render = {
                "render": function (data, type, row) {
                    return "<div class='text-center'>" + row.office_number + ", " + row.office_ward + ", " + row.office_district + ", " + row.office_city + "</div>";

                },
                "targets": [5]
            };

            var function_render = {
                "render": function (data, type, row) {
                    return render_function(data);
                },
                "targets": [6]
            };

            var data = {};
            var renders = [];
            renders.push(common_render);
            renders.push(home_address_render);
            renders.push(function_render);
            renders.push(office_address_render);
            data.colums = ["code", "name", "email", "identity_card", "home_city", "office_city", "id"];
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
                    "<a class='btn btn-danger' href='" + delete_url + "' style='width: 70px; margin-left: 10px;'>Xóa</a>" +
                    "</div>";
        }
    </script>
@endsection


