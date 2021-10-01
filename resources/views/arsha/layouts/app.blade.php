<!DOCTYPE html>
<html lang="{{$config->lang}}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$config->name}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/'.$config->favicon)}}" rel="icon">
  <link href="{{asset('assets/'.$config->favicon)}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="{{asset('arsha/css/fonts.min.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/css/fonts-gitia.css')}}" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('arsha/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <script src="{{asset('arsha/js/jquery.min.js')}}"></script>

  <!-- Template Main CSS File -->
  <link href="{{asset('arsha/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/css/app.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/css/gitia.css')}}" rel="stylesheet">

  @stack('styles')

  <!-- =======================================================
  * Template Name: Arsha - v4.3.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto">
        <a href="{{url('')}}">
          <img src="{{asset('assets/'.$config->logo_color_large)}}" title="{{$config->short_name}}" alt="{{$config->short_name}}">
        </a>
      </h1>
      
      @include('arsha.layouts.navigation')

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @yield('content')

  <!-- ======= Footer ======= -->
  @include('arsha.layouts.footer')

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('arsha/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('arsha/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('arsha/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('arsha/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('arsha/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('arsha/js/main.js')}}"></script>
    
  @stack('scripts')

</body>

</html>