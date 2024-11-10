@php
    $active_theme = getActiveTheme();
    $rtl = getActiveFrontLangRTL();
    $page_options = themeOptionToCss('page', $active_theme->id);
    $page_title_tag = 'h1';
    $is_title = true;
    $is_breadcrumb = true;
    $overlay = '';
    $page_layout = 'no_sidebar';
    $page_sidebar = 'page_sidebar';
    if (isset($page_options['condition']['custom_page_c']) && $page_options['condition']['custom_page_c'] == '1') {
        $page_title_tag = isset($page_options['static']['page_title_tag_s']) ? $page_options['static']['page_title_tag_s'] : 'h1';
        $is_breadcrumb = isset($page_options['condition']['breadcrumb_hide_show_c']) && $page_options['condition']['breadcrumb_hide_show_c'] == '1' ? true : false;
        $is_title = isset($page_options['condition']['page_title_c']) && $page_options['condition']['page_title_c'] == '1' ? true : false;
        $overlay = isset($page_options['condition']['overlay_c']) && $page_options['condition']['overlay_c'] == '1' ? 'bg-overlay' : '';
        $page_layout = isset($page_options['condition']['page_layout_c']) && $page_options['condition']['page_layout_c'] != '' ? $page_options['condition']['page_layout_c'] : 'no_sidebar';
        $page_sidebar = isset($page_options['condition']['page_sidebar_setting_c']) && $page_options['condition']['page_sidebar_setting_c'] != '' ? $page_options['condition']['page_sidebar_setting_c'] : 'page_sidebar';
    }
@endphp
@extends('theme/default::frontend.layout.master')

@section('seo')
    <title>{{ front_translate('Page Preview') }}</title>
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta name="keywords" content="{{ getGeneralSetting('site_meta_keywords') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $page->meta_title }}">
    <meta property="og:description" content="{{ $page->meta_description }}">
    <meta name="twitter:card" content="{{ $page->meta_title }}">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:image" content="{{ $page->meta_image ? getFilePath($page->meta_image) : '' }}">
    <meta property="og:image" content="{{ $page->meta_image ? getFilePath($page->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
@endsection

@section('custom-css')
    @php
        $builder_css_file = base_path("themes/{$active_theme->location}/public/builder-assets/css/{$page->permalink}.css");
        $builder_css_path = asset("themes/{$active_theme->location}/public/builder-assets/css/{$page->permalink}.css");
    @endphp
    @if (isActivePluging('pagebuilder') && $page->page_type == 'builder' && file_exists($builder_css_file))
        <link rel="stylesheet" href="{{ $builder_css_path.'?v='.time() }}">
    @endif
@endsection

@section('content')
    @if (!(isActivePluging('pagebuilder') && $page->page_type == 'builder'))
        <!-- Page title -->
        <div class="page-title {{ $overlay }}">
            <div class="container">
                @if ($is_title)
                    <!-- Title Tag -->
                    @php $title = $page->translation('title', getLocale()); @endphp
                    {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                    <!-- Title Tag -->
                @endif

                @if ($is_breadcrumb)
                    <ul class="nav">
                        <!--core frontend to backend-->
                        <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Home') }}</a></li>
                        @php
                            $parentUrl = getParentUrl($page);
                            $parents = preg_split('#/#', $parentUrl, -1, PREG_SPLIT_NO_EMPTY);
                        @endphp
                        @if (count($parents))
                            @for ($i = 0; $i < count($parents); $i++)
                                @php
                                    $parent = Core\Models\TlPage::where('permalink', $parents[$i])->first();
                                @endphp
                                <li>
                                    <a
                                        href="{{ route('theme.default.viewPage', ['permalink' => getParentUrl($parent) . $parent->permalink]) }}">{{ $parent->translation('title', getLocale()) }}</a>
                                </li>
                            @endfor
                        @endif
                        <li class="active">{{ $page->translation('title', getLocale()) }}</li>
                    </ul>
                @endif
            </div>
        </div>
        <!-- End of Page title -->
    @endif

    <div class="pt-120 pb-120">
        @if (isActivePluging('pagebuilder') && $page->page_type == 'builder')
            @includeIf('plugin/pagebuilder::builders.builder-section', ['page_sections' => $page_sections])
        @else
            <div class="container">
                <div class="row">
                    <div class="{{ $page_layout == 'no_sidebar' ? 'col-lg-12' : 'col-lg-8' }} {{ $page_layout == 'left_sidebar' ? 'order-2' : 'order-1' }}"
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

                    @if ($page_layout != 'no_sidebar')
                        <div class="col-lg-4 {{ $page_layout == 'left_sidebar' ? 'order-1' : 'order-2' }}">
                            @includeIf('theme/default::frontend.includes.sidebar.sidebar', [
                                'type' => $page_sidebar,
                            ])
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

@endsection

@section('custom-js')
    {{-- Cookies Js --}}
    <script src="{{ asset('/public/backend/assets/plugins/js-cookie/js.cookie.min.js') }}"></script>
    <script>
        (function($) {
            'use strict';
            $(document).ready(function() {
                let page_details;
                // if page is password protected then remove the contents
                if ('{{ $page->visibility }}' == 'password') {
                    page_details = $('#page_details').detach();
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
                                } else {
                                    toastr.error(res.error, "Error!");
                                }
                            },
                            error: function(data, textStatus, jqXHR) {
                                toastr.error("Content Request Failed", "Error!");
                            }
                        });
                    }
                });

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


            });
        })(jQuery);
    </script>
@endsection
