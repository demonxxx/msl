@extends('app.shippers.shipper')
@section('shipper')
<!-- tile -->
<section class="tile">
    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>Danh sách tài xế</strong></h1>
        <ul class="controls">
            <li><a href="{{url( '/shipper/create' )}}"><i class="fa fa-plus mr-5"></i> Thêm tài xế</a></li>
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
            <table class="table table-striped table-hover table-custom" id="shippers-list">
                <thead>
                    <tr>
                        <th class="text-center" width="8%">Mã TX</th>
                        <th class="text-center">Họ và tên</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">CMT</th>
                        <th class="text-center">Đ/c nhà</th>
                        <th class="text-center">Phường/xã</th>
                        <th class="text-center">Quận/huyện</th>
                        <th class="text-center">Thành phố</th>
                        <th class="text-center">SĐT</th>
                        <th class="text-center">Chức năng</th>
                    </tr>
                    <tr class="table-header-search">
                        <th class="text-center">
                            <input class="text-center" name="code" value="" placeholder="Mã TX" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="name" value="" placeholder="Họ và tên" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="email" value="" placeholder="Email" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="identity_card" value="" placeholder="CMT" />
                        </th>
                        <th class="text-center">
                            <input class="text-center" name="home_number" value="" placeholder="Đ/c nhà" />
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
    <!-- /tile body -->
</section>
<!-- /tile -->

<script >
    $(document).ready(function () {
        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8]
        };

        var function_render = {
            "render": function (data, type, row) {
                return render_function(data);
            },
            "targets": [9]
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
        config['colums'] = ["code", "name", "email", "identity_card", "home_number", "home_ward", "home_district", "home_city", "phone_number", "id"];
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


