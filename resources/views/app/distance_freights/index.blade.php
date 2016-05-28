@extends('templates.admin')
@section('content')
<div class="page page-shop-products">
    <div class="pageheader">
        <h2>Bảng giá</h2>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html"><i class="fa fa-home"></i>MSL Việt Nam</a>
                </li>
                <li>
                    <a href="#">Bảng giá</a>
                </li>
                <li>
                    <a href="{{url( '/distance_freights/create' )}}">Danh sách</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- page content -->
    <div class="pagecontent">
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Bảng giá</strong></h1>
                        <ul class="controls">
                            <li><a href="{{url( '/distance_freights/create' )}}"><i class="fa fa-plus mr-5"></i> Thêm gói cước</a></li>
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
                            <table class="table table-striped table-hover table-custom" id="distance-freights-list">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tên gói cước</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Khoảng cách từ</th>
                                        <th class="text-center">Khoảng cách đến</th>
                                        <th class="text-center">Cước</th>
                                        <th class="text-center">Phương tiện</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($main_list AS $dist_freight)
                                    <tr>
                                        <td class="text-center">{{ $dist_freight->name }}</td>
                                        <td class="text-center">{{ $dist_freight->code }}</td>
                                        <td class="text-center">{{ $dist_freight->from }}</td>
                                        <td class="text-center">{{ $dist_freight->to }}</td>
                                        <td class="text-center">{{ $dist_freight->freight }}</td>
                                        <td class="text-center">{{ $dist_freight->vhc_name }}</td>
                                        <td class="text-center">
                                            <a href='{{url("distance_freights/$dist_freight->id/edit")}}' class="btn btn-primary btn-sm btn-function">Sửa</a>
                                            <button class="btn btn-danger btn-sm btn-function" onclick="deleteDistanceFreight('{{url("distance_freights/$dist_freight->id/destroy")}}')">Xóa</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /page content -->
</div>
<script>
    function deleteDistanceFreight(url) {
    var conf = confirm("Are you sure?");
    if (conf) {
    window.location.href = url;
    }
    }
    $(function () {
    $("#distance-freights-list").DataTable({
    "aoColumnDefs": [
    {'bSortable': false, 'aTargets': [6]}
    ]
    });
    });
</script>
@endsection