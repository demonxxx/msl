<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MSL | Việt Nam</title>
        <link href="{{ asset("theme/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css")}}" rel="stylesheet">
        <script src="{{ asset("js/constants.js") }}"></script>
        <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("theme/font-awesome/css/font-awesome.css") }}" rel="stylesheet">
        <link href="{{ asset("theme/css/animate.css") }}" rel="stylesheet">
        <link href="{{ asset("theme/css/style.css") }}" rel="stylesheet">
        <link href="{{ asset("theme/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css") }}" rel="stylesheet">
        <link href="{{ asset("theme/css/plugins/iCheck/custom.css") }}" rel="stylesheet">
        <link href="{{ asset("theme/js/plugins/jquery-ui-1.11.4/jquery-ui.css") }}" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="{{ asset("theme/js/jquery-2.1.1.js") }}"></script>
        <script src="{{ asset("theme/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/metisMenu/jquery.metisMenu.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/slimscroll/jquery.slimscroll.min.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/jquery-ui-1.11.4/jquery-ui.js") }}"></script>

        <!-- Custom and plugin javascript -->
        <script src="{{ asset("theme/js/inspinia.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/pace/pace.min.js") }}"></script>
        <!-- Sweet Alert -->
        <link href="{{ asset("theme/css/plugins/sweetalert/sweetalert.css") }}" rel="stylesheet">

        <!-- Sweet alert -->
        <script src="{{ asset("theme/js/plugins/sweetalert/sweetalert.min.js") }}"></script>


        <!--Datatables-->
        <link href="{{ asset("theme/css/plugins/dataTables/datatables.min.css") }}" rel="stylesheet">
        <script src="{{ asset("theme/js/plugins/datatables/datatables.min.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/datatables/js/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/datatables/extensions/dataTables.bootstrap.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/datatables/extensions/Pagination/input.js") }}"></script>
        <script src="{{ asset("theme/js/plugins/parsley/parsley.min.js") }}"></script>

        <script src="{{ asset("js/datatable.ajax.js") }}"></script>

        <!--bootbox-->
        <script src="{{ asset("theme/js/plugins/bootbox/bootbox.js")}}"></script>
        <!--notify-->
        <script src="{{ asset("js/notify.js")}}"></script>
        <!--select 2-->
        <script src="{{ asset("js/select2.js")}}"></script>
        <link href="{{ asset("css/select2.css") }}" rel="stylesheet">
        <link href="{{ asset("css/select2-bootstrap.css") }}" rel="stylesheet">
        <script src="{{ asset("theme/js/plugins/iCheck/icheck.min.js") }}"></script>
        <!--custom js always in end of header-->
        <script src="{{ asset("js/custom.js") }}"></script>
    </head>
    <body class="pace-done mini-navbar" style="padding-bottom: 26px;">

        <script>
base_url = "{{URL::to('/')}}";
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        </script>
        <div id="wrapper">
            @include('layouts.sidebar')
            <div id="page-wrapper" class="gray-bg">

                @include('layouts.header')
                @if(!empty($breadcrumbs))
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>{{$breadcrumbs['header']}}</h2>
                        @if(!empty($breadcrumbs['childs']))
                        <ol class="breadcrumb">
                            @foreach($breadcrumbs['childs'] as $child)
                            <li>
                                <a href="{{$child['url']}}">{{$child['name']}}</a>
                            </li>
                            @endforeach
                            <li class="active">
                                <strong>{{$breadcrumbs['tail']}}</strong>
                            </li>
                        </ol>
                        @endif
                    </div>
                </div>
                @endif

                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </body>
</html>