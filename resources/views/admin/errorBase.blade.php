<!DOCTYPE html>
<!--
* CoreUI Free Laravel Bootstrap Admin Template
* @version v2.0.1
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Research Group Website">
    <meta name="author" content="Adrian Jimenez">
    <meta name="keyword" content="Research,Group,University">
    <title>{{$config->name}}</title>
    <meta name="theme-color" content="#ffffff">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body class="c-app flex-row align-items-center">
    @yield('content') 
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    @yield('javascript')
  </body>
</html>