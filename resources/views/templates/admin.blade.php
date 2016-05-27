<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MSL | Việt Nam</title>
    <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/font-awesome/css/font-awesome.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/animate.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/style.css") }}" rel="stylesheet">


    <!-- Mainly scripts -->
    <script src="{{ asset("theme/js/jquery-2.1.1.js") }}"></script>
    <script src="{{ asset("theme/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/metisMenu/jquery.metisMenu.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/slimscroll/jquery.slimscroll.min.js") }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset("theme/js/inspinia.js") }}"></script>
    <script src="{{ asset("theme/js/plugins/pace/pace.min.js") }}"></script>
</head>
<body>

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
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center m-t-lg">

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