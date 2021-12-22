<!DOCTYPE html>
<html>
    <head>
        <title>Unforgettable</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Driving </title>

        <!-- Bootstrap -->
        <link href="{{ asset('/assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('/assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('/assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="{{ asset('/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{ asset('/assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/sweet-alert/sweetalert.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datetimepicker.css') }}">	
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">	
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3t-HwcJ3Z7plu1TVE58nWwu_t6qhPzxs&libraries=places&region=EG"></script>
        <script type="text/javascript">
            localStorage.setItem('site_url', '{{ url()->full() }}');
            

        </script>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> 
       
    </head>
    <body class="nav-md">

        <div class="preloader" id="ajaxLoader" style="display:none">
            <div><img src="{{ asset('/assets/images/loading.gif') }}"></div>
        </div>
        <!-- <div class="page-loader" aria-hidden="true" style="display: none;">
            <div class="page-load-wrap">Please Wait!</div>      
        </div> -->
        <!-- <img title="..." src="images/ui-icon-calendar.png" class="ui-datepicker-trigger"> -->
        <div class="container body dash-m" >
            <div class="main_container">