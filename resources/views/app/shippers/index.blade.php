@extends('app.shippers.shipper')
@section('shipper')
    <link href="{{ asset("theme/css/plugins/dataTables/datatables.min.css") }}" rel="stylesheet">
    <script src="{{ asset("theme/js/plugins/datatables/dataTables.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/dataTables.bootstrap.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/Pagination/input.js") }}"></script>

    <script src="{{ asset("js/datatable.ajax.js") }}"></script>
    <script src="{{ asset("js/constants.js") }}"></script>
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
                        <table class="table table-striped table-bordered table-hover" id="shippers-list" style="width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="4%">Mã TX</th>
                                <th class="text-center">Họ và tên</th>
                                <th class="text-center">CMT</th>
                                <th class="text-center">Phường/xã</th>
                                <th class="text-center">Quận/huyện</th>
                                <th class="text-center">Thành phố</th>
                                <th class="text-center">SĐT</th>
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
                                <th class="text-center">
                                    <input class="text-center" name="home_ward" value="" placeholder="Phường/xã" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="home_district" value="" placeholder="Quận/huyện" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="home_city" value="" placeholder="Thành phố" />
                                </th>
                                <th class="text-center">
                                    <input class="text-center" name="phone_number" value="" placeholder="SĐT" />
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
            return "<div class='text-center'>" + data + "</div>";
        }

        function render_function(data) {
            var edit_url = base_url + "/shipper/" + data + "/edit";
            return "<div class='text-center'>" +
                    "<a class='btn btn-primary' href='" + edit_url + "' style='width: 70px;'>Sửa</a>" +
                    "<a class='btn btn-danger' style='width: 70px; margin-left: 10px;'>Xóa</a>" +
                    "</div>";
        }

        var config = [];
        var renders = [];
        renders.push(common_render);
        renders.push(function_render);
        config['colums'] = ["code", "name", "identity_card", "home_ward", "home_district", "home_city", "phone_number", "id"];
        config['url'] = "/shipper/load_list";
        config['id'] = "shippers-list";
        config['data_array'] = renders;
        config['clear_filter'] = true;
        config['sort_off'] = [6];
        config['hidden_global_seach'] = true;
        setAjaxDataTable(config);
    });
</script>
@endsection


