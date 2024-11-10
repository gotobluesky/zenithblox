@php
    $tag_fields = getSidebarWidgetValues($sidebar_has_widget,getFrontLocale());
    $widget_title = isset($tag_fields['widget_title']) ? $tag_fields['widget_title'] : '';
    $number_of_tags = isset($tag_fields['number_of_tags']) ? $tag_fields['number_of_tags'] : null;
@endphp
<div class="widget widget-tag-cloud">
    <!-- Widget Title -->
    {!! makeTitleTag($sidebar_widget_title_tag,$widget_title,'widget-title') !!}
    <!-- End of Widget Title -->

    <!-- Widget Content -->
    <div class="widget-content tagcloud">
        @isset($number_of_tags)
            @php
                $frontendSidebarTags = frontendSidebarTags($number_of_tags);
            @endphp
            @foreach ($frontendSidebarTags as $tag)
                <a
                    href="{{ route('theme.default.blogByTag',$tag->permalink) }}">{{ $tag->name }}</a>
            @endforeach
        @endisset
    </div>
    <!-- End of Widget Content -->
</div>
