@php
    // Theme Option and Settings
    $generalSettings = getGeneralSettingsDetails();
    $active_theme = getActiveTheme();
    $blog_option = getThemeOption('blog', $active_theme->id);
    $blog_layout = 'right_sidebar_layout';
    $blog_colum = 'col-lg-12';
    $blog_post_style = 's_one';
    $is_blog_title = true;
    $blog_page_title = front_translate('Blog List');
    $blog_excerpt = 50;
    $read_more = front_translate('Read More');
    $pagination_type = 'number';
    $pagination_alignment = 'center';
    
    if (isset($blog_option['custom_blog_style']) && $blog_option['custom_blog_style'] == 1) {
        //layout
        if (isset($blog_option['blog_layout']) && $blog_option['blog_layout'] != '') {
            $blog_layout = $blog_option['blog_layout'];
        }
        //columm
        if (isset($blog_option['blog_colum']) && $blog_option['blog_colum'] != '') {
            switch ($blog_option['blog_colum']) {
                case 'blog_colum_1':
                    $blog_colum = 'col-lg-12';
                    break;
                case 'blog_colum_2':
                    $blog_colum = 'col-md-6';
                    break;
                case 'blog_colum_3':
                    $blog_colum = 'col-md-4 col-sm-6';
                    break;
                default:
                    break;
            }
        }
        // post style
        if (isset($blog_option['blog_post_style']) && $blog_option['blog_post_style'] != '') {
            $blog_post_style = $blog_option['blog_post_style'];
        }
        // is blog title
        $is_blog_title = isset($blog_option['blog_page_title']) && $blog_option['blog_page_title'] == 1 ? true : false;
        // page title
        if (isset($blog_option['blog_page_title_setting']) && $blog_option['blog_page_title_setting'] == 'custom') {
            $blog_page_title = isset($blog_option['blog_custom_title']) ? $blog_option['blog_custom_title'] : '';
        }
        //blog excerpt
        if (isset($blog_option['blog_posts_excerpt']) && $blog_option['blog_posts_excerpt'] != 0 && !empty($blog['blog_posts_excerpt'])) {
            $blog_excerpt = $blog_option['blog_posts_excerpt'];
        }
        // readmore setting
        if (isset($blog_option['read_more_text_setting']) && $blog_option['read_more_text_setting'] == 'custom') {
            $read_more = isset($blog_option['read_more_text_setting']) ? front_translate($blog_option['read_more_text_setting']) : '';
        }
        // pagination type
        if (isset($blog_option['blog_pagination_setting'])) {
            if ($blog_option['blog_pagination_setting'] == 'link') {
                $pagination_type = 'link';
            } elseif ($blog_option['blog_pagination_setting'] == 'number' && isset($blog_option['blog_pagination_position'])) {
                switch ($blog_option['blog_pagination_position']) {
                    case 'left':
                        $pagination_alignment = 'start';
                        break;
                    case 'center':
                        $pagination_alignment = 'center';
                        break;
                    case 'right':
                        $pagination_alignment = 'end';
                        break;
                    default:
                        break;
                }
            }
        }
    }
    // page options title css
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
    
    // Seo Setting by filter
    $filterSeo = false;
    if (isset($filter) && in_array($filter, ['category', 'tag'])) {
        $seoInfo = blogFilterSeo($filter, $permalink);
        $filterSeo = true;
        $seoInfo['site_meta_keywords'] = $generalSettings['site_meta_keywords'];
    } else {
        $seoInfo = $generalSettings;
    }
@endphp
@extends('theme/default::frontend.layout.master')

@section('seo')
    {{-- SEO --}}
    <title> {{ $filterSeo ? $seoInfo['filter_name'] . ' | ' . front_translate('Blogs') : front_translate('Blogs') }}
    </title>
    <meta name="title" content="{{ $seoInfo['site_meta_title'] ?? 'Blogs' }}">
    <meta name="description" content="{{ $seoInfo['site_meta_description'] }}">
    <meta name="keywords" content="{{ $seoInfo['site_meta_keywords'] }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seoInfo['site_meta_title'] ?? 'Blogs' }}">
    <meta property="og:description" content="{{ $seoInfo['site_meta_description'] }}">
    <meta name="twitter:card" content="{{ $seoInfo['site_meta_description'] }}">
    <meta name="twitter:title" content="{{ $seoInfo['site_meta_title'] ?? 'Blogs' }}">
    <meta name="twitter:description" content="{{ $seoInfo['site_meta_description'] }}">
    <meta name="twitter:image"
        content="{{ $seoInfo['site_meta_image'] ? asset(getFilePath($seoInfo['site_meta_image'])) : asset(getFilePath($generalSettings['site_meta_image'])) }}">
    <meta property="og:image"
        content="{{ $seoInfo['site_meta_image'] ? asset(getFilePath($seoInfo['site_meta_image'])) : asset(getFilePath($generalSettings['site_meta_image'])) }}">
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/blog.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
    <!--  End select2  -->
@endsection

@section('content')
    @if ($is_blog_title)
        <!-- Page title -->
        <div class="page-title  {{ $overlay }}">
            <div class="container">
                @if (isset($filter))
                    {{-- Blog Filter By --}}
                    @switch($filter)
                        {{-- If Filter by category --}}
                        @case('category')
                            <div class="col-12">
                                @php
                                    // Finding the category by Id
                                    $filterCategory = Core\Models\TlBlogCategory::where('permalink', $permalink)->first();
                                    $category_name = isset($filterCategory) ? $filterCategory->translation('name', getFrontLocale()) : front_translate('No Category');
                                    
                                    $title = front_translate('Category') . ' : ' . $category_name;
                                @endphp
                                @if ($is_title)
                                    <!-- Title Tag -->
                                    {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                                    <!-- Title Tag -->
                                @endif
                                @if ($is_breadcrumb)
                                    <ul class="nav">
                                        <li><a href="{{ route('theme.default.home') }}">{{ front_translate('Home') }}</a></li>
                                        <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Blogs') }}</a></li>
                                        <li class="active">{{ $category_name }}</li>
                                    </ul>
                                @endif
                            </div>
                        @break

                        {{-- If Filter by Tag --}}
                        @case('tag')
                            <div class="col-12">
                                @php
                                    // Finding the category by Id
                                    $filterTag = Core\Models\TlBlogTag::where('permalink', $permalink)->first();
                                    $tag_name = isset($filterTag) ? $filterTag->translation('name', getFrontLocale()) : front_translate('No Tag');
                                    
                                    $title = front_translate('Tag') . ' : ' . $tag_name;
                                @endphp
                                @if ($is_title)
                                    <!-- Title Tag -->
                                    {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                                    <!-- Title Tag -->
                                @endif
                                @if ($is_breadcrumb)
                                    <ul class="nav">
                                        <li><a href="{{ route('theme.default.home') }}">{{ front_translate('Home') }}</a></li>
                                        <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Blog') }}</a></li>
                                        <li class="active">{{ $tag_name }}</li>
                                    </ul>
                                @endif
                            </div>
                        @break

                        {{-- If Filter by Featured --}}
                        @case('featured')
                            <div class="col-12">
                                @php
                                    $title = front_translate('Featured Blogs');
                                @endphp
                                @if ($is_title)
                                    <!-- Title Tag -->
                                    {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                                    <!-- Title Tag -->
                                @endif
                                @if ($is_breadcrumb)
                                    <ul class="nav">
                                        <li><a href="{{ route('theme.default.home') }}">{{ front_translate('Home') }}</a></li>
                                        <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Blog') }}</a></li>
                                        <li class="active">{{ front_translate('featured') }}</li>
                                    </ul>
                                @endif
                            </div>
                        @break

                        {{-- If Filter by Search --}}
                        @case('search')
                            <div class="col-12">
                                @php
                                    $title = front_translate('Search Result');
                                @endphp
                                @if ($is_title)
                                    <!-- Title Tag -->
                                    {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                                    <!-- Title Tag -->
                                @endif
                                @if ($is_breadcrumb)
                                    <ul class="nav">
                                        <li><a href="{{ route('theme.default.home') }}">{{ front_translate('Home') }}</a></li>
                                        <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Blog') }}</a></li>
                                        <li class="active">{{ front_translate('Search Result For') . ' : ' . $text }}</li>
                                    </ul>
                                @endif
                            </div>
                        @break

                        {{-- If Filter by Author --}}
                        @case('author')
                            <div class="col-12">
                                @php
                                    $title = front_translate('Author') . ' : ' . $author_name;
                                @endphp
                                @if ($is_title)
                                    <!-- Title Tag -->
                                    {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                                    <!-- Title Tag -->
                                @endif
                                @if ($is_breadcrumb)
                                    <ul class="nav">
                                        <li><a href="{{ route('theme.default.home') }}">{{ front_translate('Home') }}</a></li>
                                        <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Blog') }}</a></li>
                                        <li class="active">{{ $author_name }}</li>
                                    </ul>
                                @endif
                            </div>
                        @break

                        {{-- If Filter by Date --}}
                        @case('date')
                            <div class="col-12">
                                @php
                                    $title = front_translate('Date') . ' : ' . getFormatedDateTime($date, 'd M y');
                                @endphp
                                @if ($is_title)
                                    <!-- Title Tag -->
                                    {!! makeTitleTag($page_title_tag, $title, 'title') !!}
                                    <!-- Title Tag -->
                                @endif
                                @if ($is_breadcrumb)
                                    <ul class="nav">
                                        <li><a href="{{ route('theme.default.home') }}">{{ front_translate('Home') }}</a></li>
                                        <li><a href="{{ route('theme.default.allBlog') }}">{{ front_translate('Blog') }}</a></li>
                                        <li class="active">{{ getFormatedDateTime($date, 'd M y') }}</li>
                                    </ul>
                                @endif
                            </div>
                        @break
                    @endswitch
                @else
                    @if ($is_title)
                        {!! makeTitleTag($page_title_tag, $blog_page_title, 'title') !!}
                    @endif
                    @if ($is_breadcrumb)
                        <ul class="nav">
                            <li><a href="{{ route('theme.default.home') }}">{{ front_translate('Home') }}</a></li>
                            <li class="active">{{ front_translate('Blog List') }}</li>
                        </ul>
                    @endif
                @endif
            </div>
        </div>
        <!-- End of Page title -->
    @endif

    <div class="container pt-120 pb-90">
        <div class="row">
            <div
                class="post-blog-list {{ $blog_layout == 'full_layout' ? 'col-lg-12' : 'col-lg-8' }} {{ $blog_layout == 'left_sidebar_layout' ? 'order-2' : 'order-1' }}  pb-50">
                {{-- Check if blogs available or not --}}
                @if (count($blogs) > 0)
                    <div class="row">
                        {{-- Foreach loop for avalable Blogs start --}}
                        @foreach ($blogs as $blog)
                            <div class="{{ $blog_colum }}">
                                <!-- Post -->
                                @includeIf(
                                    'theme/default::frontend.includes.blog-styles.' . $blog_post_style,
                                    [
                                        'blog_excerpt' => $blog_excerpt,
                                        'read_more' => $read_more,
                                        'blog' => $blog,
                                    ]
                                )
                                <!-- End of Post -->
                            </div>
                        @endforeach
                        {{-- Foreach loop for avalable Blogs end --}}
                    </div>

                    {{-- Blogs Pagiantion --}}
                    @if ($blogs->lastPage() == 1)
                        <h4 class="mt-5 text-center">{{ front_translate('No More Blogs') }}</h4>
                    @else
                        <div class="post-pagination d-flex justify-content-{{ $pagination_alignment }}">
                            @php
                                if (isset($filter)) {
                                    if ($filter == 'category') {
                                        $route = route('theme.default.blogByCategory', $permalink);
                                    } elseif ($filter == 'tag') {
                                        $route = route('theme.default.blogByTag', $permalink);
                                    } elseif ($filter == 'featured') {
                                        $route = route('theme.default.blogByFeatured');
                                    } elseif ($filter == 'search') {
                                        $route = route('theme.default.blogBySearch', $text);
                                    } elseif ($filter == 'author') {
                                        $route = route('theme.default.blogByAuthor', $author);
                                    } elseif ($filter == 'date') {
                                        $route = route('theme.default.blogByDate', $date);
                                    } else {
                                        $route = route('theme.default.allBlog');
                                    }
                                } else {
                                    $route = route('theme.default.allBlog');
                                }
                                $last_page = $blogs->lastPage();
                                $current_page = request()->input('page') ? request()->input('page') : 1;
                            @endphp

                            {{-- checking if blogs are filtered by category or not for Previous Button --}}
                            <a href="{{ $route . '?page=' . request()->input('page') - 1 }}"
                                style="{{ !request()->input('page') || request()->input('page') == 1 ? 'pointer-events: none' : '' }}"
                                aria-label="Previous Link"><i class="fa fa-angle-left"></i>
                            </a>

                            {{-- CHECKING IF PAGINATION IS NUMBER OR NOT --}}
                            @if ($pagination_type == 'number')
                                {{-- Pagination Number Start --}}
                                @if ($current_page - 3 > 1)
                                    <a href="{{ $route . '?page=' . 1 }}">1</a>
                                    <a style="pointer-events: none;">...</a>
                                @endif

                                @if ($current_page - 3 == 1)
                                    <a href="{{ $route . '?page=' . 1 }}">1</a>
                                @endif

                                @if ($current_page - 2 > 0)
                                    <a href="{{ $route . '?page=' . $current_page - 2 }}">
                                        {{ $current_page - 2 }}</a>
                                @endif

                                @if ($current_page - 1 > 0)
                                    <a href="{{ $route . '?page=' . $current_page - 1 }}">
                                        {{ $current_page - 1 }}</a>
                                @endif
                                {{-- current page --}}
                                <a href="#" class="current" style="pointer-events: none;">{{ $current_page }}</a>
                                {{-- current page --}}
                                @if ($current_page + 1 <= $last_page)
                                    <a href="{{ $route . '?page=' . $current_page + 1 }}">
                                        {{ $current_page + 1 }}</a>
                                @endif

                                @if ($current_page + 2 == $last_page)
                                    <a href="{{ $route . '?page=' . $last_page }}">
                                        {{ $last_page }}</a>
                                @endif

                                @if ($current_page < $last_page - 2)
                                    <a style="pointer-events: none;">...</a>
                                    <a href="{{ $route . '?page=' . $last_page }}">{{ $last_page }}</a>
                                @endif
                                {{-- Pagination Number Start end --}}
                            @endif
                            {{-- CHECKING IF PAGINATION IS NUMBER OR NOT --}}

                            {{-- checking if blogs are filtered by category or not for Next Button --}}
                            @if (request()->input('page'))
                                <a href="{{ $route . '?page=' . request()->input('page') + 1 }}"
                                    style="{{ request()->input('page') == $blogs->lastPage() ? 'pointer-events: none' : '' }}"
                                    aria-label="Next Link"><i class="fa fa-angle-right"></i></a>
                            @else
                                <a href="{{ $route . '?page=2' }}"
                                    style="{{ $blogs->lastPage() == 1 ? 'pointer-events: none' : '' }}"
                                    aria-label="Next Link"><i class="fa fa-angle-right"></i></a>
                            @endif
                        </div>
                    @endif
                    <!-- End of Post Pagination -->
                @else
                    <div class="text-center">
                        <h3>{{ front_translate('No Blogs Found') }}</h3>
                    </div>
                @endif

            </div>

            @if ($blog_layout != 'full_layout')
                <div class="col-lg-4 {{ $blog_layout == 'left_sidebar_layout' ? 'order-1' : 'order-2' }}">
                    @includeIf('theme/default::frontend.includes.sidebar.sidebar', [
                        'type' => 'blog_sidebar',
                    ])
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        (function($) {
            'use strict';
            $(document).ready(function() {
                var category = '<?php echo isset($filterCategory) ? $filterCategory->permalink : null; ?>';
                if (category) {
                    $("#category_field > option[value=" + category + "]").prop("selected", true);
                }
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
        })(jQuery);
    </script>
@endsection
