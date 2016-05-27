<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/font-awesome/css/font-awesome.css") }}" rel="stylesheet">

    <link href="{{ asset("theme/css/animate.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/style.css") }}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">MSL</h1>

        </div>
        <h3>Chào mừng đến với MSL Việt Nam</h3>

        <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control underline-input" placeholder="Email" name="email"
                       value="{{ old('email') }}">
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
            <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>

            <a href="{{ url('/password/reset') }}">
                <small>Quên mật khẩu?</small>
            </a>
            <p class="text-muted text-center">
                <small>Bạn đã có tài khoản?</small>
            </p>
            <a class="btn btn-sm btn-white btn-block" href="{{ url('/register') }}">Tạo tài khoản</a>
        </form>
        <p class="m-t">
        </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ asset("theme/js/jquery-2.1.1.js") }}"></script>
<script src="{{ asset("theme/js/bootstrap.min.js") }}"></script>

</body>

</html>
