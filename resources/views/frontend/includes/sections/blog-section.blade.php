@php
    $type = $properties['layout'];
    $limit = $properties['number_of_blogs'];
    switch ($type) {
        case 'new_blog':
            $blogs = frontendSidebarRecentBlogs($limit);
            break;
        case 'featured_blog':
            $blogs = frontendSidebarFeaturedBlogs($limit);
            break;
        case 'most_viewed_blog':
            $blogs = mostViewedBlogs($limit);
            break;
        case 'trending_blog':
            $blogs = mostPopularBlogs($limit);
            break;
        case 'category_wise':
            $blogs = blogsByCategory($properties['category'] , $limit);
            break;
        default:
            $blogs = 0;
            break;
    }
@endphp
<section class="pt-10 pb-10" id="{{ $type.'_'.$id }}">
    <!-- Section title -->
    <div class="section-title">
        <h2>{{ front_translate($properties['title']) }}</h2>
    </div>
    <!-- End of Section title -->
    <div class="post-blog-list">
        <!-- Post -->
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="{{ isset($properties['blog_colum']) ? $properties['blog_colum'] : 'col-12' }}">
                    @includeIf('theme/default::frontend.includes.blog-styles.' . $properties['post_style'], [
                        'blog_excerpt' => 100,
                        'read_more' =>  isset($properties['btn_title']) ? front_translate($properties['btn_title']) : front_translate('Read More'),
                        'blog' => $blog,
                    ])
                </div>
            @endforeach
        </div>
        <!-- End of Post -->
    </div>
</section>


