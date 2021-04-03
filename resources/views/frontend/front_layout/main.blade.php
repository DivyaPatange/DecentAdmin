<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Decent School- @yield('title')</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  @include('frontend.front_layout.stylesheet')
  @yield('customcss')
  
  <!-- =======================================================
  * Template Name: Flattern - v2.0.1
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
 
  @include('frontend.front_layout.topbar')
  <!-- ======= Header ======= -->
  @include('frontend.front_layout.navbar')
  <!-- End Header -->

    @yield('content')

  <!-- ======= Footer ======= -->
  @include('frontend.front_layout.footer')
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  @include('frontend.front_layout.script')
    @yield('customjs')
</body>

</html>