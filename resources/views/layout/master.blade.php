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
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
  {{-- right end --}}
</nav>
{{-- top nav start end --}}
{{-- left sidebar start --}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="brand-link">
    <img src="{{ asset('static/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
  </div>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v3</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
{{-- left sidebar end --}}
{{-- content start --}}
<div class="content-wrapper">
  content
</div>
{{-- content end --}}
{{-- footer start --}}
<footer class="main-footer text-center">
  <strong>Copyright &copy; 2020-{{ date('Y') }} <a href="javascript:;">瑞怡STACK</a>.</strong>
  All rights reserved.
</footer>
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
