<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('header_css')
        <link rel="stylesheet" href="{{ asset('static/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('static/css/adminlte.min.css') }}">
    @show
    @section('header_js')

    @show
    <title>@yield('heading_title') - {{ config('app.name') }}</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

</body>
@section('footer_css')

@show
@section('footer_js')

@show
</html>
