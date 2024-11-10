
@php
$settings_details = getGeneralSettingsDetails(); 
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
  <!-- Page Title -->
  
  <title>
    @yield('title')
   </title>

  <!-- Meta Data -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../../../assets/img/favicon.png">

  <!-- Web Fonts -->
  <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">

  <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
  <link rel="stylesheet" href="{{asset('/public/backend/assets/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/public/backend/assets/fonts/icofont/icofont.min.css')}}">
  <link rel="stylesheet"
      href="{{asset('/public/backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css')}}">
  <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

  <!-- ======= MAIN STYLES ======= -->
  <link rel="stylesheet" href="{{asset('/public/backend/assets/css/light/style.css')}}">
  <!-- ======= END MAIN STYLES ======= -->

  <!-- ======= TOASTER CSS======= -->
  <link rel="stylesheet" href="{{asset('/public/backend/assets/css/toaster.min.css')}}">
  <!-- ======= TOASTER CSS======= -->
</head>

<body>

  @yield('main_content')

  <!-- Footer -->
  <footer class="footer style--two">
      {!! xss_clean($settings_details['copyright_text']) !!}
  </footer>
  <!-- End Footer -->

  <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
  <script src="{{asset('/public/backend/assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('/public/backend/assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('/public/backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('/public/backend/assets/js/script.js')}}"></script>
  <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

  <!-- ======= TOASTER ======= -->
  <script src="{{asset('/public/backend/assets/js/toaster.min.js')}}"></script>
  {!! Toastr::message() !!}
  <!-- ======= TOASTER ======= -->
</body>

</html>