@extends('templates.admin')
@section('content')
<link href="{{ asset("theme/css/plugins/dataTables/datatables.min.css") }}" rel="stylesheet">
<script src="{{ asset("theme/js/plugins/datatables/dataTables.min.js") }}"></script>
<script src="{{ asset("theme/js/plugins/datatables/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("theme/js/plugins/datatables/extensions/dataTables.bootstrap.js") }}"></script>
<script src="{{ asset("theme/js/plugins/datatables/extensions/Pagination/input.js") }}"></script>

<script src="{{ asset("js/datatable.ajax.js") }}"></script>
<script src="{{ asset("js/constants.js") }}"></script>
<!-- tile header -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Bảng tài xế</h5>
                <div class="ibox-tools">
                    <a href="{{url( '/distance_freights/create' )}}" class="btn btn-default"><i class="fa fa-plus mr-5"></i> Thêm gói cước</a>
                </div>
            </div>
            <div class="ibox-content">
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