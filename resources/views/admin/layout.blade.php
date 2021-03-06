<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>{{env('APP_NAME')}}</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('public/css/bootstrap3.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/material-dashboard.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/panel.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/demo.css')}}" rel="stylesheet" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

  <div class="wrapper">

      <div class="sidebar" data-color="purple" data-image="{{asset('public/img/sidebar-1.jpg')}}">
      <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->

      <div class="logo">
        <a href="{{route('admin.index')}}" class="simple-text">
          {{env('APP_NAME')}}
        </a>
      </div>

        @include ('partials.admin.sidenav')
      </div>

      <div class="main-panel">
      @include ('partials.admin.topnav')

      @yield ('content')

      @include ('partials.admin.footer')

    </div>
  </div>

</body>

  <!--   Core JS Files   -->
  <script src="{{asset('public/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/bootstrap3.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/material.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/chartist.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/bootstrap-notify.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/bootstrap-typeahead.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/material-dashboard.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/common.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/admin-panel.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/js/demo.js')}}" type="text/javascript"></script>
  @yield ('js')
  <!--  Google Maps Plugin    -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
</html>