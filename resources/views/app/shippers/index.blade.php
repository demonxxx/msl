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
$(document).ready(function () {
    var common_render = {
        "render": function (data, type, row) {
            return render_common(data);
        },
        "targets": [0, 1, 2, 3, 4, 5, 6]
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
            return render_function(data);
        },
        "targets": [8]
    };

    function render_common(data) {
        data = (data == null) ? "" : data;
        return "<div class='text-center'>" + data + "</div>";
    }

    function render_function(data) {
        var edit_url = base_url + "/shipper/" + data + "/edit";
        return "<div class='text-center'>" +
                "<a class='btn btn-primary btn-sm' href='" + edit_url + "'>Sửa</a>" +
                "<a class='btn btn-danger btn-sm' disabled style='margin-left: 10px;'>Xóa</a>" +
                "</div>";
    }

    var config = [];
    var renders = [];
    renders.push(common_render);
    renders.push(profile_render);
    renders.push(function_render);
    config['colums'] = ["code", "name", "identity_card", "home_district", "phone_number", "average_score", "count_order", "profile_status", "id"];
    config['url'] = "/shipper/load_list";
    config['id'] = "shippers-list";
    config['data_array'] = renders;
    config['clear_filter'] = true;
    config['sort_off'] = [8];
    config['hidden_global_seach'] = true;
    setAjaxDataTable(config);
});
</script>
@endsection


