@php
    // Setting Theme Options
    $active_theme = getActiveTheme();
    $single_blog_page = getThemeOption('single_blog_page', $active_theme->id);
    $rtl = getActiveFrontLangRTL();
    
    $single_blog_page_layout = 'single_blog_page_layout3';
    $blog_title_position = 'below_thumbnail';
    $blog_title = front_translate('Blog Details');
    $is_author = true;
    $is_date = true;
    $is_reading_time = true;
    $is_category = true;
    $is_tags = true;
    $is_comments = true;
    $is_blog_share = true;
    $is_biography = true;
    $is_related = true;
    $related_title = front_translate('Related Blogs');
    $related_count = 2;
    
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
                $blog_title = front_translate($blog_title);
            }
        }
        // is related post
        if (isset($single_blog_page['related_blogs']) && $single_blog_page['related_blogs'] == 1) {
            $related_title = isset($single_blog_page['section_title']) ? front_translate($single_blog_page['section_title']) : '';
            $related_count = isset($single_blog_page['blog_count']) && $single_blog_page['blog_count'] != 0 ? $single_blog_page['blog_count'] : 2;
        } else {
            $is_related = false;
        }
        $is_author = isset($single_blog_page['author']) && $single_blog_page['author'] == 1 ? true : false;
        $is_date = isset($single_blog_page['date']) && $single_blog_page['date'] == 1 ? true : false;
        $is_reading_time = isset($single_blog_page['reading_time']) && $single_blog_page['reading_time'] == 1 ? true : false;
        $is_category = isset($single_blog_page['category']) && $single_blog_page['category'] == 1 ? true : false;
        $is_tags = isset($single_blog_page['tags']) && $single_blog_page['tags'] == 1 ? true : false;
        $is_comments = isset($single_blog_page['comments']) && $single_blog_page['comments'] == 1 ? true : false;
        $is_blog_share = isset($single_blog_page['blog_share']) && $single_blog_page['blog_share'] == 1 ? true : false;
        $is_biography = isset($single_blog_page['biography_info']) && $single_blog_page['biography_info'] == 1 ? true : false;
    }
    
    // title css
    $page_options = themeOptionToCss('page', $active_theme->id);
    $page_title_tag = 'h2';
    $is_title = true;
    $is_breadcrumb = true;
    $overlay = '';
    if (isset($page_options['condition']['custom_page_c']) && $page_options['condition']['custom_page_c'] == '1') {
        $page_title_tag = isset($page_options['static']['page_title_tag_s']) ? $page_options['static']['page_title_tag_s'] : 'h1';
        $is_breadcrumb = isset($page_options['condition']['breadcrumb_hide_show_c']) && $page_options['condition']['breadcrumb_hide_show_c'] == '1' ? true : false;
        $is_title = isset($page_options['condition']['page_title_c']) && $page_options['condition']['page_title_c'] == '1' ? true : false;
        $overlay = isset($page_options['condition']['overlay_c']) && $page_options['condition']['overlay_c'] == '1' ? 'bg-overlay' : '';
    }
    
    $blog_name = $blog->name;
    $blog_content = $blog->content;
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
    {{-- SEO --}}
    <title>{{ $blog_name }}</title>
    <meta name="title" content="{{ $blog->meta_title }}">
    <meta name="description" content="{{ $blog->meta_description }}">
    <meta name="keywords" content="{{ getGeneralSetting('site_meta_keywords') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $blog->meta_title }}">
    <meta property="og:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:card" content="{{ $blog->meta_title }}">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:image" content="{{ $blog->meta_image ? asset(getFilePath($blog->meta_image)) : '' }}">
    <meta property="og:image" content="{{ $blog->meta_image ? asset(getFilePath($blog->meta_image)) : '' }}">
    <meta property="og:image:width" content="1200">
@endsection

@section('custom-css')
    <style>
        .related-blogs-title h2{
            font-size: 26px !important;
        }
    </style>
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
                    <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Blogs') }}</a></li>
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
                <div class="post-details-cover @if ($blog->formate === 'gallery') post-has-slide-thumb @endif">
                    <!-- Post Thumbnail -->
                    <div class="post-thumb-cover">
                        @if ($blog->formate === 'gallery' && $blog->gallery_images != null)
                            @php
                                $images = explode(',', $blog->gallery_images);
                                if ($blog->image != null) {
                                    $images[] = $blog->image;
                                }
                            @endphp
                            <div class="post-thumb owl-carousel">
                                @foreach (arraY_reverse($images) as $key => $value)
                                    <img src="{{ asset(getFilePath($value)) }}" alt="Post Images" class="img-fluid">
                                @endforeach
                            </div>
                        @else
                            @if ($blog->image != null)
                                <div class="post-thumb d-flex justify-content-center">
                                    <img src="{{ asset(getFilePath($blog->image)) }}" alt="Post Images" class="img-fluid">
                                </div>
                            @endif
                        @endif

                        <!-- Post Meta Info -->
                        <div class="post-meta-info">
                            @if ($is_category)
                                <!-- Category -->
                                <p class="cats">
                                    @if ($blog->is_featured == 1)
                                        <a href="{{ route('theme.default.blogByFeatured') }}">
                                            {{ front_translate('Featured') . ' ,' }}
                                        </a>
                                    @endif

                                    {{-- Checking if blog category id exists --}}
                                    @if (count($blog->blog_category))
                                        @foreach ($blog->blog_category as $cat)
                                            <a href="{{ route('theme.default.blogByCategory', $cat->permalink) }}"
                                                class="mr-1">{{ $cat->name }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            </a>
                                        @endforeach
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
                                    @php
                                        $variation = getImageVariation($author_image, 'small');
                                        $author = str_replace(' ', '-', strtolower($author_name));
                                    @endphp
                                    <li class="meta-author">
                                        <img data-src="{{ $variation }}" alt="{{ $author_name }}"
                                            class="img-fluid lazy">
                                        <a
                                            href="{{ route('theme.default.blogByAuthor', $author) }}">{{ $author_name }}</a>
                                    </li>
                                @endif

                                @if ($is_date)
                                    <li class="meta-date"><a
                                            href="{{ route('theme.default.blogByDate', getFormatedDateTime($blog->publish_at, 'Y/m/d')) }}">{{ getFormatedDateTime($blog->publish_at, 'd M y') }}</a>
                                    </li>
                                @endif

                                @if ($is_reading_time)
                                    <li> {{ $blog->reading_time }} </li>
                                @endif

                                @if ($is_comments)
                                    <li class="meta-comments">
                                        <a href="#comments">
                                            <i class="fa fa-comment mx-1"></i><span
                                                id="meta_comment_count">{{ $blog->allblog_comment_count }}</span>
                                        </a>
                                    </li>
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
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <form action="javascript:void(0)" id="blog_password_form">
                                                <div class="input-group">
                                                    <input type="hidden" name="permalink" value="{{ $blog->permalink }}">
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
                            {!! xss_clean($blog_content) !!}
                        </div>
                        <!-- End of Blog Content -->
                    @endif

                    @if ($is_tags)
                        <!-- Tags -->
                        {{-- Checking if tag id --}}
                        @if (isset($blog->tag))
                            @php
                                $blog_tag = explode(',', $blog->tag);
                            @endphp
                            <div class="post-all-tags">
                                {{-- Foreachloop for Tag Id start --}}
                                @foreach ($blog_tag as $item)
                                    @php
                                        // Finding the category by Id
                                        $tag = Core\Models\TlBlogTag::where('id', $item)->first();
                                    @endphp
                                    @if ($tag->is_publish == 1)
                                        <a href="{{ route('theme.default.blogByTag', $tag->permalink) }}">
                                            {{ $tag->translation('name', getFrontLocale()) }}
                                        </a>
                                    @endif
                                @endforeach
                                {{-- Foreachloop for Category Id end --}}
                            </div>
                        @endif
                        <!-- End of Tags -->
                    @endif

                    @if ($is_blog_share)
                        <div class="mt-4">
                            @include('theme/default::frontend.includes.blog-share', [
                                'blog_shares' => $blog_shares,
                            ])
                        </div>
                    @endif

                    @if ($is_biography)
                        <!-- Author Box -->
                        <div class="post-about-author-box">
                            <div class="author-avatar">
                                <img src="{{ asset(getFilePath($author_image)) }}" alt="" class="img-fluid">
                            </div>
                            <div class="author-desc">
                                <h5> <a href="{{ route('theme.default.blogByAuthor', $author) }}">
                                        {{ $author_name }}</a>
                                </h5>
                                <div class="description">{{ front_translate($author_short_desc) }}</div>
                                <div class="social-icons">
                                    @isset($socials)
                                        @foreach ($socials as $social)
                                            @if ($social->social_icon != '')
                                                @php
                                                    $logo_url = $social->social_icon_url;
                                                    if ($social->social_icon_url === '' || $social->social_icon_url === '/') {
                                                        $logo_url = url('/') . $social->social_icon_url;
                                                    }
                                                @endphp
                                                <a href="{{ $logo_url }}"><i
                                                        class="fa {{ $social->social_icon }}"></i></a>
                                            @endif
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <!-- End of Author Box -->
                    @endif

                    <section id="comments">
                        <div class="comments_section">
                            <!-- Comments -->
                            <div id="blog_comment">
                            </div>
                            <!-- End of Comments -->
                            @php
                                $comment_setting = commentFormSettings();
                                $comment_close = commentClose($blog->publish_at);
                            @endphp

                            @if ($comment_setting['default_comment_status'] == '1')
                                @if ($comment_setting['close_comments_for_old_blogs'] == '1' && $comment_close == true)
                                    <!--Comment Form closed-->
                                    <section class="newsletter-cover my-5">
                                        <div class="newsletter pt-40 pb-40">
                                            <div class="text-center">
                                                <span class="h4">{{ front_translate('Comments Closed') }}</span>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Comment Form closed-->
                                @else
                                    @if ($comment_setting['comment_registration'] == '1' && !Auth::user())
                                        <!--If Not Registered -->
                                        <div class="post-comment-form-cover" id="comment-form">
                                            <span
                                                class="h6">{{ front_translate('You Must be Registered Or Logged in To Comment') }}</span>
                                            <a href="{{ route('core.login') }}"
                                                class="ml-3 h6">{{ front_translate('Log In') }}?</a>
                                        </div>
                                        <!-- If Not Registered-->
                                    @else
                                        <!-- Comment Form -->
                                        <div class="post-comment-form-cover" id="comment-box">
                                            <h3 class="d-inline" id="comment-form-title">
                                                {{ front_translate('Write your comment') }}
                                            </h3>
                                            <a href="javascript:void(0)" id="cancel_comment"
                                                class="ml-2 h6 font-weight-bold d-none">{{ front_translate('Cancel Reply') }}</a>
                                            <form action="javascript:void(0)" class="comment-form">
                                                <div class="row mt-3">
                                                    <input type="hidden" name="blog_permalink" id="blog_permalink"
                                                        value="{{ $blog->permalink }}">
                                                    <input type="hidden" name="parent" id="parent_comment"
                                                        value="">
                                                    @if (Auth::user())
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth::user()->id }}">
                                                    @else
                                                        <!-- Name -->
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="user_name"
                                                                id="user_name"
                                                                placeholder="{{ front_translate('Name') }}">
                                                        </div>
                                                        <!-- Email -->
                                                        <div class="col-md-6">
                                                            <input type="email" class="form-control" name="user_email"
                                                                id="user_email"
                                                                placeholder="{{ front_translate('Email') }}">
                                                        </div>
                                                        <!-- Website -->
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control"
                                                                name="user_website" id="user_website"
                                                                placeholder="{{ front_translate('Website (optional)') }}">
                                                        </div>
                                                    @endif
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="comment" id="comment"
                                                            placeholder="{{ front_translate('Write your comment') }}"></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary"
                                                            id="comment_submit">{{ front_translate('Submit') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End of Comment Form -->
                                    @endif
                                @endif
                            @endif
                        </div>
                    </section>

                    @if ($is_related)
                        <!--  Related Blog Start -->
                        <div id="related-blogs" class="pt-40 pb-40">
                            <div class="section-title related-blogs-title">
                                <h2>{{ $related_title }}</h2>
                            </div>
                            <div class="post-blog-list">
                                <div class="row">
                                    @foreach (getRelatedBlogs($blog->permalink, $related_count) as $related_blog)
                                        <div class="col-sm-6">
                                            <!-- Post Style Two -->
                                            <div class="post-default ">
                                                <div class="post-thumb">
                                                    <a href="{{ route('theme.default.blog_details', $related_blog->permalink) }}"
                                                        aria-label="blog image">
                                                        <img alt="Blog Image" class="img-fluid lazy"
                                                            src="{{ $related_blog->image }}" style="">
                                                    </a>
                                                </div>
                                                <div class="post-data">
                                                    <!-- Title -->
                                                    <div class="title">
                                                        <h2><a
                                                                href="{{ route('theme.default.blog_details', $related_blog->permalink) }}">
                                                                {{ $related_blog->name }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Post Style Two -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--  Related Blog End -->
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
            let comment_section = '';
            let page = '';

            $(document).ready(function() {

                // scroll into comment section
                var urlHash = window.location.hash;
                if (urlHash && urlHash === "#comment") {
                    var targetSection = document.getElementById("comments");
                    window.scrollTo({
                        top: targetSection.offsetTop,
                        behavior: "smooth"
                    });
                }

                // checking if comment is paginated is here
                if ('{{ request()->page }}') {
                    page = '{{ request()->page }}';
                }

                // load comment function
                commentLoad(page);

                // if blog is password protected then hiding whats necessary
                if ("{{ $blog->visibility }}" == 'password') {
                    $('#blog_content').hide();
                    comment_section = $('.comments_section').detach();
                }

                // checking if blogs cookie is available and getting it (For password protected blog content)
                let cookie_data;
                if (Cookies.get('{{ $blog->permalink }}')) {
                    cookie_data = JSON.parse(Cookies.get('{{ $blog->permalink }}'));
                } else {
                    cookie_data = null;
                }

                //checking if cookie is available and match with the blog permalink 
                if (cookie_data != null && cookie_data.blog == '{{ $blog->permalink }}') {
                    let formData = $('#blog_password_form').serializeArray();
                    // extra field to check if user already got content and here is true
                    formData.push({
                        name: 'is_authenticate',
                        value: 'true'
                    });
                    getBlogContent(formData, comment_section);
                }

                // RTL Init
                let RTL = false;
                if ('{{ $rtl }}') {
                    RTL = true;
                }
                // Slider Image
                let $owlCarousel = $(".post-has-slide-thumb").find('.owl-carousel');
                $owlCarousel.each(function() {
                    let $t = $(this);
                    $t.owlCarousel({
                        rtl: RTL,
                        items: 1,
                        slideSpeed: 2000,
                        autoplay: true,
                        loop: true,
                        responsiveRefreshRate: 200,
                        animateIn: false,
                        animateOut: false,
                        margin: 0,
                        nav: true,
                        navText: [
                            '<i class="fa fa-angle-left"></i>',
                            '<i class="fa fa-angle-right"></i>',
                        ],
                        dots: false,
                        mouseDrag: true
                    });
                });
            });

            // get blog content on right password and setting cookie    
            $('#password').on('keypress', function(e) {
                if (e.which === 13) {
                    let formData = $('#blog_password_form').serializeArray();
                    // extra field to check if user already got content and here is false
                    formData.push({
                        name: 'is_authenticate',
                        value: 'false'
                    });
                    getBlogContent(formData, comment_section);
                }
            });

            // Load Comment Function
            function commentLoad(page) {
                $.ajax({
                    type: "post",
                    url: "{{ route('theme.default.comment.load') }}" + "?permalink=" +
                        "{{ $blog->permalink }}" + "&page=" + page,
                    success: function(res) {
                        if (res.success) {
                            $('#blog_comment').html(res.view);
                            if (page !== '') {
                                var targetSection = document.getElementById("comments");
                                window.scrollTo({
                                    top: targetSection.offsetTop,
                                    behavior: "smooth"
                                });
                            }
                        } else {
                            toastr.error(res.error, "{{ front_translate('Error!') }}");
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error("{{ front_translate('Comment Request Failed') }}",
                            "{{ front_translate('Error!') }}");
                    }
                });
            }

            // blog category change
            $(document).on('change', '#category_field', function() {
                let value = $('#category_field option:selected').val();
                if (value) {
                    var url = '{{ route('theme.default.blogByCategory', 'permalink') }}';
                    url = url.replace("permalink", value);
                    window.location.href = url;
                }
            });

            // create comment
            $(document).on('click', '#comment_submit', function() {
                $(this).prop('disabled', true);
                let formData = $('.comment-form').serializeArray();
                let parent = $('#parent_comment').val();
                createComment(formData, parent, page);
            })

            // Get Blog Content For Password Protected Blog
            function getBlogContent(formData, comment_section) {
                $.ajax({
                    type: "post",
                    url: '{{ route('theme.default.password.load') }}',
                    data: formData,
                    success: function(res) {
                        if (res.success) {
                            $('#blog_content').show();
                            $('#blog_content').html(res.content);
                            $('#password_box').remove();
                            if (comment_section != '') {
                                $('#comments').append(comment_section);
                                commentLoad(page);
                            }
                            // cookie expire in 1 day
                            Cookies.set('{{ $blog->permalink }}', JSON.stringify({
                                blog: "{{ $blog->permalink }}"
                            }), {
                                expires: 1,
                                path: '{{ env('APP_URL') }}'
                            });
                        } else {
                            toastr.error(res.error, "{{ front_translate('Error!') }}");
                        }
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error("{{ front_translate('Content Request Failed') }}",
                            "{{ front_translate('Error!') }}");
                    }
                });
            }

            // Create Comment Function
            function createComment(formData, parent, page) {
                $.ajax({
                    type: "post",
                    url: '{{ route('theme.default.comment.create') }}',
                    data: formData,
                    success: function(res) {
                        if (res.success) {
                            toastr.success(res.success, "{{ front_translate('Success!') }}");
                            if (parent === '') {
                                window.location =
                                    "{{ route('theme.default.blog_details', $blog->permalink) }}" +
                                    "?page=" + 1;
                            } else {
                                window.location =
                                    "{{ route('theme.default.blog_details', $blog->permalink) }}" +
                                    "?page=" + page;
                            }
                        } else {
                            if (res.warning) {
                                $('#user_name').val('');
                                $('#user_email').val('');
                                $('#user_website').val('');
                                $('#comment').val('');
                                toastr.warning(res.warning, "{{ front_translate('Warning!') }}");
                            }
                            if (res.pending) {
                                $('#user_name').val('');
                                $('#user_email').val('');
                                $('#user_website').val('');
                                $('#comment').val('');
                                toastr.info(res.pending, "{{ front_translate('Pending!') }}");
                            }
                            if (res.error) {
                                toastr.error(res.error, "{{ front_translate('Error!') }}");
                            }
                        }
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error("{{ front_translate('Comment Submit Failed') }}" + textStatus,
                            "{{ front_translate('Error!') }}");
                    }
                });
            }

            // reply btn click gotoview comment form
            $(document).on('click', '.reply-btn', function() {
                let parent = $(this).data('id');
                let name = $(this).data('username');
                $('#comment-form-title').text('{{ front_translate('Leave a Reply to') }} ' + name);
                $('#cancel_comment').removeClass('d-none');
                $('#parent_comment').val(parent);

                document.getElementById("comment-box").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // cancel a comment reply
            $(document).on('click', "#cancel_comment", function() {
                $('#comment-form-title').text('{{ front_translate('Write your comment') }}');
                $('#cancel_comment').addClass('d-none');
                $('#parent_comment').val('');
            });

            // more comment button click arrow up and down
            $(document).on('click', '.more_comment_btn', function() {
                let collapsed = $(this).attr('class');
                if (!$(this).hasClass('collapsed')) {
                    $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
                } else {
                    $(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
                }
            });
        })(jQuery);
    </script>
@endsection
