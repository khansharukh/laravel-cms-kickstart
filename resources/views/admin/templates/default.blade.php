<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 9/10/2017
 * Time: 1:24 PM
 */
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">

    <!-- Themify icons -->
    <link rel="stylesheet" href="{{ asset('admin-assets/themify/themify-icons.css') }}">

    <!-- Waves css -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/css/waves.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('admin_assets/css/laravel-admin.css') }}" rel="stylesheet">
    <title>Admin - @yield('title')</title>
    <style>
        .card-login {
            max-width: 25rem;
        }

        .content-area {
            margin-top: 15px;
        }

        .content-area .panel {
            background: #FFF;
            padding: 25px;
        }

        .top-inner-navbar {
            min-height: 57px;
        }
    </style>
</head>
<body>
<?php
$show_nav = true;
if (Request::path() == 'admin') {
    $show_nav = false;
}
?>
<div class="wrapper">
    @include('admin.templates.partials.sidebar')

    @if($show_nav)
        <div class="container content-area">
            <div class="row">
                <div class="col-md-12">
                    @endif
                    @yield('content')
                    @if($show_nav)
                </div>
            </div>
        </div>
    @endif
</div>
@include('admin.templates.partials.footer')
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('admin-assets/js/jquery-3.2.1.slim.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/js/waves.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
        Waves.init();
        Waves.attach('.wave-effect', ['waves-button']);
        Waves.attach('.wave-effect-float', ['waves-button', 'waves-float']);
    });
    $(function () {
        $('.slimescroll-id').slimScroll({
            height: '100vh'
        });
    });
</script>
@yield('internal-scripts')
</body>
</html>