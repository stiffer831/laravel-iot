<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @section('header_css')
    <link rel="stylesheet" href="{{ asset('static/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/stylesheet.css') }}">
  @show
  @section('header_js')

  @show
  <title>@yield('heading_title') - {{ config('app.name') }}</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
{{-- top nav start --}}
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  {{-- left start --}}
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="javascript:;" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  {{-- left end --}}
  {{-- right start --}}
  @include('share.top_nav')
  {{-- right end --}}
</nav>
{{-- top nav start end --}}
{{-- left sidebar start --}}
@include('share.sidebar')
{{-- left sidebar end --}}
{{-- content start --}}
<div class="content-wrapper">
  {{-- header nav and breadcrumb start --}}
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <h1 class="m-0">{{ __('nav.dashboard') }}</h1>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  {{-- header nav and breadcrumb end --}}
  {{-- main content start --}}
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        @yield('content')
      </div>
    </div>
  </section>
  {{-- main content end --}}
</div>
{{-- content end --}}
{{-- footer start --}}
@include('share.footer')
{{-- footer end --}}
</body>
@section('footer_css')

@show
@section('footer_js')
  <script src="{{ asset('static/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('static/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script type="text/javascript">
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="{{ asset('static/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('static/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('static/plugins/sparklines/sparkline.js') }}"></script>
  <script src="{{ asset('static/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <script src="{{ asset('static/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('static/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('static/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('static/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('static/js/adminlte.js') }}"></script>
  <script src="{{ asset('static/js/demo.js') }}"></script>
  <script src="{{ asset('static/js/dashboard.js') }}"></script>
@show
</html>
