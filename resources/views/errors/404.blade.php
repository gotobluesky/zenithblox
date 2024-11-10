@php
    $generalSettings = getGeneralSettingsDetails();
    $active_theme = getActiveTheme();
    $preloader = getThemeOption('preloader', $active_theme->id);
    $header = getThemeOption('header', $active_theme->id);
    $contact = getThemeOption('contact', $active_theme->id);
    $body_typography = themeOptionToCss('body_typography', $active_theme->id);
    $paragraph_typography = themeOptionToCss('paragraph_typography', $active_theme->id);
    $heading_typography = themeOptionToCss('heading_typography', $active_theme->id);
    $menu_typography = themeOptionToCss('menu_typography', $active_theme->id);
    $button_typography = themeOptionToCss('button_typography', $active_theme->id);
    $theme_color = getThemeOption('theme_color', $active_theme->id);
    
    // 404 page styles
    $page_404 = getThemeOption('page_404', $active_theme->id);
    $title = '404';
    $subtitle = translate('Page Not Found!');
    $before_button_text = translate('The page you are looking for was moved, removed, renamed or never existed. Please check the url or go to');
    $before_button = translate('Main Page.');
    
    if (isset($page_404['custom_404_page_c']) && $page_404['custom_404_page_c'] == 1) {
        $title = $page_404['page_404_title_s'];
        $subtitle = $page_404['page_404_subtitle_s'];
        $before_button_text = $page_404['page_404_button_before_text_s'];
        $before_button = $page_404['page_404_button_text_s'];
    }
    
    $mood = 'light';
    if (session()->has('frontend-mood')) {
        $mood = session()->get('frontend-mood');
    }
    $rtl = getActiveFrontLangRTL();
    
    $primary_color = $theme_color['theme_primary_color'] != null ? str_replace('#', '', $theme_color['theme_primary_color']) : 'ff7171';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <!-- Document Title -->
    <title>404</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png"
        href="{{ isset($generalSettings['favicon']) ? project_asset($generalSettings['favicon']) : '' }}">

    <!--==== Google Fonts ====-->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500%7CSpectral:400,400i,500,600,700"
        rel="stylesheet">

    <!-- CSS Files -->

    <!--==== Bootstrap css file ====-->
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/bootstrap.min.css') }} ">

    <!--==== Font-Awesome css file ====-->
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/font-awesome.min.css') }}">

    <!--==== Style css file ====-->
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/style.css') }}">
    @if ($theme_color['theme_primary_color'] != null)
        <link rel="stylesheet"
            href="{{ asset('themes/default/public/assets/css/theme-color.php') }}?color={{ $primary_color }}">
    @endif

    <!-- Including all google fonts link -->
    @includeIf('theme/default::frontend.includes.custom.google-font-link', [
        'body_typography' => $body_typography,
        'paragraph_typography' => $paragraph_typography,
        'heading_typography' => $heading_typography,
        'menu_typography' => $menu_typography,
        'button_typography' => $button_typography,
    ])

    <!-- Including all dynamic css -->
    @includeIf('theme/default::frontend.includes.custom.dynamic-css', [
        'body_typography' => $body_typography,
        'paragraph_typography' => $paragraph_typography,
        'heading_typography' => $heading_typography,
        'menu_typography' => $menu_typography,
        'button_typography' => $button_typography,
    ])
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/header_logo.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/mobile_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/page_404.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/custom_css.css') }}">
</head>

<body class="@if ($mood == 'dark') dark @endif @if ($rtl) rtl-mode @endif ">
    <!-- Preloader -->
    @if (isset($preloader['preloader_field']) && $preloader['preloader_field'] == 1)
        <div class="preloader">
            <div class="preload-img">
                @if (isset($preloader['preloader_style_type']) && $preloader['preloader_style_type'] == 'custom')
                    @if (isset($preloader['custom_preloader_type']) &&
                            $preloader['custom_preloader_type'] == 'image' &&
                            isset($preloader['preloader_image']))
                        <img src="{{ getFilePath($preloader['preloader_image']) }}" alt="Preloader Image"
                            class="pre-img svg">
                    @endif
                    @if (isset($preloader['custom_preloader_type']) &&
                            $preloader['custom_preloader_type'] == 'text' &&
                            isset($preloader['preloader_html']))
                        {!! xss_clean($preloader['preloader_html']) !!}
                    @endif
                @else
                    <div class="spinnerBounce">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <!-- End of Preloader -->

    <!-- Nav Search Box -->
    <div class="nav-search-box">
        <form id="nav-search-form">
            <div class="input-group">
                <input type="text" class="form-control search-text"
                    placeholder="{{ front_translate('Search Here') }}">
                <span class="b-line"></span>
                <span class="b-line-under"></span>
                <div class="input-group-append">
                    <button type="button" class="btn">
                        <img src="{{ asset('themes/default/public/assets/images/search-icon.svg') }}" alt=""
                            class="img-fluid svg">
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- End of Nav Search Box -->

    @includeIf('theme/default::frontend.layout.header', [
        'header' => $header,
        'logo_details' => $generalSettings,
        'contact' => $contact,
    ])

    <div class="container pt-40 pb-80 container-404 text-center d-flex align-items-center overlay" id="section_404">
        <div class="data">
            <h1 class="title">{{ front_translate($title) }}</h1>
            <h2 class="subtitle">{{ front_translate($subtitle) }}</h2>
            <p class="before_button_text"> {{ front_translate($before_button_text) }} <a
                    href="{{ route('theme.default.home') }}"
                    class="before_button">{{ front_translate($before_button) }}</a></p>
        </div>
    </div>

    <!-- Dark Light Switcher -->
    <div class="floating-mode-switcher-wrap">
        <label class="dl-switch">
            <input class="darklooks-mode-changer" type="checkbox" @checked($mood == 'dark')>
            <span class="dl-slider"></span>
            <span class="dl-light">Light</span>
            <span class="dl-dark">Dark</span>
        </label>
    </div>
    <!-- End Dark Light Switcher -->


    <!-- ==== JQuery 3.6.4 js file ==== -->
    <script src="{{ asset('themes/default/public/assets/js/jquery.min.js') }}"></script>

    <!-- ==== Owl Carousel ==== -->
    <script src="{{ asset('themes/default/public/assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>

    <!-- ==== Magnific Popup ==== -->
    <script src="{{ asset('themes/default/public/assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- ==== Script js file ==== -->
    <script src="{{ asset('themes/default/public/assets/js/scripts.js') }}"></script>

    <script>
        // setting up the csrf token for ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        (function($) {
            'use strict';
            $(document).ready(function() {

                /**
                 * Change dark mood
                 */
                $('.darklooks-mode-changer').on('click', function(e) {
                    e.preventDefault();
                    $.post('{{ route('theme.default.mood.change') }}', {}, function(data) {
                        location.reload();
                    })
                });
            });

        })(jQuery);
    </script>
</body>

</html>
