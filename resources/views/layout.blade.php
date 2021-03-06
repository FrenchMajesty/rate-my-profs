<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>
    <!-- Font Awesome -->
    <link href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled.min.css?ver=4.3.2" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('public/css/mdb.min.css')}}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{asset('public/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/animate.css')}}" rel="stylesheet">
</head>

<body>

    @yield ('navbar')

    @yield ('content')

    @yield ('footer')

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="{{asset('public/js/jquery-3.1.1.min.js')}}"></script>
    <!-- Bootstrap tooltips -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('public/js/tether.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" sr="{{asset('public/js/compiled.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/mdb.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/bootstrap-typeahead.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/custom-modules.js')}}"></script>
    <script type="text/javascript">
        const SIDE_MODULE_URL = {
            url: {
                search: '{{route('pages.search')}}',
                fetchAll: '{{route('fetch.all')}}',
                departments: '{{route('fetch.departments')}}'
            }
        }
        $(document).ready(() => {
            const config = {
                search: { fetchUrl: '{{route('fetch.all')}}' }
            }
            if(document.querySelector('.search-bar')) searchBar.init(config)
        })
    </script>
    @yield ('js')
</body>

</html>
