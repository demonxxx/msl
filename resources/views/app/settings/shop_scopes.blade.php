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
                    <h5>Danh sách phạm vi shop</h5>
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
                                    <h4 class="modal-title">Phạm vi shop</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="shop_scope_from" method="POST"
                                          action="{{url('admin/settings/shopScopes/create')}}" data-parsley-validate>
                                        {!! csrf_field() !!}
                                        <div class="form-group"><label>Phạm vi shop</label> <input name="name"
                                                                                                      type="text"
                                                                                                      placeholder="Phạm vi shop"
                                                                                                      class="form-control"
                                                                                                      required></div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <span type="button" class="btn btn-white" data-dismiss="modal">Close</span>
                                    <button class="ladda-button btn btn-primary" onclick="addShopScope()"
                                            data-style="expand-left">Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-shop-scope"
                               id="shops-list">
                            <thead>
                            <tr>
                                <th class="text-center">Phạm vi shop</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shop_scopes as $shop_scope)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$shop_scope->name}}</td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <button class='btn btn-primary' data-toggle="modal"
                                                data-target="#modal_{{$shop_scope->id}}" style='width: 70px;'>Sửa
                                        </button>
                                        <button onclick="deleteShopScopeConfirm({{$shop_scope->id}})"
                                                class='btn btn-danger' style='width: 70px; margin-left: 10px;'>Xóa
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal inmodal fade" id="modal_{{$shop_scope->id}}" tabindex="-1"
                                     role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Phạm vi shop</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form id="shop_scope_form_{{$shop_scope->id}}" method="POST"
                                                      action="{{url('admin/settings/shopScopes/'.$shop_scope->id.'/edit')}}"
                                                      data-parsley-validate>
                                                    {!! csrf_field() !!}

                                                    <div class="form-group"><label>Phạm vi shop</label>
                                                        <input name="name" type="text" value="{{$shop_scope->name}}"
                                                               placeholder="Phạm vi shop" class="form-control"
                                                               required>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <span type="button" class="btn btn-white"
                                                      data-dismiss="modal">Close</span>
                                                <button class="ladda-button btn btn-primary"
                                                        onclick="editShopScope({{$shop_scope->id}})"
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
            $("#shop_scope_from").parsley();
            // Bind normal buttons
            $('.dataTables-shop-scope').DataTable({
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

        function addShopScope() {
            $("#shop_scope_from").submit();
        }

        function editShopScope(id) {
            $("#shop_scope_form_" + id).submit();
        }

        function deleteShopScopeConfirm(id) {
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
                    url: base_url + "/admin/settings/shopScopes/" + id + "/delete",
                    type: 'GET',
                    success: function (result) {
                        if (parseInt(result) == 1) {
                            swal({
                                title: "Đã xóa!",
                                text: "Phạm vi shop đã được xóa.",
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