@php
    $most_commented_blog_fields = getSidebarWidgetValues($sidebar_has_widget, getFrontLocale());
    $widget_title = isset($most_commented_blog_fields['widget_title']) ? $most_commented_blog_fields['widget_title'] : '';
    
    $mostComment = false;
    if (isset($most_commented_blog_fields['total_blog_number']) && isset($most_commented_blog_fields['per_slide_number'])) {
        $mostBlogComment = frontendSidebarMostCommentBlogs($most_commented_blog_fields['total_blog_number']);
        $perSlide = $most_commented_blog_fields['per_slide_number'];
        $total_slide = (int) ceil(count($mostBlogComment) / $perSlide);
        $mostComment = true;
    }
    
@endphp
<!-- Most Commented Post Widget -->
<div class="widget widget-most-commented-post">
    <!-- Widget Title -->
    {!! makeTitleTag($sidebar_widget_title_tag, $widget_title, 'widget-title') !!}
    <!-- End of Widget Title -->

    <!-- Widget Content -->
    <div class="widget-content">
        @if ($mostComment == true)
            <!-- Post Carousel -->
            <div class="wmcp-cover owl-carousel" data-owl-mouse-drag="true" data-owl-dots="true" data-owl-margin="20">
                @php
                    $slide_blog = [];
                    $slideBreakCount = $perSlide;
                @endphp
                @for ($i = 0; $i < $total_slide; $i++)
                    <!-- Carousel Item -->
                    <div class="wmcp-item">
                        @foreach ($mostBlogComment as $key => $blog)
                            @if (!in_array($key, $slide_blog))
                                <!-- Single Post -->
                                <div class="wmc-post">
                                    @isset($blog->image)
                                        <a href="{{ route('theme.default.blog_details', $blog->permalink) }}">
                                            @php
                                                $variation = getImageVariation($blog->image, 'medium');
                                            @endphp
                                            <img data-src="{{ $variation }}" alt="{{ $blog->name }}"
                                                class="img-fluid lazy">
                                        </a>
                                    @endisset
                                    <div class="wmc-post-title">
                                        <h5> <a
                                                href="{{ route('theme.default.blog_details', $blog->permalink) }}">{{ $blog->name }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <!-- End of Single Post -->
                                @php
                                    array_push($slide_blog, $key);
                                @endphp
                            @endif
                            @if ($key == $slideBreakCount - 1)
                                @php
                                    $slideBreakCount += $perSlide;
                                @endphp
                            @break
                        @endif
                    @endforeach
                </div>
                <!-- End of Carousel Item -->
            @endfor
        </div>
        <!-- End of Post Carousel -->
        @endif
</div>
<!-- End of Widget Content -->
</div>
<!-- End of Most Commented Post Widget -->
