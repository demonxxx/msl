<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



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

        <!-- project main css files -->
         <link rel="stylesheet" href="{{ asset("themes/assets/css/main.css") }}">
        <!--/ stylesheets -->
        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="{{ asset("themes/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js") }}  "></script>
        <!--/ modernizr -->
    </head>
    <body id="minovate" class="appWrapper">

        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">

            <div class="page page-core page-login">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">MSL</span>VietNam</h3></div>

                <div class="container w-420 p-15 bg-white mt-40 text-center">

                    <h2 class="text-light text-greensea">Log In</h2>

                    <form class="form-validation mt-20" novalidate="" role="form" method="POST" action="{{ url('/login') }}">

                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control underline-input" placeholder="Email" name="email" value="{{ old('email') }}">
                             @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" placeholder="Password" name="password" class="form-control underline-input">
                             @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group text-left mt-20">
                            <button type="submit"class="btn btn-greensea b-0 br-2 mr-5">
                                Login
                            </button>
                            <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">
                                <input type="checkbox" name="remember"><i></i> Remember me
                            </label>
                            <a href="{{ url('/password/reset') }}" class="pull-right mt-10">Forgot Password?</a>
                        </div>
                    </form>
                    <hr class="b-3x">
                    <div class="bg-slategray lt wrap-reset mt-40">
                        <p class="m-0">
                            <a href="{{ url('/register') }}" class="text-uppercase">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Application Content -->
        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="{{ asset("themes/assets/js/vendor/bootstrap/bootstrap.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/jRespond/jRespond.min.js") }}"></script>

        <script src="{{ asset("themes/assets/js/vendor/sparkline/jquery.sparkline.min.js") }}"></script>
        <script src="{{ asset("themes/assets/js/vendor/slimscroll/jquery.slimscroll.min.js") }}"></script>

        <script src="{{ asset("themes/assets/js/vendor/animsition/js/jquery.animsition.min.js") }}"></script>

        <script src="{{ asset("themes/assets/js/vendor/screenfull/screenfull.min.js") }}"></script>
        <!--/ vendor javascripts -->
        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="{{ asset("themes/assets/js/main.js") }}"></script>
        <!--/ custom javascripts -->
        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){
            });
        </script>
        <!--/ Page Specific Scripts -->
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
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
