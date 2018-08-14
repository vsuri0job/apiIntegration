

<!DOCTYPE html>

<html lang="en" data-textdirection="ltr" class="loading">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>

        @php 

            $title=App\Settings::where('set_type','title')->first();

        @endphp

        {{$title->set_value}}

    </title>

    <link rel="apple-touch-icon" href="{{url('assets')}}/app-assets/images/ico/apple-icon-120.png">

    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/bootstrap.css">

     <link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/main_custome.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/feather/style.min.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/extensions/pace.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/forms/icheck/icheck.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/forms/icheck/custom.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/charts/morris.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/extensions/unslider.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/weather-icons/climacons.min.css">

    <!-- END VENDOR CSS-->
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <!-- BEGIN STACK CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/colors.css">

    <!-- END STACK CSS-->

    <!-- BEGIN Page Level CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/meteocons/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/pages/users.css">

    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!-- END Custom CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/feather/style.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/forms/selects/select2.min.css">
       
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/extensions/toastr.css">
       <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/plugins/extensions/toastr.min.css">
       
       <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/review-champ.custom-styles.css">

      <style>

       .tar { text-align: right; }

      </style>

      <script type="text/javascript">
        
        CSRF_TOKEN = "{{ csrf_token() }}";
        BASE_URL = "{{ url('') }}";

      </script>

  </head>

  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar">

    @include('layouts.menu')

    @include('layouts.sidemenu')

    @yield('content')

    @include('layouts.footer')

    @yield('script')

  </body>

</html>