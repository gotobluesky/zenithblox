@php
    $recent_blog_fields = getSidebarWidgetValues($sidebar_has_widget, getFrontLocale());
    $widget_title = isset($recent_blog_fields['widget_title']) ? $recent_blog_fields['widget_title'] : '';
    $number_of_recent_blog = isset($recent_blog_fields['number_of_recent_blog']) ? $recent_blog_fields['number_of_recent_blog'] : null;
@endphp
<div class="widget widget-recent-post">
    <!-- Widget Title -->
    {!! makeTitleTag($sidebar_widget_title_tag, $widget_title, 'widget-title') !!}
    <!-- End of Widget Title -->

    <!-- Widget Content -->
    <div class="widget-content">
        @isset($number_of_recent_blog)
            @php
                $frontendSidebarRecentBlogs = frontendSidebarRecentBlogs($number_of_recent_blog);
            @endphp
            {{-- Foreach loop for Recent Post start --}}
            @foreach ($frontendSidebarRecentBlogs as $recent_blog)
                <!-- Single Post -->
                <div class="wrp-cover">
                    <!-- Post Thumbnail -->
                    @isset($recent_blog->image)
                        <div class="post-thumb">
                            <a href="{{ route('theme.default.blog_details', $recent_blog->permalink) }}">
                                @php
                                    $variation = getImageVariation($recent_blog->image, 'small');
                                @endphp
                                <img data-src="{{ $variation }}" alt="{{ $recent_blog->name }}"
                                class="img-small-60 lazy">
                            </a>
                        </div>
                    @endisset
                    <!-- Post Title -->
                    <div class="post-title">
                        <a
                            href="{{ route('theme.default.blog_details', $recent_blog->permalink) }}">{{ $recent_blog->name }}</a>
                    </div>
                </div>
                <!--End of Single Post -->
            @endforeach
            {{-- Foreach loop for Recent Post end --}}
        @endisset
    </div>
    <!-- End of Widget Content -->
</div>
