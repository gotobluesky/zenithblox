@php
    $settings_details = getGeneralSettingsDetails(); 
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Page Title -->
    <title>@yield('error_title')</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/public/backend/assets/img/favicon.png') }}">

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">

    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/fonts/icofont/icofont.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/public/backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css') }}">
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/css/light/style.css') }}">
    <!-- ======= END MAIN STYLES ======= -->
</head>

<body>
    <div class="mn-vh-100 d-flex align-items-center mx-1350">
        <div class="container-fluid">
            <!-- Card -->
            <div class="card justify-content-center py-5 px-4">
                <div class="row justify-content-center my-5 pt-4">
                    <div class="col-xl-12 text-center">
                        @yield('error_master')
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer style--two">
        {!! xss_clean($settings_details['copyright_text']) !!}
    </footer>
    <!-- End Footer -->
</body>

</html>
