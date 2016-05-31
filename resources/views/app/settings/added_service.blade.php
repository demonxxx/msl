@extends('templates.admin')
@section('content')
    @include('partials.flash')
    <link href="{{ asset("theme/css/plugins/dataTables/datatables.min.css") }}" rel="stylesheet">
    <script src="{{ asset("theme/js/plugins/datatables/dataTables.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/dataTables.bootstrap.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/datatables/extensions/Pagination/input.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/parsley/parsley.min.js") }}"></script>

    <script src="{{ asset("js/datatable.ajax.js") }}"></script>
    <script src="{{ asset("js/constants.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/ladda/spin.min.js") }}" ></script>
    <script src="{{ asset("theme/js/plugins/ladda/ladda.min.js") }}" ></script>
    <script src="{{ asset("theme/js/plugins/ladda/ladda.jquery.min.js") }}" ></script>
    @if (count($errors) > 0)
        {{--{{dd($errors)}}--}}
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Dịch vụ cộng thêm</h5>
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
                    <div class="">
                        <button data-toggle="modal" class="btn btn-primary " data-target="#addedServiceModal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm </button>
                    </div>
                    <div class="modal inmodal fade" id="addedServiceModal" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Dịch vụ cộng thêm</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="added_service_form" method="POST" action="{{url('admin/settings/addedServices/create')}}" data-parsley-validate>
                                        {!! csrf_field() !!}
                                        <div class="form-group"><label>Mã dịch vụ</label> <input name="code" id="vehicle_code" type="text" placeholder="Mã dịch vụ" class="form-control" required></div>
                                        <div class="form-group"><label>Tên dịch vụ</label> <input name="name" type="text" placeholder="Tên dịch vụ" class="form-control" required></div>
                                        <div class="form-group"><label>Loại phương tiện</label>
                                            <select name="vehicle_type_id" class="form-control" placeholder="Loại xe"
                                                value="{{ old('vehicle_type_id') }}" required>
                                                @foreach($vehicle_types as $vehicle_type)
                                                    <option value="{{$vehicle_type->id}}">{{$vehicle_type->name}}</option>
                                                @endforeach
                                            </select></div>
                                        <div class="form-group"><label>Giá cước</label> <input name="freight" type="text" placeholder="Giá cước" class="form-control" required></div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <span type="button" class="btn btn-white" data-dismiss="modal">Close</span>
                                    <button class="ladda-button btn btn-primary" onclick="addAddedService()"  data-style="expand-left">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example"
                               id="shops-list">
                            <thead>
                            <tr>
                                <th class="text-center">Mã </th>
                                <th class="text-center">Tên dịch vụ</th>
                                <th class="text-center">Phương tiện</th>
                                <th class="text-center">Cước phí</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($added_services as $added_service)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$added_service->code}}</td>
                                    <td class="text-center" style="vertical-align: middle">{{$added_service->name}}</td>
                                    <td class="text-center" style="vertical-align: middle">{{$added_service->vehicle_name}}</td>
                                    <td class="text-center" style="vertical-align: middle">{{$added_service->freight}}</td>

                                    <td class="text-center" style="vertical-align: middle">
                                        <button class='btn btn-primary' data-toggle="modal" data-target="#modal_{{$added_service->id}}" style='width: 70px;'>Sửa</button>
                                        <button class='btn btn-danger' onclick="deleteAddedServiceConfirm({{$added_service->id}})" style='width: 70px; margin-left: 10px;'>Xóa</button>
                                    </td>
                                </tr>
                                <div class="modal inmodal fade" id="modal_{{$added_service->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Dịch vụ cộng thêm</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form id="added_service_form_{{$added_service->id}}" method="POST" action="{{url('admin/settings/addedServices/'.$added_service->id.'/edit')}}" data-parsley-validate>
                                                    {!! csrf_field() !!}
                                                    <div class="form-group"><label>Mã dịch vụ</label>
                                                        <input name="code" value="{{$added_service->code}}" type="text" placeholder="Mã dịch vụ" class="form-control" required>
                                                    </div>
                                                    <div class="form-group"><label>Tên dịch vụ</label>
                                                        <input name="name" value="{{$added_service->name}}" type="text" placeholder="Tên dịch vụ" class="form-control" required>
                                                    </div>
                                                    <div class="form-group"><label>Loại phương tiện</label>
                                                        <select name="vehicle_type_id" class="form-control" placeholder="Loại xe"
                                                                value="{{ old('vehicle_type_id') }}" required>
                                                            @foreach($vehicle_types as $vehicle_type)
                                                                <option value="{{$vehicle_type->id}}" {{($vehicle_type->id == $added_service->vehicle_type_id) ?"selected='selected'":''}}>{{$vehicle_type->name}}</option>
                                                            @endforeach
                                                        </select></div>
                                                    <div class="form-group"><label>Giá cước</label>
                                                        <input name="freight" value="{{$added_service->freight}}" type="text" placeholder="Giá cước" class="form-control" required></div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <span type="button" class="btn btn-white" data-dismiss="modal">Close</span>
                                                <button class="ladda-button btn btn-primary" onclick="editAddedService({{$added_service->id}})"  data-style="expand-left">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#added_service_form").parsley();
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ]

            });
        });

        function addAddedService() {
            $("#added_service_form").submit();
        }

        function editAddedService(id){
            $("#added_service_form_"+id).submit();
        }

        function deleteAddedServiceConfirm(id) {
            swal({
                title: "Bạn chắc chắn chứ?",
                text: "Bạn sẽ không thể phục hồi dữ liệu!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Chắc chắn!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: base_url + "/admin/settings/addedServices/" + id + "/delete",
                    type: 'GET',
                    success: function (result) {
                        if(parseInt(result) == 1){
                            swal({
                                title: "Đã xóa!",
                                text: "Dịch vụ cộng thêm đã được xóa.",
                                type: "success",
                            }, function () {
                                window.location.reload();
                            });
                        }else {
                            swal("Lỗi", "Xóa không thành công! :)", "error");
                        }

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        swal("Lỗi", "Xóa không thành công! :)", "error");
                    }
                });
            });
        }
    </script>
@endsection