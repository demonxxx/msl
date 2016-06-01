@extends('templates.admin')
@section('content')
    @include('partials.flash')

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
                    <h5>Danh sách loại tài xế</h5>
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
                        <button data-toggle="modal" class="btn btn-primary " data-target="#myModal6"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Thêm
                        </button>
                    </div>
                    <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title">Loại tài xế</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="shipper_type_form" method="POST"
                                          action="{{url('admin/settings/shipperTypes/create')}}" data-parsley-validate>
                                        {!! csrf_field() !!}
                                        <div class="form-group"><label>Loại tài xế</label> <input name="name"
                                                                                                      type="text"
                                                                                                      placeholder="Loại tài xế"
                                                                                                      class="form-control"
                                                                                                      required></div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <span type="button" class="btn btn-white" data-dismiss="modal">Close</span>
                                    <button class="ladda-button btn btn-primary" onclick="addShipperType()"
                                            data-style="expand-left">Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-shipper-types"
                               id="shops-list">
                            <thead>
                            <tr>
                                <th class="text-center">Loại tài xế</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shipper_types as $shipper_type)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$shipper_type->name}}</td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <button class='btn btn-primary' data-toggle="modal"
                                                data-target="#modal_{{$shipper_type->id}}" style='width: 70px;'>Sửa
                                        </button>
                                        <button onclick="deleteShipperTypeConfirm({{$shipper_type->id}})"
                                                class='btn btn-danger' style='width: 70px; margin-left: 10px;'>Xóa
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal inmodal fade" id="modal_{{$shipper_type->id}}" tabindex="-1"
                                     role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Loại tài xế</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form id="shipper_type_form_{{$shipper_type->id}}" method="POST"
                                                      action="{{url('admin/settings/shipperTypes/'.$shipper_type->id.'/edit')}}"
                                                      data-parsley-validate>
                                                    {!! csrf_field() !!}

                                                    <div class="form-group"><label>Loại tài xế</label>
                                                        <input name="name" type="text" value="{{$shipper_type->name}}"
                                                               placeholder="Loại tài xế" class="form-control"
                                                               required>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <span type="button" class="btn btn-white"
                                                      data-dismiss="modal">Close</span>
                                                <button class="ladda-button btn btn-primary"
                                                        onclick="editShipperType({{$shipper_type->id}})"
                                                        data-style="expand-left">Submit
                                                </button>
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
            $('.dataTables-shipper-types').DataTable({
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
                            $(win.document.body).find('table').addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ]
            });
        });

        function addShipperType() {
            $("#shipper_type_form").submit();
        }

        function editShipperType(id) {
            $("#shipper_type_form_" + id).submit();
        }

        function deleteShipperTypeConfirm(id) {
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
                    url: base_url + "/admin/settings/shipperTypes/" + id + "/delete",
                    type: 'GET',
                    success: function (result) {
                        if (parseInt(result) == 1) {
                            swal({
                                title: "Đã xóa!",
                                text: "Loại tài xế đã được xóa.",
                                type: "success",
                            }, function () {
                                window.location.reload();
                            });
                        } else {
                            swal("Lỗi", "Xóa không thành công! :)", "error");
                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        swal("Lỗi", "Xóa không thành công! :)", "error");
                    }
                });
            });
        }
    </script>
@endsection