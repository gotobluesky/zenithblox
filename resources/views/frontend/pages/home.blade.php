@php
    $active_theme = getActiveTheme();
    $homepage = getThemeOption('home_page', $active_theme->id);
    $layout = $homepage['homepage_layout'];
    $generalSettings = getGeneralSettingsDetails();
    
    $title = $generalSettings['system_name'];
    $motto = $generalSettings['site_moto'];
    $rtl = getActiveFrontLangRTL();
@endphp
@extends('theme/default::frontend.layout.master')

@section('seo')
    {{-- SEO  --}}
    <title>{{ $title . '|' . $motto }}</title>
    <meta name="title" content="{{ $generalSettings['site_meta_title'] ? $generalSettings['site_meta_title'] : $title }}">
    <meta name="description" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="keywords" content="{{ $generalSettings['site_meta_keywords'] }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $generalSettings['site_meta_title'] }}">
    <meta property="og:description" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="twitter:card" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="twitter:title" content="{{ $generalSettings['site_meta_title'] }}">
    <meta name="twitter:description" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="twitter:image" content="{{ asset(getFilePath($generalSettings['site_meta_image'])) }}">
    <meta property="og:image" content="{{ asset(getFilePath($generalSettings['site_meta_image'])) }}">
@endsection

@section('custom-css')
    @if (isActivePluging('pagebuilder') && isset($page) && $page->page_type == 'builder')
        @php
            $builder_css_file = base_path("themes/{$active_theme->location}/public/builder-assets/css/{$page->permalink}.css");
            $builder_css_path = asset("themes/{$active_theme->location}/public/builder-assets/css/{$page->permalink}.css");
        @endphp
        @if (file_exists($builder_css_file))
            <link rel="stylesheet" href="{{ $builder_css_path.'?v='.time() }}">
        @endif
    @else
        {!! homePageCss($sections) !!}
    @endif
@endsection

@section('content')

    @if (isset($page))
        @if (isActivePluging('pagebuilder') && $page->page_type == 'builder')
            @includeIf('plugin/pagebuilder::builders.builder-section', ['page_sections' => $page_sections])
        @else
            <div class="container">
                <div class="row">
                    <div class="{{ $layout == 'full_layout' ? 'col-lg-12' : 'col-lg-8' }} {{ $layout == 'left_sidebar_layout' ? 'order-2' : 'order-1' }}"
                        id="page_section">
                        @if ($page->visibility == 'password')
                            {{-- Password Section --}}
                            <section class="my-5" id="password_box">
                                <div class="nl-bg-ol"></div>
                                <div class="container">
                                    <div class="newsletter pt-40 pb-40">
                                        <div class="text-center mb-4">
                                            <h3>
                                                {{ front_translate('This Page is Password protected. Please Enter The Correct Password To See This Page.') }}
                                            </h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10 offset-lg-1">
                                                <form action="javascript:void(0)" id="page_password_form">
                                                    <div class="input-group">
                                                        <input type="hidden" name="permalink"
                                                            value="{{ $page->permalink }}">
                                                        <input type="password" class="form-control" id="page_password"
                                                            name="password"
                                                            placeholder="{{ front_translate('Enter Page Password') }}">
                                                    </div>
                                                </form>
                                                <span class="text-danger my-2" id="password_message"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            {{-- Password Section End --}}
                        @endif
                        <div id="page_details">
                            <div class="page-thumb">
                                @if (isset($page->page_image))
                                    <img src="{{ asset(getFilePath($page->page_image)) }}" alt=""
                                        class="img-fluid">
                                @endif
                            </div>
                            <div class="page_content">
                                {{-- Page Content --}}
                                {!! xss_clean(fix_image_urls($page->translation('content', getLocale()))) !!}
                                {{-- Page Content End --}}
                            </div>
                        </div>
                    </div>

                    @if ($layout != 'full_layout')
                        <div class="col-lg-4 {{ $layout == 'left_sidebar_layout' ? 'order-1' : 'order-2' }}">
                            @includeIf('theme/default::frontend.includes.sidebar.sidebar', [
                                'type' => 'home_page_sidebar',
                            ])
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @else
        <!-- Banner -->
        @include('theme/default::frontend.includes.sections.slider-section', [
            'properties' => $sections[$slider_id],
            'id' => $slider_id,
        ])
        <!-- End of Banner -->

        <div class="container pt-120 pb-90">
            <div class="row">
                <div class="{{ $layout == 'full_layout' ? 'col-lg-12' : 'col-lg-8' }} {{ $layout == 'left_sidebar_layout' ? 'order-2' : 'order-1' }}"
                    id="homepage_section">
                    @foreach ($sections as $key => $properties)
                        @if ($properties['layout'] !== 'slider')
                            @if ($properties['layout'] == 'ads')
                                @include('theme/default::frontend.includes.sections.ads-section', [
                                    'properties' => $properties,
                                    'id' => $key,
                                ])
                            @else
                                @include('theme/default::frontend.includes.sections.blog-section', [
                                    'properties' => $properties,
                                    'id' => $key,
                                ])
                            @endif
                        @endif
                    @endforeach
                </div>

                @if ($layout != 'full_layout')
                    <div class="col-lg-4 {{ $layout == 'left_sidebar_layout' ? 'order-1' : 'order-2' }}">
                        @includeIf('theme/default::frontend.includes.sidebar.sidebar', [
                            'type' => 'home_page_sidebar',
                        ])
                    </div>
                @endif
            </div>
        </div>
    @endif

@endsection

@section('custom-js')
    <script src="{{ asset('/public/backend/assets/plugins/js-cookie/js.cookie.min.js') }}"></script>
        @php
            $isPage = isset($page) ? 'true' : 'false';
            $visibility = $isPage == 'true' ? $page->visibility : 'false';
            $permalink = $isPage == 'true' ? $page->permalink : 'false';
        @endphp
    <script>
        (function($) {
            'use strict';

            $(document).ready(function() {
                let isPage = '<?php echo($isPage); ?>';

                if (isPage == 'true') {
                    // if page is password protected then remove the contents
                    let visibility = '<?php echo($visibility); ?>';
                    let permalink = '<?php echo($permalink); ?>';

                    if (visibility == 'password') {
                        var page_details = $('#page_details').detach();
                    }

                    // checking if page cookie is available and getting it (For password protected page)
                    if (Cookies.get(permalink)) {
                        $('#password_box').remove();
                        $('#page_section').append(page_details);
                    }

                    // if the blog is password protected
                    $('#page_password').on('keypress', function(e) {
                        if (e.which === 13) {
                            var formData = $('#page_password_form').serializeArray();
                            $.ajax({
                                type: "post",
                                url: '{{ route('theme.default.page.password.load') }}',
                                data: formData,
                                success: function(res) {
                                    if (res.success) {
                                        $('#password_box').remove();
                                        $('#page_section').append(page_details);
                                        // Cookies expired on 1 day
                                        Cookies.set(permalink, JSON
                                            .stringify({
                                                page: permalink
                                            }), {
                                                expires: 1,
                                                path: '{{ env('APP_URL') }}'
                                            });
                                    } else {
                                        toastr.error(res.error,
                                            "{{ front_translate('Error!') }}");
                                    }
                                },
                                error: function(data, textStatus, jqXHR) {
                                    toastr.error("Content Request Failed",
                                        "{{ front_translate('Error!') }}");
                                }
                            });
                        }
                    });
                }
            })

            // Banner Slider Carousal Initialize
            let RTL = false;
            if ('{{ $rtl }}') {
                RTL = true;
            }

            // Slider Banner Carousel
            let sync1 = $(".banner-slider");
            sync1
                .owlCarousel({
                    rtl: RTL,
                    items: 4,
                    slideSpeed: 2000,
                    autoplay: true,
                    loop: true,
                    responsiveRefreshRate: 200,
                    animateIn: false,
                    animateOut: false,
                    margin: 0,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        1024: {
                            items: 3
                        },
                        1440: {
                            items: 4
                        }
                    }
                });

            // blog category change
            $(document).on('change', '#category_field', function() {
                let value = $('#category_field option:selected').val();
                if (value) {
                    let url = '{{ route('theme.default.blogByCategory', 'permalink') }}';
                    url = url.replace("permalink", value);
                    window.location.href = url;
                }
            });

        })(jQuery);
    </script>
@endsection
