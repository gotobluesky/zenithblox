<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (trim($__env->yieldContent('template_title')))
            @yield('template_title')
        @endif
    </title>
    <link rel="icon" type="image/png" href="{{ asset('public/installer/img/favicon/favicon.png') }}" sizes="16x16" />

    <link href="{{ asset('public/installer/css/style.css') }}" rel="stylesheet" />
    <style>
        .fa-spinner {
            margin-left: 5px;
        }
    </style>
    @yield('style')
</head>

<body>
    <div class="master">
        <div class="box">
            <div class="header">
                <h1 class="header__title">@yield('title')</h1>
            </div>
            <ul class="step">
                <li class="step__divider"></li>
                <li class="step__item {{ Request::routeIs('install.user.registration') ? 'active ' : '' }}">
                    @if (Request::routeIs('install.user.registration'))
                        <a href="{{ route('install.user.registration') }}">
                            <i class="step__icon fa fa-user" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-user" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ Request::routeIs('install.database.import') ? 'active ' : '' }}">
                    @if (Request::routeIs('install.user.registration') || Request::routeIs('install.database.import'))
                        <a href="{{ route('install.database.import') }}">
                            <i class="step__icon fa fa-file-o" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-file-o" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ Request::routeIs('install.database') ? 'active ' : '' }}">
                    @if (Request::routeIs('install.user.registration') ||
                            Request::routeIs('install.database') ||
                            Request::routeIs('install.database.import'))
                        <a href="{{ route('install.database') }}">
                            <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ Request::routeIs('install.permissions') ? 'active ' : '' }}">
                    @if (Request::routeIs('install.user.registration') ||
                            Request::routeIs('install.database') ||
                            Request::routeIs('install.permissions') ||
                            Request::routeIs('install.database.import'))
                        <a href="{{ route('install.permissions') }}">
                            <i class="step__icon fa fa-key" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-key" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ Request::routeIs('install.requirements') ? 'active ' : '' }}">
                    <a href="{{ route('install.requirements') }}">
                        <i class="step__icon fa fa-list" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ Request::routeIs('install.welcome') ? 'active ' : '' }}">
                    <a href="{{ route('install.welcome') }}">
                        <i class="step__icon fa fa-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="step__divider"></li>
            </ul>
            <div class="main">
                @if (session('message'))
                    <p class="alert text-center">
                        <strong>
                            @if (is_array(session('message')))
                                {{ session('message')['message'] }}
                            @else
                                {{ session('message') }}
                            @endif
                        </strong>
                    </p>
                @endif
                @yield('container')
            </div>
        </div>
    </div>
    <script src="{{ asset('/public/backend/assets/js/jquery.min.js') }}"></script>
    <script>
        var zyllemMain = (function() {
            function processSubmitLoader() {
                $('.process-btn').click(function(e) {
                    var $this = $(this);
                    let formId = $this.data("spinning-button");
                    let $form = formId ? $("#" + formId) : $this.parents("form");
                    if ($form.length) {
                        $this
                            .append("<i class='fa fa-spinner fa-spin'></i>")
                            .attr("disabled", "");
                        setTimeout(() => {
                            $form.submit();
                        }, 3000);
                    }
                });
            }
            return {
                initSpinnerButton: processSubmitLoader
            };
        })();

        $(document).ready(function() {
            zyllemMain.initSpinnerButton();
        });
    </script>
    @yield('scripts')
</body>

</html>
