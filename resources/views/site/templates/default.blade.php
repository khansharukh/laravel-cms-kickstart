<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 9/10/2017
 * Time: 1:24 PM
 */

use \App\Http\Controllers\Controller;

?>
<?php
$controller = new Controller();
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
    <meta name="robots" content=""/>
    <meta name="description" content=""/>
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons Icon -->
    <link href="{{ asset('site-assets/images/favicon.ico') }}" rel="icon" type="image/x-icon"/>
    <link href="{{ asset('site-assets/images/favicon.png') }}" rel="shortcut icon" type="image/x-icon"/>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Laravel CMS - @yield('title')</title>
    <style>
        img {
            width: 100%;
            height: 100%;
        }
        .page-content {
            margin-top: 75px;
        }
    </style>
</head>
<body>
<main role="main" class="container-fluid">
    <div class="starter-template">
        @include('site.templates.partials.navigation')

        @yield('content')

        @include('site.templates.partials.footer')
    </div>
</main><!-- /.container -->
<!-- JavaScript  files ========================================= -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>

@yield('internal-scripts')
</body>
</html>