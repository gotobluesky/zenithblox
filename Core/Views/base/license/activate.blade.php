<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Page Title -->
    <title>{{ translate('License activate') }}</title>

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

    <div class="mn-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="card justify-content-center auth-card">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9">
                        <h4 class="mb-30 font-20">{{ translate('License Activate') }}</h4>
                        <form action="{{ route('core.license.key.verify') }}" method="post">
                            @csrf
                            @if (count($errors) > 0)
                                <div>
                                    <ul class="p-0">
                                        @foreach ($errors->all() as $error)
                                            <p class="alert alert-danger">{{ $error }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group mb-20">
                                <label class="mb-2 font-14 bold black">{{ translate('License Key') }}</label>
                                <input type="text" name="license" class="theme-input-style"
                                    placeholder="{{ translate('Enter License Key') }}">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit"
                                    class="btn long mr-20 rounded">{{ translate('Activate') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
    <script src="{{ asset('/public/backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/js/script.js') }}"></script>
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
</body>

</html>
