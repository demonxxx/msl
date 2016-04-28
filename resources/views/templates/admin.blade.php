  <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html class="no-js" lang=""> 
  <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Minovate - Admin Dashboard</title>
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="{{ asset("themes/assets/css/vendor/bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/css/vendor/animate.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/css/vendor/font-awesome.min.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/animsition/css/animsition.min.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/daterangepicker/daterangepicker-bs3.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/morris/morris.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/owl-carousel/owl.carousel.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/owl-carousel/owl.theme.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/rickshaw/rickshaw.min.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/datatables/css/jquery.dataTables.min.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/datatables/datatables.bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/chosen/chosen.css") }}">
        <link rel="stylesheet" href="{{ asset("themes/assets/js/vendor/summernote/summernote.css") }}">

        <!-- project main css files -->
        <link rel="stylesheet" href="{{ asset("themes/assets/css/main.css") }}">
        <script src="{{ asset("themes/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js") }}  "></script>
        
        
        <script src="{{ asset("themes/assets/js/vendor/jquery/jquery-1.11.2.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/datatables/js/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/datatables/extensions/dataTables.bootstrap.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/datatables/extensions/Pagination/input.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/date-format/jquery-dateFormat.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/bootstrap/bootstrap.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/jRespond/jRespond.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/d3/d3.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/d3/d3.layout.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/rickshaw/rickshaw.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/sparkline/jquery.sparkline.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/slimscroll/jquery.slimscroll.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/animsition/js/jquery.animsition.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/daterangepicker/moment.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/daterangepicker/daterangepicker.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/screenfull/screenfull.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/flot/jquery.flot.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/flot-spline/jquery.flot.spline.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/easypiechart/jquery.easypiechart.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/raphael/raphael-min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/morris/morris.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/owl-carousel/owl.carousel.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/chosen/chosen.jquery.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/summernote/summernote.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/coolclock/coolclock.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/coolclock/excanvas.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/parsley/parsley.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/main.js") }}"></script>
  </head>
  <body id="minovate" class="appWrapper sidebar-sm-forced">
    <div id="wrap" class="animsition">
      @include('layouts.header')
        <div id="controls">
            @include('layouts.sidebar')
            @include('layouts.rightbar')
        </div>
        <section id="content">
            @yield('content')
        </section>
    </div>
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>
  </body>
</html>