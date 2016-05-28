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
                    <h5>Danh sách phương tiện vận chuyển</h5>
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
                        <button data-toggle="modal" class="btn btn-primary " data-target="#myModal6"><i class="fa fa-plus" aria-hidden="true"></i> Thêm </button>
                    </div>
                    <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Phương tiện</h4>
                                </div>
                                    <div class="modal-body">
                                            <form id="vehicle_form" method="POST" action="{{url('admin/settings/vehicleTypes/create')}}" data-parsley-validate>
                                                {!! csrf_field() !!}
                                                <div class="form-group"><label>Mã phương tiện</label> <input name="code" id="vehicle_code" type="text" placeholder="Mã phương tiện" class="form-control" required></div>
                                                <div class="form-group"><label>Tên phương tiện</label> <input name="name" type="text" placeholder="Tên phương tiện" class="form-control" required></div>
                                            </form>
                                    </div>
                                    <div class="modal-footer">
                                        <span type="button" class="btn btn-white" data-dismiss="modal">Close</span>
                                        <button class="ladda-button btn btn-primary" onclick="addVehicle()"  data-style="expand-left">Submit</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example"
                               id="shops-list">
                            <thead>
                            <tr>
                                <th class="text-center">Mã phương tiện</th>
                                <th class="text-center">Tên phương tiện</th>
                                <th class="text-center">Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicle_types as $vehicle_type)
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle">{{$vehicle_type->code}}</td>
                                        <td class="text-center" style="vertical-align: middle">{{$vehicle_type->name}}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                                <button class='btn btn-primary' data-toggle="modal" data-target="#modal_{{$vehicle_type->id}}" style='width: 70px;'>Sửa</button>
                                                <a class='btn btn-danger' style='width: 70px; margin-left: 10px;'>Xóa</a>
                                        </td>
                                    </tr>
                                    <div class="modal inmodal fade" id="modal_{{$vehicle_type->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title">Phương tiện</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="vehicle_form_{{$vehicle_type->id}}" method="POST" action="{{url('admin/settings/vehicleTypes/'.$vehicle_type->id.'/edit')}}" data-parsley-validate>
                                                        {!! csrf_field() !!}
                                                        <div class="form-group"><label>Mã phương tiện</label>
                                                            <input name="code" id="vehicle_code" value="{{$vehicle_type->code}}" type="text" placeholder="Mã phương tiện" class="form-control" required>
                                                        </div>
                                                        <div class="form-group"><label>Tên phương tiện</label>
                                                            <input name="name" type="text" value="{{$vehicle_type->name}}" placeholder="Tên phương tiện" class="form-control" required>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <span type="button" class="btn btn-white" data-dismiss="modal">Close</span>
                                                    <button class="ladda-button btn btn-primary" onclick="editVehicle({{$vehicle_type->id}})"  data-style="expand-left">Submit</button>
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
            $("#vehicle_form").parsley();
            // Bind normal buttons
            $( '.ladda-button' ).ladda( 'bind', { timeout: 2000 } );

            // Bind progress buttons and simulate loading progress
            Ladda.bind( '.progress-demo .ladda-button',{
                callback: function( instance ){
                    var progress = 0;
                    var interval = setInterval( function(){
                        progress = Math.min( progress + Math.random() * 0.1, 1 );
                        instance.setProgress( progress );

                        if( progress === 1 ){
                            instance.stop();
                            clearInterval( interval );
                        }
                    }, 200 );
                }
            });
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

        function addVehicle() {
            $("#vehicle_form").submit();
        }

        function editVehicle(id){
            $("#vehicle_form_"+id).submit();
        }
    </script>
@endsection