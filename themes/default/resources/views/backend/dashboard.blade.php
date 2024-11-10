@php
    $total_blog = getBlogCount();
    $publish_blog = getBlogCount([['tl_blogs.is_publish', '=', config('settings.blog_status.publish')], ['tl_blogs.publish_at', '<', currentDateTime()]]);
    $scheduled_blog = getBlogCount([['tl_blogs.publish_at', '>', currentDateTime()]]);
    $draft_blog = getBlogCount([['tl_blogs.is_publish', '=', config('settings.blog_status.draft')]]);
    $pending_blog = getBlogCount([['tl_blogs.is_publish', '=', config('settings.blog_status.pending')]]);
    $featured_blog = getBlogCount([['tl_blogs.is_featured', '=', 1]]);
    $total_pages = count(getPage());
    $total_categories = count(getCategory());
    $total_comment = getCommentCount([['tl_blog_comments.id', '!=', null]]);
    $recent_comments = Core\Models\TlBlogComment::with('blog:id,name,permalink')
        ->with('user:id,name,email,image')
        ->select(['id', 'user_id', 'blog_id', 'comment', 'parent', 'user_name', 'user_email', 'comment_date'])
        ->orderBy('id', 'desc')
        ->take(4)
        ->get();
    
    $popular_categories = Core\Models\TlBlogCategory::leftJoin('tl_blogs_categories', 'tl_blogs_categories.category_id', '=', 'tl_blog_categories.id')
        ->groupBy('tl_blog_categories.id')
        ->select(['tl_blog_categories.id', DB::raw('GROUP_CONCAT(distinct tl_blog_categories.name) as name'), DB::raw('COUNT(distinct tl_blogs_categories.blog_id) as blog_count')])
        ->orderBy('blog_count', 'desc')
        ->take(10)
        ->get();
    
    $latest_blogs = Core\Models\TlBlog::latest()
        ->select(['name', 'id', 'image', 'publish_at'])
        ->take(5)
        ->get();
    
    $latest_pages = Core\Models\TlPage::latest()
        ->select(['title', 'id', 'publish_at'])
        ->take(5)
        ->get();
    
@endphp
@push('head')
    {{-- Push custom script or style into head tag --}}
    <style>
        .summary-card {
            background: url('/public/backend/assets/img/summery-bg1.png');
            background-size: auto
        }

        .overflow-text {
            display: block;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dash-image {
            min-width: 60px !important;
        }

        .order-couter-item {
            padding: 13px 0px;
        }

        .apexcharts-toolbar {
            top: -30px !important;
        }

        .img-20 {
            width: 20px !important;
            height: 20px !important;
        }

        .comment_img {
            max-width: 50px;
        }
    </style>
@endpush
@push('script')
    {{-- Push custom script or style bottom of body tag --}}
@endpush
<div class="row">
    <!--Total Customers-->
    <div class="col-xl-3 col-sm-6">
        <div class="card mb-30 bg-primary text-white">
            <div class="state">
                <div class="align-items-center d-flex justify-content-center">
                    <div class="state-content text-center">
                        <p class="font-14 mb-2">{{ translate('Total Blogs') }}</p>
                        <h2>{{ $total_blog }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End total customers-->
    <!--Total Orders-->
    <div class="col-xl-3 col-sm-6">
        <div class="card mb-30 bg-info text-white">
            <div class="state">
                <div class="align-items-center d-flex justify-content-center">
                    <div class="state-content text-center">
                        <p class="font-14 mb-2">{{ translate('Total Pages') }}</p>
                        <h2>{{ $total_pages }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End total Orders-->
    <!--Total Products-->
    <div class="col-xl-3 col-sm-6">
        <div class="card mb-30 bg-danger text-white">
            <div class="state">
                <div class="align-items-center d-flex justify-content-center">
                    <div class="state-content text-center">
                        <p class="font-14 mb-2">{{ translate('Total Category') }}</p>
                        <h2>{{ $total_categories }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Products-->
    <!--Total Comment-->
    <div class="col-xl-3 col-sm-6">
        <div class="card mb-30 bg-success text-white">
            <div class="state">
                <div class="align-items-center d-flex justify-content-center">
                    <div class="state-content text-center">
                        <p class="font-14 mb-2">{{ translate('Total Comments') }}</p>
                        <h2>{{ $total_comment }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End total Comment-->
    <!--Visitor Reports-->
    <div class="col-xl-8 col-12">
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start align-items-sm-center media">
                    <div
                        class="d-flex justify-content-start justify-content-sm-between align-items-start align-items-sm-center flex-column flex-sm-row mb-sm-n3  media-body">
                        <div class="title-content mb-4 mr-sm-5 mb-sm-0">
                            <h4 class="">{{ translate('Visitors Reports') }}</h4>
                        </div>
                        <!-- List Button -->
                        <ul class="list-inline list-button m-0 mr-sm-4">
                            <li class="active chart-switcher" data-type="monthly">{{ translate('Monthly') }}</li>
                            <li class="chart-switcher" data-type="daily">{{ translate('Daily') }}</li>
                        </ul>
                        <!-- End List Button -->
                    </div>
                </div>
            </div>
            <div id="apex_sales_report_chart"></div>
        </div>
    </div>
    <!--End Visitor Reports-->
    <!--Order Counter-->
    <div class="col-xl-4 col-lg-5 grid-item">
        <!-- Card -->
        <div class="card mb-30">
            <div class="card-body p-30">
                <div class="d-flex justify-content-between">
                    <div class="title-content">
                        <h4 class="mb-2">{{ translate('Blog Status') }}</h4>
                    </div>
                </div>
                <!-- Transaction History -->
                <div class="trans-history">
                    <!-- Transaction History Item -->
                    <div class="align-items-center border-bottom d-flex justify-content-between mb-2 order-couter-item">
                        <div class="d-flex align-items-center">
                            <div class="img mr-3">
                                <i class="icofont-tick-boxed font-20"></i>
                            </div>
                            <div class="content">
                                <a href="{{ route('core.blog') . '?status=publish' }}">
                                    <h5>{{ translate('Published') }}</h5>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h5>{{ $publish_blog }}</h5>
                        </div>
                    </div>
                    <!-- End Transaction History Item -->
                    <!-- Transaction History Item -->
                    <div class="align-items-center border-bottom d-flex justify-content-between mb-2 order-couter-item">
                        <div class="d-flex align-items-center">
                            <div class="img mr-3">
                                <i class="icofont-clock-time font-20"></i>
                            </div>
                            <div class="content">
                                <a href="{{ route('core.blog') . '?status=schedule' }}">
                                    <h5>{{ translate('Scheduled') }}</h5>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h5>{{ $scheduled_blog }}</h5>
                        </div>
                    </div>
                    <!-- End Transaction History Item -->
                    <!-- Transaction History Item -->
                    <div class="align-items-center border-bottom d-flex justify-content-between mb-2 order-couter-item">
                        <div class="d-flex align-items-center">
                            <div class="img mr-3">
                                <i class="icofont-page font-20"></i>
                            </div>
                            <div class="content">
                                <a href="{{ route('core.blog') . '?status=draft' }}">
                                    <h5>{{ translate('Drafts') }}</h5>
                                </a>
                            </div>
                        </div>
                        <div class="">
                                <h5>{{ $draft_blog }}</h5>
                        </div>
                    </div>
                    <!-- End Transaction History Item -->
                    <!-- Transaction History Item -->
                    <div class="align-items-center border-bottom d-flex justify-content-between mb-2 order-couter-item">
                        <div class="d-flex align-items-center">
                            <div class="img mr-3">
                                <i class="icofont-ui-laoding font-20"></i>
                            </div>
                            <div class="content">
                                <a href="{{ route('core.blog') . '?status=pending' }}">
                                    <h5>{{ translate('Pending') }}</h5>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h5>{{ $pending_blog }}</h5>
                        </div>
                    </div>
                    <!-- End Transaction History Item -->
                    <!-- Transaction History Item -->
                    <div class="align-items-center border-bottom d-flex justify-content-between mb-2 order-couter-item">
                        <div class="d-flex align-items-center">
                            <div class="img mr-3">
                                <i class="icofont-blogger font-20"></i>
                            </div>
                            <div class="content">
                                <a href="{{ route('core.blog') . '?status=featured' }}">
                                    <h5>{{ translate('Featured') }}</h5>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h5>{{ $featured_blog }}</h5>
                        </div>
                    </div>
                    <!-- End Transaction History Item -->
                </div>
                <!-- End Transaction History -->
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!--End order counter-->
    <!--Recent comments-->
    <div class="col-xl-8 col-lg-7 col-12 mb-20">
        <!-- Card -->
        <div class="card">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                    <div class="title-content">
                        <h4 class="mb-2">{{ translate('Recent Comments') }}</h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="style--three table-centered text-nowrap">
                    <thead>
                        <tr>
                            <th>{{ translate('Author') }}</th>
                            <th>{{ translate('Comment') }}</th>
                            <th>{{ translate('Blog') }}</th>
                            <th>{{ translate('Submitted on') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($recent_comments) > 0)
                            @foreach ($recent_comments as $comment)
                                <tr class="comment_list">
                                    <td class="d-flex align-itmes-center vtop">
                                        @php
                                            $comment_setting = commentFormSettings();
                                            
                                            $author_image = isset($comment->user) ? $comment->user->image : null;
                                            $author_name = isset($comment->user) ? $comment->user->name : null;
                                            $author_email = isset($comment->user) ? $comment->user->email : null;
                                        @endphp
                                        <div class="d-inline">
                                            <img src="
                                        @if (isset($author_image)) {{ asset(getFilePath($author_image)) }}
                                        @else
                                            @if ($comment_setting['show_avatars'] == 1)
                                                {{ asset('/public/comment-author-image/' . $comment_setting['avatar_default'] . '.png') }}
                                            @else
                                                {{ asset(getFilePath($author_image)) }} @endif
                                        @endif"
                                                alt="" class="comment_img">
                                        </div>
                                        <div class="d-inline-block ml-1">
                                            <span>
                                                {{ isset($author_name) ? $author_name : $comment->user_name }}
                                            </span>
                                            <br>

                                            @if (isset($author_email))
                                                <a href="javascript:void(0)" class="text-primary">
                                                    {{ $author_email }}
                                                </a>
                                                <br>
                                            @else
                                                @if ($comment->user_email != '')
                                                    <a href="javascript:void(0)" class="text-primary">
                                                        {{ $comment->user_email }}
                                                    </a>
                                                    <br>
                                                @endif
                                            @endif

                                            <a href="{{ route('core.blog.comment') . '?status=user_ip_address&ip_address=' . $comment->user_ip_address }}"
                                                class="text-primary">{{ $comment->user_ip_address }}</a>
                                        </div>
                                    </td>
                                    <td class="vtop">
                                        @if (isset($comment->parent))
                                            @php
                                                $parent_comment = Core\Models\TlBlogComment::where('id', $comment->parent)->first()->user_name;
                                            @endphp
                                            <span class="d-block mb-1">{{ translate('In reply to') }}
                                                <a href="javascript:void(0)"
                                                    class="text-primary">{{ $parent_comment }}</a>
                                            </span>
                                        @endif
                                        <span class="d-block mb-1">{{ $comment->comment }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $blog = $comment->blog->translation('name', getLocale());
                                        @endphp
                                        <a
                                            href="{{ route('core.edit.blog', ['id' => $comment->blog_id, 'lang' => getDefaultLang()]) }}">{{ strlen($blog) > 20 ? mb_substr($blog, 0, 20, 'UTF-8') . '...' : $blog }}</a>
                                    </td>
                                    <td class="vtop">
                                        <span>{{ getFormatedDateTime($comment->comment_date, 'Y/m/d \a\t H:i a') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    <p class="alert alert-danger text-center">{{ translate('Nothing found') }}</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!--End recents comments-->
    <!-- Popular Categories -->
    <div class="col-xl-4 col-lg-5 mb-20">
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-end justify-content-between mb-3">
                    <div class="">
                        <h4 class="mb-1">{{ translate('Popular Categories') }}</h4>
                    </div>
                </div>
                <div class="product-list">
                    @if (count($popular_categories) > 0)
                        @foreach ($popular_categories as $category)
                            @if ($category->blog_count > 0)
                                <div class="mb-20 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="content">
                                            @php
                                                $name = $category->translation('name', getLocale());
                                            @endphp
                                            <a
                                                href="{{ route('core.edit.blog.category', ['id' => $category->id, 'lang' => getDefaultLang()]) }}">{{ $name }}</a>
                                        </div>
                                    </div>
                                    <p class="font-14">{{ $category->blog_count . ' blog' }}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End Popular Categories-->
    <!--Recent Blogs-->
    <div class="col-lg-6">
        <!-- Card -->
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-end justify-content-between mb-3">
                    <div class="">
                        <h4 class="mb-1">{{ translate('Latest Blogs') }}</h4>
                    </div>
                </div>
                <div class="product-list">
                    @if (count($latest_blogs) > 0)
                        @foreach ($latest_blogs as $blog)
                            <div class="mb-20 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="img mr-3">
                                        <img src="{{ asset(getFilePath($blog->image, true)) }}"
                                            alt="{{ $blog->name }}" class="img-45">
                                    </div>
                                    <div class="content">
                                        @php
                                            $name = $blog->translation('name', getLocale());
                                        @endphp
                                        <a
                                            href="{{ route('core.edit.blog', ['id' => $blog->id, 'lang' => getDefaultLang()]) }}">{{ strlen($name) > 35 ? mb_substr($name, 0, 35, 'UTF-8') . '...' : $name }}</a>
                                    </div>
                                </div>
                                <p class="font-14">{{ date('d-m-Y h:m A', strtotime($blog->publish_at)) }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!--End Recent Blogs-->
    <!--Recent Pages-->
    <div class="col-lg-6">
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-end justify-content-between mb-3">
                    <div class="">
                        <h4 class="mb-1">{{ translate('Latest Pages') }}</h4>
                    </div>
                </div>
                <div class="product-list">
                    @if (count($latest_pages) > 0)
                        @foreach ($latest_pages as $page)
                            <div class="mb-20 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="content">
                                        @php
                                            $name = $page->translation('title', getLocale());
                                        @endphp
                                        <a
                                            href="{{ route('core.edit.blog', ['id' => $page->id, 'lang' => getDefaultLang()]) }}">{{ strlen($name) > 35 ? mb_substr($name, 0, 35, 'UTF-8') . '...' : $name }}</a>
                                    </div>
                                </div>
                                <p class="font-14">{{ date('d-m-Y h:m A', strtotime($page->publish_at)) }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End Recent Pages-->
</div>

@push('script')
    <script>
        (function($) {
            "use strict";
            let chart_data_type = "monthly";
            let categories = [];
            //change chart data type
            $(".chart-switcher").on('click', function(e) {
                e.preventDefault();
                $('.chart-switcher').removeClass('active');
                $(this).addClass('active');
                chart_data_type = $(this).data('type');
                getChartData();
            });

            //Get data from api
            function getChartData() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        type: chart_data_type
                    },
                    url: "{{ route('theme.default.visitor.reports') }}",
                    success: function(data) {
                        if (data.success) {
                            categories = data.times;
                            sales_chart.updateSeries([{
                                name: 'Visitors',
                                data: data.visitors
                            }])

                            sales_chart.updateOptions({
                                xaxis: {
                                    categories: data.times
                                }
                            })
                        }
                    }
                });
            }
            //chart options
            var sales_chart_options = {
                series: [],
                chart: {
                    height: 340,
                    type: 'line',
                    toolbar: {
                        show: true,
                    },
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    dashArray: 3
                },
                colors: ['#FFBA5A', '#8381FD'],
                grid: {
                    borderColor: '#f5f5f5',
                },
                markers: {
                    size: 7,
                    colors: ["#67CF94"],
                    hover: {
                        size: 8,
                    }
                },
                xaxis: {
                    categories: [],
                },
                yaxis: {
                    tickAmount: 4,
                },
                responsive: [{
                    breakpoint: 576,
                    options: {
                        markers: {
                            size: 5,
                            colors: ["#67CF94"],
                            hover: {
                                size: 5,
                            }
                        },
                    }
                }],
            };
            //Render chart
            var sales_chart = new ApexCharts(document.querySelector(
                "#apex_sales_report_chart"), sales_chart_options);
            sales_chart.render();

            $(document).ready(function() {
                getChartData();
            });
        })(jQuery);
    </script>
@endpush
