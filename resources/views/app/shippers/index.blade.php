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
                        <th class="text-center">Mã TX</th>
                        <th class="text-center">Họ và tên</th>
                        <th class="text-center">Email đăng nhập</th>
                        <th class="text-center">CMT</th>
                        <th class="text-center">Đ/c nhà</th>
                        <th class="text-center">SĐT</th>
                        <th class="text-center">Chức năng</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- /tile body -->
</section>
<!-- /tile -->
     
<script >
    $(document).ready(function(){
        var common_render = {
            "render": function (data, type, row) {
                return render_common(data);
            },
            "targets": [0, 1, 2, 3, 5]
        };

        var home_address_render = {
            "render": function (data, type, row) {
                return "<div class='text-center'>" + row.home_ward + ", " + row.home_district + ", " + row.home_city + "</div>";

            },
            "targets": [4]
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
        data.colums = ["code","name","email","identity_card","home_city","phone","id"];
        data.url = "/shipper/load_list";
        data.id = "shippers-list";
        data.renders = renders;
        setDatatable(data);
    });

    function render_common(data){
        return "<div class='text-center'>" + data + "</div>";
    }

    function render_function(data){
        var edit_url = base_url + "/shipper/" + data + "/edit";
        return "<div class='text-center'>"  +
                    "<a class='btn btn-primary' href='"+edit_url+"' style='width: 70px;'>Sửa</a>" +
                    "<a class='btn btn-danger' style='width: 70px; margin-left: 10px;'>Xóa</a>"+
                "</div>";
    }
</script>
@endsection


