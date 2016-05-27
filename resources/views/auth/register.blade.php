<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/font-awesome/css/font-awesome.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/plugins/iCheck/custom.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/animate.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/style.css") }}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">MSL</h1>
        </div>
        <h3>Đăng ký tài khoản MSL Việt Nam</h3>
        <form class="m-t" role="form" method="POST" action="{{ url('/register') }}" >
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                <input type="number" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number') }}">
                @if ($errors->has('phone_number'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" placeholder="Password" class="form-control" name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Đồng ý với mọi điều khoản hoạt động </label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Đăng ký</button>

            <p class="text-muted text-center"><small>Đã có tài khoản?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ url('/login') }}">Login</a>
        </form>
        <p class="m-t"> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ asset("theme/js/jquery-2.1.1.js") }}"></script>
<script src="{{ asset("theme/js/bootstrap.min.js") }}"></script>
<!-- iCheck -->
<script src="{{ asset("theme/js/plugins/iCheck/icheck.min.js") }}"></script>
<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>

</html>
