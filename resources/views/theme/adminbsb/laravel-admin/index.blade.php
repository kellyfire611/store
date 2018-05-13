<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <title>{{ Admin::title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Favicon-->
<link rel="icon" href="../../favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="{{ admin_asset("theme/adminbsb/plugins/bootstrap/css/bootstrap.css") }}" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="{{ admin_asset("theme/adminbsb/plugins/node-waves/waves.css") }}" rel="stylesheet" />

<!-- Animation Css -->
<link href="{{ admin_asset("theme/adminbsb/plugins/animate-css/animate.css") }}" rel="stylesheet" />
<link href="{{ admin_asset("theme/adminbsb/plugins/sweetalert/sweetalert.css") }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/nprogress/nprogress.css") }}">

<!-- Font awesome -->
<link href="{{ admin_asset("theme/adminbsb/plugins/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet">

<!-- Custom Css -->
<link href="{{ admin_asset("theme/adminbsb/css/style.css") }}" rel="stylesheet">
<link href="{{ admin_asset("theme/adminbsb/css/custom-style.css") }}" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="{{ admin_asset("theme/adminbsb/css/themes/all-themes.css") }}" rel="stylesheet" />

<!-- Theme style -->
{!! Admin::css() !!}








    <link rel="stylesheet" href="{{ admin_asset("/css/bootstrap3-hacking.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/css/custom-style.css") }}">





    <!-- Jquery Core Js -->
    <script src="{{ admin_asset("theme/adminbsb/plugins/jquery/jquery.min.js") }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ admin_asset("theme/adminbsb/plugins/bootstrap/js/bootstrap.js") }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ admin_asset("theme/adminbsb/plugins/bootstrap-select/js/bootstrap-select.js") }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ admin_asset("theme/adminbsb/plugins/jquery-slimscroll/jquery.slimscroll.js") }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ admin_asset("theme/adminbsb/plugins/node-waves/waves.js") }}"></script>

 <!-- Jquery CountTo Plugin Js -->
 <script src="{{ admin_asset("theme/adminbsb/plugins/jquery-countto/jquery.countTo.js") }}"></script>

<!-- Morris Plugin Js -->
<script src="{{ admin_asset("theme/adminbsb/plugins/raphael/raphael.min.js") }}"></script>
<script src="{{ admin_asset("theme/adminbsb/plugins/morrisjs/morris.js") }}"></script>

<!-- ChartJs -->
<script src="{{ admin_asset("theme/adminbsb/plugins/chartjs/Chart.bundle.js") }}"></script>

<!-- Flot Charts Plugin Js -->

<!-- Sparkline Chart Plugin Js -->
<script src="{{ admin_asset("theme/adminbsb/plugins/jquery-sparkline/jquery.sparkline.js") }}"></script>

    <!-- Custom Js -->
    <script src="{{ admin_asset("theme/adminbsb/js/admin.js") }}"></script>

    <!-- Demo Js -->
    <script src="{{ admin_asset("theme/adminbsb/js/demo.js") }}"></script>

<!-- REQUIRED JS SCRIPTS -->



<script src="{{ admin_asset ("/vendor/laravel-admin/jquery-pjax/jquery.pjax.js") }}"></script>
<script src="{{ admin_asset ("/vendor/laravel-admin/nprogress/nprogress.js") }}"></script>
<script src="{{ admin_asset ("/vendor/keypress/keypress-2.1.5.min.js") }}"></script>
<script src="{{ admin_asset ("/vendor/angularjs/angular.min.js") }}"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="theme-red hold-transition {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}">

<div ng-app="ungdungAngularjs" ng-controller="sinhvienController">
</div>


<!-- Page Loader -->
<div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    
    

  @include('admin::partials.header')

 @include('admin::partials.sidebar')

    <section class="content" id="pjax-container">

    


    @yield('content')
    {!! Admin::script() !!}
    </section>


    



<!--
<div class="wrapper">

   
</div>
-->
<!-- ./wrapper -->




<script src="{{ admin_asset ("/vendor/laravel-admin/nestable/jquery.nestable.js") }}"></script>
<script src="{{ admin_asset ("/vendor/laravel-admin/toastr/build/toastr.min.js") }}"></script>

<script src="{{ admin_asset ("theme/adminbsb/plugins/sweetalert/sweetalert.min.js") }}"></script>
{!! Admin::js() !!}

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";

    var listener = new window.keypress.Listener();

    // var agmkStore = angular.module("agmkstore", []);
    // agmkStore.controller('agmkstoreController', function($scope) {

    // });

    var ungdungAngularjs = angular.module("ungdungAngularjs", []);
ungdungAngularjs.controller('sinhvienController', function($scope) {
});
</script>

<script src="{{ admin_asset ("/vendor/laravel-admin/laravel-admin/laravel-admin.js") }}"></script>



<script>
    $(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
        console.log($next.length);
        if (!$next.length) {
            $next = $('[tabIndex=1]');
        }
        $next.focus();
    }
});

</script>


</body>
</html>
