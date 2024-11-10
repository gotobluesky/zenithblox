@php
    $featured_blog_fields = getSidebarWidgetValues($sidebar_has_widget, getFrontLocale());
    $widget_title = isset($featured_blog_fields['widget_title']) ? $featured_blog_fields['widget_title'] : '';
    $number_of_featured_blog = isset($featured_blog_fields['number_of_featured_blog']) ? $featured_blog_fields['number_of_featured_blog'] : null;
@endphp
<div class="widget widget-featured-post">
    <!-- Widget Title -->
    {!! makeTitleTag($sidebar_widget_title_tag, $widget_title, 'widget-title') !!}
    <!-- End of Widget Title -->

    <!-- Widget Content -->
    <div class="widget-content">
        {{-- Foreach loop for Featured Post start --}}
        @isset($number_of_featured_blog)
            @php
                $frontendSidebarFeaturedBlogs = frontendSidebarFeaturedBlogs($number_of_featured_blog);
            @endphp
            @foreach ($frontendSidebarFeaturedBlogs as $featured_blog)
                <!-- Single Post -->
                <div class="featured-post">
                    <!-- Post Thumbnail -->
                    @isset($featured_blog->image)
                        <a href="{{ route('theme.default.blog_details', $featured_blog->permalink) }}">
                            @php
                                $variation = getImageVariation($featured_blog->image, 'medium');
                            @endphp
                            <img data-src="{{ $variation  }}" alt="{{ $featured_blog->name }}"
                                class="img-fluid lazy">
                        </a>
                    @endisset
                    <!-- Post Title -->
                    <div class="featured-post-title">
                        <h5> <a
                                href="{{ route('theme.default.blog_details', $featured_blog->permalink) }}">{{ $featured_blog->name }}</a>
                        </h5>
                    </div>
                </div>
                <!-- End of Single Post -->
            @endforeach
        @endisset
        {{-- Foreach loop for Featured Post end --}}
    </div>
    <!-- End of Widget Content -->
</div>
