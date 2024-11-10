@php
    $active_theme = getActiveTheme();
    $sidebar_options = themeOptionToCss('sidebar_options', $active_theme->id);
    $sidebar_widget_title_tag = 'h4';
    if (isset($sidebar_options['condition']['custom_sidebar_c']) && $sidebar_options['condition']['custom_sidebar_c'] == 1 && isset($sidebar_options['static']['widget_title_tag_s']) && $sidebar_options['static']['widget_title_tag_s'] != '') {
        $sidebar_widget_title_tag = $sidebar_options['static']['widget_title_tag_s'];
    }
    $sidebar_id = getThemeSidebarId($type);
@endphp
<div class="my-sidebar">
    @php
        $all_sidebar_widgets = getAllSidebarWidgets($sidebar_id);
    @endphp
    @foreach ($all_sidebar_widgets as $widget)
        @php
            $name = strtolower(str_replace(' ', '_', $widget->widget_name));
        @endphp
        @switch($name)
            @case('author_widget')
                <!-- Author -->
                @includeIf('theme/default::frontend.widgets.author_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                ])
                <!-- End of Author -->
            @break

            @case('featured_blog_widget')
                <!-- Featured Blogs -->
                @includeIf('theme/default::frontend.widgets.featured_blog_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                    'sidebar_widget_title_tag' => $sidebar_widget_title_tag,
                ])
                <!-- End of Featured Blogs -->
            @break

            @case('recent_blog_widget')
                <!-- Recent Blog Widget -->
                @includeIf('theme/default::frontend.widgets.recent_blog_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                    'sidebar_widget_title_tag' => $sidebar_widget_title_tag,
                ])
                <!-- End of Blog Post Widget -->
            @break

            @case('tag_widget')
                <!-- Tags Cloud Widget -->
                @includeIf('theme/default::frontend.widgets.tag_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                    'sidebar_widget_title_tag' => $sidebar_widget_title_tag,
                ])
                <!-- End of Tags Cloud Widget -->
            @break

            @case('most_commented_blog_widget')
                <!-- Most Commented Widget Blog -->
                @includeIf('theme/default::frontend.widgets.most_commented_blog_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                    'sidebar_widget_title_tag' => $sidebar_widget_title_tag,
                ])
                <!-- End of Most Commented Blog Widget -->
            @break

            @case('newsletter_widget')
                <!-- Newsletter Widget -->
                @includeIf('theme/default::frontend.widgets.newsletter_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                    'sidebar_widget_title_tag' => $sidebar_widget_title_tag,
                ])
                <!-- End of Newsletter Widget -->
            @break

            @case('category_widget')
                <!-- Select Category -->
                @includeIf('theme/default::frontend.widgets.category_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                    'sidebar_widget_title_tag' => $sidebar_widget_title_tag,
                ])
                <!-- End of Select Category -->
            @break

            @case('advertisement_widget')
                <!-- Advertisement Widget -->
                @includeIf('theme/default::frontend.widgets.advertisement_widget', [
                    'sidebar_has_widget' => $widget->sidebar_has_widget_id,
                ])
                <!-- End of Advertisement Widget -->
            @break
        @endswitch
    @endforeach

</div>
