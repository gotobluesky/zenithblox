@php
    $active_theme = getActiveTheme();
    $single_blog_page = getThemeOption('single_blog_page', $active_theme->id);
    
    $single_blog_page_layout = 'single_blog_page_layout3';
    $blog_title_position = 'below_thumbnail';
    $blog_title = front_translate('Blog Details');
    $is_author = true;
    $is_date = true;
    $is_reading_time = true;
    $is_category = true;
    $is_tags = true;
    $is_comments = true;
    $is_biography = true;
    
    if (isset($single_blog_page['custom_single_blog_style']) && $single_blog_page['custom_single_blog_style'] == 1) {
        // page layout
        if (isset($single_blog_page['single_blog_page_layout']) && $single_blog_page['single_blog_page_layout'] != '') {
            $single_blog_page_layout = $single_blog_page['single_blog_page_layout'];
        }
        // title position
        if (isset($single_blog_page['blog_post_title_position'])) {
            if ($single_blog_page['blog_post_title_position'] == 'on_header') {
                $blog_title_position = 'on_header';
            } elseif ($single_blog_page['blog_post_title_position'] == 'below_thumbnail') {
                $blog_title = isset($single_blog_page['blog_details_custom_title']) ? $single_blog_page['blog_details_custom_title'] : '';
            }
        }
        $is_author = isset($single_blog_page['author']) && $single_blog_page['author'] == 1 ? true : false;
        $is_date = isset($single_blog_page['date']) && $single_blog_page['date'] == 1 ? true : false;
        $is_reading_time = isset($single_blog_page['reading_time']) && $single_blog_page['reading_time'] == 1 ? true : false;
        $is_category = isset($single_blog_page['category']) && $single_blog_page['category'] == 1 ? true : false;
        $is_tags = isset($single_blog_page['tags']) && $single_blog_page['tags'] == 1 ? true : false;
        $is_comments = isset($single_blog_page['comments']) && $single_blog_page['comments'] == 1 ? true : false;
        $is_biography = isset($single_blog_page['biography_info']) && $single_blog_page['biography_info'] == 1 ? true : false;
    }
    
    // title css
    $page_options = themeOptionToCss('page', $active_theme->id);
    $page_title_tag = 'h1';
    $is_title = true;
    $is_breadcrumb = true;
    $overlay = '';
    if (isset($page_options['condition']['custom_page_c']) && $page_options['condition']['custom_page_c'] == '1') {
        $page_title_tag = isset($page_options['static']['page_title_tag_s']) ? $page_options['static']['page_title_tag_s'] : 'h1';
        $is_breadcrumb = isset($page_options['condition']['breadcrumb_hide_show_c']) && $page_options['condition']['breadcrumb_hide_show_c'] == '1' ? true : false;
        $is_title = isset($page_options['condition']['page_title_c']) && $page_options['condition']['page_title_c'] == '1' ? true : false;
        $overlay = isset($page_options['condition']['overlay_c']) && $page_options['condition']['overlay_c'] == '1' ? 'bg-overlay' : '';
    }
    
    $blog_name = $blog->translation('name', getLocale());
    $blog_content = $blog->translation('content', getLocale());
    //biography section data
    $social_options = getThemeOption('social', $active_theme->id);
    $socials = null;
    if (isset($social_options['social_field']) && $social_options['social_field'] != '') {
        $socials = json_decode($social_options['social_field']);
    }
    $author = \Core\Models\User::with('info:*')
        ->where('id', $blog->user_id)
        ->first();
    $author_name = isset($author->name) ? $author->name : '';
    $author_image = isset($author->image) ? $author->image : null;
    $author_short_desc = isset($author->info->bio) ? $author->info->bio : '';
    $socials = isset($author->info->custom_social) && $author->info->custom_social != 0 && isset($author->info->social) ? json_decode($author->info->social) : $socials;
@endphp
@extends('theme/default::frontend.layout.master')

@section('seo')
    <title>{{ front_translate('Blog Preview') }}</title>
    <meta name="title" content="{{ $blog->meta_title }}">
    <meta name="description" content="{{ $blog->meta_description }}">
    <meta name="keywords" content="{{ getGeneralSetting('site_meta_keywords') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $blog->meta_title }}">
    <meta property="og:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:card" content="{{ $blog->meta_title }}">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:image" content="{{ $blog->meta_image ? getFilePath($blog->meta_image) : '' }}">
    <meta property="og:image" content="{{ $blog->meta_image ? getFilePath($blog->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
@endsection

@section('custom-css')
@endsection

@section('content')
    <!-- Page title -->
    <div class="page-title {{ $overlay }}">
        <div class="container">
            @if ($is_title)
                <!-- Title Tag -->
                @php
                    $title = $blog_title_position == 'on_header' ? $blog_name : $blog_title;
                @endphp
                {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                <!-- Title Tag -->
            @endif

            @if ($is_breadcrumb)
                <ul class="nav">
                    <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Home') }}</a></li>
                    <li class="active">{{ $blog_name }}</li>
                </ul>
            @endif
        </div>
    </div>
    <!-- End of Page title -->

    <div class="container pt-120">
        <div class="row">
            <div
                class="{{ $single_blog_page_layout == 'single_blog_page_layout1' ? 'col-lg-12' : 'col-lg-8' }} {{ $single_blog_page_layout == 'single_blog_page_layout2' ? 'order-2' : 'order-1' }} pb-80">
                <div class="post-details-cover">
                    <!-- Post Thumbnail -->
                    <div class="post-thumb-cover">
                        @isset($blog->image)
                            <div class="post-thumb d-flex justify-content-center">
                                <img src="{{ asset(getFilePath($blog->image)) }}" alt="" class="img-fluid">
                            </div>
                        @endisset

                        <!-- Post Meta Info -->
                        <div class="post-meta-info">
                            @if ($is_category)
                                <!-- Category -->
                                <p class="cats">
                                    <a href="{{ route('theme.default.blogByFeatured') }}">
                                        {{ $blog->is_featured == 1 ? 'Featured ,' : '' }}
                                    </a>
                                    {{-- Checking if blog category id exists --}}
                                    @if (isset($blog->category))
                                        {{-- Foreachloop for Category Id start --}}
                                        @foreach ($blog->category as $item)
                                            @php
                                                // Finding the category by Id
                                                $cat = Core\Models\TlBlogCategory::where('id', $item)->first();
                                            @endphp
                                            @if ($cat->is_publish == 1)
                                                <a href="{{ route('theme.default.blogByCategory', $cat->permalink) }}"
                                                    class="mr-1">{{ $cat->translation('name', getLocale()) }}</a>
                                            @endif 
                                            @if (!$loop->last)
                                                ,
                                            @endif 
                                        @endforeach
                                        {{-- Foreachloop for Category Id end --}}
                                    @endif
                                </p>
                            @endif


                            <!-- Title -->
                            @if ($blog_title_position != 'on_header')
                                <div class="title">
                                    <h2>{{ $blog_name }}</h2>
                                </div>
                            @endif

                            <!-- Meta -->
                            <ul class="nav meta align-items-center">
                                @if ($is_author)
                                    <li class="meta-author">
                                        <img src="{{ asset(getFilePath($author_image)) }}" alt="{{ $author_name }}"
                                            class="img-fluid">
                                        <a href="javascript:;void(0)">{{ $author_name }}</a>
                                    </li>
                                @endif

                                @if ($is_date)
                                    <li class="meta-date">{{ getFormatedDateTime($blog->publish_at, 'd-m-y') }}</li>
                                @endif

                                @if ($is_reading_time)
                                    <li> {{ $blog->reading_time }} </li>
                                @endif

                                @if ($is_comments)
                                    @php
                                        $blog_comment = Core\Models\TlBlog::where('id', $blog->id)->first()->allblogComment;
                                    @endphp
                                    <li class="meta-comments"><i class="fa fa-comment mr-1"></i><span
                                            id="meta_comment_count">{{ count($blog_comment) }}</span></li>
                                @endif
                            </ul>
                        </div>
                        <!-- End of Post Meta Info -->
                    </div>
                    <!-- End oF Post Thumbnail -->

                    @if ($blog->visibility == 'password')
                        {{-- Password Section --}}
                        <section class="my-5" id="password_box">
                            <div class="nl-bg-ol"></div>
                            <div class="container">
                                <div class="newsletter pt-40 pb-40">
                                    <div class="text-center mb-4">
                                        <h3>
                                            {{ front_translate('This Blog is Password protected. Please Enter The Correct Password To Read The Blog Content.') }}
                                        </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 offset-lg-1">
                                            <form action="javascript:void(0)" id="blog_password_form">
                                                <div class="input-group">
                                                    <input type="hidden" name="permalink"
                                                        value="{{ $blog->permalink }}">
                                                    <input type="password" class="form-control" id="password"
                                                        name="password"
                                                        placeholder="{{ front_translate('Enter Blog Password') }}">
                                                </div>
                                            </form>
                                            <span class="text-danger my-2" id="password_message"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        {{-- Password Section End --}}

                        <div class="post-content-cover my-drop-cap" id="blog_content"></div>
                    @else
                        <!-- Blog Content -->
                        <div class="post-content-cover my-drop-cap">
                            {!!  xss_clean(fix_image_urls($blog_content)) !!}
                        </div>
                        <!-- End of Blog Content -->
                    @endif

                    @if ($is_tags)
                        <!-- Tags -->
                        <div class="post-all-tags">
                            {{-- Checking if tag id --}}
                            @if (isset($blog->tag))
                                {{-- Foreachloop for Tag Id start --}}
                                @foreach ($blog->tag as $item)
                                    @php
                                        // Finding the category by Id
                                        $tag = Core\Models\TlBlogTag::where('id', $item)->first();
                                    @endphp
                                    @if ($tag->is_publish == 1)
                                        <a href="{{ route('theme.default.blogByTag', $tag->permalink) }}">
                                            {{ $tag->translation('name', getLocale()) }}
                                        </a>
                                    @endif
                                @endforeach
                                {{-- Foreachloop for Category Id end --}}
                            @endif
                        </div>
                        <!-- End of Tags -->
                    @endif

                    @if ($is_biography)
                        <!-- Author Box -->
                        <div class="post-about-author-box">
                            <div class="author-avatar">
                                <img src="{{ asset(getFilePath($author_image)) }}" alt="" class="img-fluid">
                            </div>
                            <div class="author-desc">
                                <h5> <a href="javascript:;void(0)"> {{ $author_name }}</a> </h5>
                                <div class="description">{{ $author_short_desc }}</div>
                                <div class="social-icons">
                                    @isset($socials)
                                        @foreach ($socials as $social)
                                            @if ($social->social_icon != '')
                                                <a href="{{ $social->social_icon_url }}"><i
                                                        class="fa {{ $social->social_icon }}"></i></a>
                                            @endif
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <!-- End of Author Box -->
                    @endif
                </div>
            </div>

            @if ($single_blog_page_layout != 'single_blog_page_layout1')
                <div
                    class="col-lg-4 {{ $single_blog_page_layout == 'single_blog_page_layout2' ? 'order-1' : 'order-2' }} pb-90">
                    @includeIf('theme/default::frontend.includes.sidebar.sidebar', [
                        'type' => 'blog_sidebar',
                    ])
                </div>
            @endif
        </div>
    </div>

@endsection

@section('custom-js')
    {{-- Cookies Js --}}
    <script src="{{ asset('/public/backend/assets/plugins/js-cookie/js.cookie.min.js') }}"></script>
    <script>
        (function($) {
            'use strict';
            let page = '';

            $(document).ready(function() {
                // if blog is password protected then hiding whats necessary
                if ("{{ $blog->visibility }}" == 'password') {
                    $('#blog_content').hide();
                }

                // get blog content on right password and setting cookie    
                $('#password').on('keypress', function(e) {
                    //checking if a user hit enter
                    if (e.which === 13) {
                        let formData = $('#blog_password_form').serializeArray();
                        // extra field to check if user already got content and here is false
                        formData.push({
                            name: 'is_authenticate',
                            value: 'false'
                        });
                        getBlogContent(formData);
                    }
                });

            });

            // blog category change
            $(document).on('change', '#category_field', function() {
                let value = $('#category_field option:selected').val();
                if (value) {
                    var url = '{{ route('theme.default.blogByCategory', 'permalink') }}';
                    url = url.replace("permalink", value);
                    window.location.href = url;
                }
            });


            // Get Blog Content For Password Protected Blog
            function getBlogContent(formData) {
                $.ajax({
                    type: "post",
                    url: '{{ route('theme.default.password.load') }}',
                    data: formData,
                    success: function(res) {
                        if (res.success) {
                            $('#blog_content').show();
                            $('#blog_content').html(res.content);
                            $('#password_box').remove();
                        } else {
                            toastr.error(res.error, "Error!");
                        }
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error("Content Request Failed", "Error!");
                    }
                });
            }

        })(jQuery);
    </script>
@endsection
