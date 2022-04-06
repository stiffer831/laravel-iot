<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('static/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('static/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('static/js/adminlte.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('static/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/adminlte.min.css') }}">
    <title>{{ __('login.title') }} - {{ config('app.name') }}</title>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        {{ config('app.name') }}
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{__('login.welcome')}}{{ config('app.name') }}</p>
            @if(session('warning'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('warning') }}
                </div>
            @endif
            <form action="{{ route('login.submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="{{ __('login.username') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ __('login.password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('login.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
