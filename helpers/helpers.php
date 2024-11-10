<?php

use Carbon\Carbon;
use Core\Models\Language;
use Core\Models\TlBlog;
use Core\Models\TlBlogTag;
use Core\Models\TlBlogCategory;
use Illuminate\Support\Facades\DB;
use Theme\Default\Models\TlWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Theme\Default\Models\TlThemeSidebar;
use Theme\Default\Repositories\BlogRepository;
use Theme\Default\Models\HomeSectionProperties;
use Theme\Default\Models\TlThemeOptionSettings;
use Theme\Default\Models\TlSidebarWidgetHasValue;


if (!function_exists('frontendSidebarCategories')) {
    /**
     *Frontend Blog Categories
     * @return mixed|array
     */
    function frontendSidebarCategories()
    {
        $locale = getFrontLocale();

        $categories = TlBlogCategory::with([
            'category_translations' => function ($query) use ($locale) {
                $query->where('lang', $locale)
                    ->select(['id', 'category_id', 'name']);
            }
        ])
            ->with('active_childs')
            ->where('is_publish', '1')
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($category) {
                if (count($category->category_translations)) {
                    $category->name = $category->category_translations->first()->name;
                }
                return $category;
            });
        return $categories;
    }
}

if (!function_exists('frontendSidebarTags')) {

    /**
     *Frontend Blog Tags limit 15
     * @return mixed|array
     */
    function frontendSidebarTags($limit)
    {
        $locale = getFrontLocale();

        $tags = TlBlogTag::with([
            'tag_translations' => function ($query) use ($locale) {
                $query->where('lang', $locale)
                    ->select(['id', 'tag_id', 'name']);
            }
        ])
            ->where('is_publish', '1')
            ->orderBy('id', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($tag) {
                if (count($tag->tag_translations)) {
                    $tag->name = $tag->tag_translations->first()->name;
                }
                return $tag;
            });

        return $tags;
    }
}

if (!function_exists('frontendSidebarFeaturedBlogs')) {

    /**
     *Frontend Blog Categories
     * @return mixed|array
     */
    function frontendSidebarFeaturedBlogs($limit)
    {
        $locale = getFrontLocale();

        $data = [
            DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.short_description) as short_description'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.content) as content'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
            DB::raw('GROUP_CONCAT(distinct tl_users.name) as user_name'),
            DB::raw('GROUP_CONCAT(distinct tl_users.image) as user_image'),
            DB::raw('GROUP_CONCAT(distinct tl_blog_categories.id) as category'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.formate) as formate'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.gallery_images) as gallery_images'),
        ];

        $match_case = [
            ['tl_blogs.publish_at', '<', currentDateTime()],
            ['tl_blogs.is_publish', '=', config('settings.blog_status.publish')],
            ['tl_blogs.visibility', '!=', 'private'],
            ['tl_blogs.is_featured', '=',  1]
        ];

        // initialize Blog Repository
        $blog_repository = new BlogRepository();
        $featured_blogs = $blog_repository->getBlogs($data, $match_case, $limit, null, '', false, false, $locale);
        return $featured_blogs;
    }
}

if (!function_exists('frontendSidebarRecentBlogs')) {
    /**
     *Frontend Blog Categories
     * @return mixed|array
     */
    function frontendSidebarRecentBlogs($limit)
    {
        $locale = getFrontLocale();

        $data = [
            DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.short_description) as short_description'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.content) as content'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
            DB::raw('GROUP_CONCAT(distinct tl_users.name) as user_name'),
            DB::raw('GROUP_CONCAT(distinct tl_users.image) as user_image'),
            DB::raw('GROUP_CONCAT(distinct tl_blog_categories.id) as category'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.formate) as formate'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.gallery_images) as gallery_images'),
        ];

        $match_case = [
            ['tl_blogs.publish_at', '<', currentDateTime()],
            ['tl_blogs.is_publish', '=', config('settings.blog_status.publish')],
            ['tl_blogs.visibility', '!=', 'private'],
        ];
        // initialize Blog Repository
        $blog_repository = new BlogRepository();
        $recent_blogs = $blog_repository->getBlogs($data, $match_case, $limit, null, '', false, false, $locale);
        return $recent_blogs;
    }
}

if (!function_exists('frontendSidebarMostCommentBlogs')) {

    /**
     *Frontend Blog Categories
     * @return mixed|array
     */
    function frontendSidebarMostCommentBlogs($limit)
    {
        $locale = getFrontLocale();

        $match_case = [
            ['tl_blogs.publish_at', '<', currentDateTime()],
            ['tl_blogs.is_publish', '=', config('settings.blog_status.publish')],
            ['tl_blogs.visibility', '!=', 'private'],
            ['tl_blog_comments.status', '=', config('settings.blog_comment_status.approve')]
        ];

        $most_comment_blogs = TlBlog::join('tl_users', 'tl_users.id', '=', 'tl_blogs.user_id')
            ->leftJoin('tl_blog_comments', 'tl_blog_comments.blog_id', '=', 'tl_blogs.id')
            ->with([
                'blog_translations' => function ($query) use ($locale) {
                    $query->where('lang', $locale)
                        ->select(['id', 'blog_id', 'name', 'short_description']);
                }
            ])
            ->with(['categories' => function ($query) use ($locale) {
                $query->where('is_publish', 1);
                $query->select([
                    'tl_blog_categories.id',
                    'tl_blog_categories.name',
                    'tl_blog_categories.permalink'
                ])
                    ->with(['category_translations' => function ($query) use ($locale) {
                        $query->where('lang', $locale)
                            ->select(['id', 'name', 'category_id']);
                    }]);
            }])
            ->where($match_case)
            ->groupBy('tl_blogs.id')
            ->select(
                'tl_blogs.id',
                DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
                DB::raw('COUNT(distinct tl_blog_comments.id) as comment_count'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.formate) as formate'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.gallery_images) as gallery_images'),
                DB::raw('GROUP_CONCAT(distinct tl_users.name) as user_name'),
                DB::raw('GROUP_CONCAT(distinct tl_users.image) as user_image'),
            )
            ->withCount('allblogComment')
            ->orderBy('comment_count', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($blog) {
                if (count($blog->blog_translations)) {
                    $blog->name = $blog->blog_translations->first()->name;
                    $blog->short_description = $blog->blog_translations->first()->short_description;
                    $blog->content = $blog->blog_translations->first()->content;
                }
                if (count($blog->categories)) {
                    foreach ($blog->categories as $key => $category) {
                        if (count($category->category_translations)) {
                            $category->name = $category->category_translations->first()->name;
                        }
                    }
                }
                $blog->blog_category = $blog->categories;
                return $blog;
            });

        return $most_comment_blogs;
    }
}

if (!function_exists('mostViewedBlogs')) {
    /**
     *Most Viewed Blogs
     * @return mixed|array
     */
    function mostViewedBlogs($limit)
    {
        $locale = getFrontLocale();

        $data = [
            DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.short_description) as short_description'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.content) as content'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
            DB::raw('GROUP_CONCAT(distinct tl_users.name) as user_name'),
            DB::raw('GROUP_CONCAT(distinct tl_users.image) as user_image'),
            DB::raw('GROUP_CONCAT(distinct tl_blog_categories.id) as category'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.formate) as formate'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.gallery_images) as gallery_images'),
        ];

        $match_case = [
            ['tl_blogs.publish_at', '<', currentDateTime()],
            ['tl_blogs.is_publish', '=', config('settings.blog_status.publish')],
            ['tl_blogs.visibility', '!=', 'private'],
        ];
        $most_viewed = true;
        $blog_repository = new BlogRepository();
        $most_viewed_blogs = $blog_repository->getBlogs($data, $match_case, $limit, null, '', false, $most_viewed, $locale);

        return $most_viewed_blogs;
    }
}

if (!function_exists('mostPopularBlogs')) {
    /**
     *Most Popular
     * @return mixed|array
     */
    function mostPopularBlogs($limit)
    {
        $locale = getFrontLocale();

        $data = [
            DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.short_description) as short_description'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.content) as content'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.views) as views'),
            DB::raw('GROUP_CONCAT(distinct tl_users.name) as user_name'),
            DB::raw('GROUP_CONCAT(distinct tl_users.image) as user_image'),
            DB::raw('GROUP_CONCAT(distinct tl_blog_categories.id) as category'),
            DB::raw('COUNT(distinct tl_blog_comments.id) as comment_count'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.formate) as formate'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.gallery_images) as gallery_images'),
        ];

        $match_case = [
            ['tl_blogs.publish_at', '<', currentDateTime()],
            ['tl_blogs.is_publish', '=', config('settings.blog_status.publish')],
            ['tl_blogs.visibility', '!=', 'private'],
        ];

        $blogs = TlBlog::join('tl_users', 'tl_users.id', '=', 'tl_blogs.user_id')
            ->leftJoin('tl_blogs_categories', 'tl_blogs_categories.blog_id', '=', 'tl_blogs.id')
            ->leftJoin('tl_blog_categories', 'tl_blog_categories.id', '=', 'tl_blogs_categories.category_id')
            ->leftJoin('tl_blogs_tags', 'tl_blogs_tags.blog_id', '=', 'tl_blogs.id')
            ->leftJoin('tl_blog_tags', 'tl_blog_tags.id', '=', 'tl_blogs_tags.tag_id')
            ->leftJoin('tl_blog_comments', 'tl_blog_comments.blog_id', '=', 'tl_blogs.id')
            ->with([
                'blog_translations' => function ($query) use ($locale) {
                    $query->where('lang', $locale)
                        ->select(['id', 'blog_id', 'name', 'short_description']);
                }
            ])
            ->with(['categories' => function ($query) use ($locale) {
                $query->where('is_publish', 1);
                $query->select([
                    'tl_blog_categories.id',
                    'tl_blog_categories.name',
                    'tl_blog_categories.permalink'
                ])
                    ->with(['category_translations' => function ($query) use ($locale) {
                        $query->where('lang', $locale)
                            ->select(['id', 'name', 'category_id']);
                    }]);
            }])
            ->where($match_case)
            ->groupBy('tl_blogs.id')
            ->select($data)
            ->withCount('allblogComment')
            ->orderBy('comment_count', 'desc')
            ->orderBy('tl_blogs.views', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($blog) use ($locale) {
                if (count($blog->blog_translations)) {
                    $blog->name = $blog->blog_translations->first()->name;
                    $blog->short_description = $blog->blog_translations->first()->short_description;
                    $blog->content = $blog->blog_translations->first()->content;
                }
                if (count($blog->categories)) {
                    foreach ($blog->categories as $key => $category) {
                        if (count($category->category_translations)) {
                            $category->name = $category->category_translations->first()->name;
                        }
                    }
                }
                $blog->blog_category = $blog->categories;
                return $blog;
            });

        return $blogs;
    }
}

if (!function_exists('blogsByCategory')) {
    /**
     *Frontend Blog Categories
     * @return mixed|array
     */
    function blogsByCategory($category, $limit)
    {
        $locale = getFrontLocale();

        $data = [
            DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.short_description) as short_description'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.content) as content'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
            DB::raw('GROUP_CONCAT(distinct tl_users.name) as user_name'),
            DB::raw('GROUP_CONCAT(distinct tl_users.image) as user_image'),
            DB::raw('GROUP_CONCAT(distinct tl_blog_categories.id) as category'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.formate) as formate'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.gallery_images) as gallery_images'),
        ];

        $match_case = [
            ['tl_blogs.publish_at', '<', currentDateTime()],
            ['tl_blogs.is_publish', '=', config('settings.blog_status.publish')],
            ['tl_blogs.visibility', '!=', 'private'],
            ['tl_blog_categories.id', '=', $category]
        ];
        // initialize Blog Repository
        $blog_repository = new BlogRepository();
        $category_blogs = $blog_repository->getBlogs($data, $match_case, $limit, null, '', false, false, $locale);
        return $category_blogs;
    }
}

if (!function_exists('getRelatedBlogs')) {
    /**
     * Will return related blog information
     */
    function getRelatedBlogs($slug, $count)
    {
            $blog_categories = DB::table('tl_blogs')
                ->join('tl_blogs_categories', 'tl_blogs_categories.blog_id', '=', 'tl_blogs.id')
                ->where('tl_blogs.permalink', '=', $slug)
                ->pluck('tl_blogs_categories.category_id');

            $blog_tags = DB::table('tl_blogs')
                ->join('tl_blogs_tags', 'tl_blogs_tags.blog_id', '=', 'tl_blogs.id')
                ->where('tl_blogs.permalink', '=', $slug)
                ->pluck('tl_blogs_tags.tag_id');

            $blogs = TlBlog::leftJoin('tl_blogs_tags', 'tl_blogs_tags.blog_id', '=', 'tl_blogs.id')
                ->leftJoin('tl_blogs_categories', 'tl_blogs_categories.blog_id', '=', 'tl_blogs.id')
                ->where('tl_blogs.permalink', '!=', $slug)
                ->where(function ($query) use ($blog_categories, $blog_tags) {
                    $query->whereIn('tl_blogs_categories.category_id', $blog_categories->toArray())
                        ->orWhereIn('tl_blogs_tags.tag_id', $blog_tags->toArray());
                })
                ->groupBy('tl_blogs.id')
                ->select([
                    DB::raw('tl_blogs.id'),
                    DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
                    DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
                    DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
                ])->take($count)->get();

            foreach ($blogs as $blog) {
                if($blog->image!=null){
                    $blog->image = asset(getFilePath($blog->image));
                }
                $blog->title = $blog->translation('name', Session::get('api_locale') );
            }

            return $blogs;
    }
}

if (!function_exists('commentClose')) {

    /**
     ** Comment Should be Close or not 
     * @return boolean
     */
    function commentClose($publish_at)
    {
        $commentSettings = commentFormSettings();
        $comment_close_date = date('Y-m-d', strtotime($publish_at . ' + ' . $commentSettings['close_comments_days_old'] . ' days'));
        $comment_close = currentDateTime() > $comment_close_date ? true : false;
        return $comment_close;
    }
}

if (!function_exists('getHomePageSectionProperties')) {
    /**
     * Will return home page section properties
     * @param Int $name section_id
     * @param String $key_name
     * @return String
     */
    function getHomePageSectionProperties($section_id, $key_name)
    {
        $properties = HomeSectionProperties::where('section_id', $section_id)->where('key_name', $key_name)->first();
        if ($properties != null) {
            return $properties->key_value;
        } else {
            return null;
        }
    }
}

if (!function_exists('getAllSidebarWidgets')) {
    /**
     * get all the widget of a sidebar
     * @return mixed|array
     */
    function getAllSidebarWidgets($sidebar_id)
    {
        $widgets = DB::table('tl_sidebar_has_widgets')
            ->join('tl_widgets', 'tl_widgets.id', '=', 'tl_sidebar_has_widgets.widget_id')
            ->where('tl_sidebar_has_widgets.sidebar_id', '=', $sidebar_id)
            ->select(
                'tl_sidebar_has_widgets.id as sidebar_has_widget_id',
                'tl_widgets.id as widget_id',
                'tl_widgets.widget_name',
            )
            ->orderBy('tl_sidebar_has_widgets.order', 'asc')
            ->get();

        return $widgets;
    }
}

if (!function_exists('getThemeOption')) {
    /**
     * get theme option of specific field
     * @return mixed|array
     */
    function getThemeOption($option_name, $active_theme_id)
    {
        $options = Cache::rememberForever('theme-option-settings', function () use ($active_theme_id) {
            return DB::table('tl_theme_option_settings')
                ->where('theme_id', $active_theme_id)
                ->select([
                    'tl_theme_option_settings.option_name',
                    'tl_theme_option_settings.field_name',
                    'tl_theme_option_settings.field_value'
                ])
                ->get();
        });

        $update_options = [];
        foreach ($options as $key => $value) {
            $update_options[$value->option_name][$value->field_name] = $value->field_value;
        }

        if (isset($option_name) && isset($update_options[$option_name])) {
            return $update_options[$option_name];
        } else {
            return [];
        }
    }
}


if (!function_exists('getAllFonts')) {
    /**
     * get all font family,variants and subsets from google api
     * @return mixed|array
     */
    function getAllFonts()
    {
        $url = config('default.google_font_api_key.url');
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $data = [];

        for ($i = 0; $i < sizeof($json_data['items']); $i++) {
            $item = $json_data['items'][$i];

            $data[$i]['family'] = $item['family'];
            $data[$i]['variants'] = json_encode($item['variants']);
            $data[$i]['subsets'] = json_encode($item['subsets']);
        }

        return $data;
    }
}

if (!function_exists('themeOptionToCss')) {
    /**
     * get theme options and make css
     * @return mixed|array
     */
    function themeOptionToCss($option_name, $active_theme_id)
    {
        $options = getThemeOption($option_name, $active_theme_id);
        $mainCss = [];

        foreach ($options as $key => $value) {
            $splitted_key = explode('_', $key);
            $property = array_pop($splitted_key);
            $section = join('_', $splitted_key);

            //ignore key
            if ($property === 'i') {
                continue;
            } elseif ($property === 's') {
                $mainCss['static'][$key] = $value;
                continue;
            } elseif ($property === 'c') {
                $mainCss['condition'][$key] = $value;
                continue;
            } else {
                if ($value != '') {
                    if (str_contains($section, '_u')) {
                        $splitted_section_name_array = explode('_', $section);
                        array_pop($splitted_section_name_array);
                        $section = join('_', $splitted_section_name_array);
                        $value = $value . $options[$section . '_unit_i'];
                    } else {
                        if ($property === 'color' || $property === 'background-color') {
                            if (isset($options[$key . "-transparent_i"])  && $options[$key . "-transparent_i"] == 1) {
                                $value = 'transparent';
                            }
                        }
                    }
                } else {
                    continue;
                }
                if ($property == 'font-family' && str_contains($value, 'custom')) {
                    $font_face_value = createFontFace($value);
                    if (!empty($font_face_value)) {
                        $mainCss['css']['@font-face-' . $section] = $font_face_value;
                    }
                }
                $mainCss['css'][$section][$property] = $value;
            }
        }
        return $mainCss;
    }
}

if (!function_exists('createFontFace')) {
    /**
     * creating font face
     * @param $font_family font family
     * @return mixed|string
     */
    function createFontFace($font_family)
    {
        $family_split = explode(',', $font_family);
        $custom_font_number = str_replace('-', '_', $family_split[0]);

        $active_theme = getActiveTheme();
        $custom_options = getThemeOption('custom_fonts', $active_theme->id);

        $customFontFace = [];
        if ($custom_options[$custom_font_number] == '1') {
            $customFontFace['font-family'] = $family_split[0];
            $font_woff_file = $custom_options[$custom_font_number . '_woff'];
            $font_ttf_file = $custom_options[$custom_font_number . '_ttf'];
            $font_eot_file = $custom_options[$custom_font_number . '_eot'];

            if ($font_woff_file != '') {
                if (isset($customFontFace['src']) && $customFontFace['src'] != '') {
                    $customFontFace['src'] = $customFontFace['src'] . ',' . "url('" . asset('themes/default/public/assets/' . $custom_font_number . '/' . $font_woff_file) . "')";
                } else {
                    $customFontFace['src'] = "url('" . asset('themes/default/public/assets/' . $custom_font_number . '/' . $font_woff_file) . "')";
                }
            }

            if ($font_ttf_file != '') {
                if (isset($customFontFace['src']) && $customFontFace['src'] != '') {
                    $customFontFace['src'] = $customFontFace['src'] . ',' . "url('" . asset('themes/default/public/assets/' . $custom_font_number . '/' . $font_ttf_file) . "')";
                } else {
                    $customFontFace['src'] = "url('" . asset('themes/default/public/assets/' . $custom_font_number . '/' . $font_ttf_file) . "')";
                }
            }

            if ($font_eot_file != '') {
                if (isset($customFontFace['src']) && $customFontFace['src'] != '') {
                    $customFontFace['src'] = $customFontFace['src'] . ',' . "url('" . asset('themes/default/public/assets/' . $custom_font_number . '/' . $font_eot_file) . "')";
                } else {
                    $customFontFace['src'] = "url('" . asset('themes/default/public/assets/' . $custom_font_number . '/' . $font_eot_file) . "')";
                }
            }
        }
        return $customFontFace;
    }
}

if (!function_exists('getThemeWidgetId')) {
    /**
     * Get theme widget id
     *
     * @param String $widget_name
     * @return mixed
     */
    function getThemeWidgetId($widget_name)
    {
        $active_theme = getActiveTheme();
        $name = ucwords(str_replace('_', ' ', $widget_name));
        $widget = TlWidget::firstOrCreate(['widget_name' => $name, 'theme_id' => $active_theme->id]);
        if ($widget != null) {
            return $widget->id;
        }
        return null;
    }
}

if (!function_exists('getThemeWidgetName')) {
    /**
     * Get theme widget name
     *
     * @param int $widget_id
     * @return mixed
     */
    function getThemeWidgetName($widget_id)
    {
        $active_theme = getActiveTheme();
        $widget = TlWidget::where(['id' => $widget_id, 'theme_id' => $active_theme->id])->first();
        if ($widget != null) {
            $name = str_replace(' ', '_', strtolower($widget->widget_name));
            return $name;
        }
        return null;
    }
}

if (!function_exists('getThemeWidgetNameAsArray')) {
    /**
     * Get theme widget name as array
     *
     * @param String $theme_widget_names
     * @return mixed
     */
    function getThemeWidgetNameAsArray($theme_widget_names)
    {
        $all_settings_name = config('default.' . $theme_widget_names);
        $names = [];
        $ids = [];
        for ($i = 0; $i < sizeof($all_settings_name); $i++) {
            $ids[$i] = getThemeWidgetId($all_settings_name[$i]);
            $names[$i] = $all_settings_name[$i];
        }
        return $names;
    }
}

if (!function_exists('getThemeSidebarId')) {
    /**
     * Get theme sidebar id
     *
     * @param String $sidebar_name
     * @return mixed
     */
    function getThemeSidebarId($sidebar_name)
    {
        $active_theme = getActiveTheme();
        $name = ucwords(str_replace('_', ' ', $sidebar_name));
        $sidebar = TlThemeSidebar::firstOrCreate(['sidebar_name' => $name, 'theme_id' => $active_theme->id]);
        if ($sidebar != null) {
            return $sidebar->id;
        }
        return null;
    }
}

if (!function_exists('getThemeSidebarNameAsArray')) {
    /**
     * Get theme widget name as array
     *
     * @param String $theme_widget_names
     * @return mixed
     */
    function getThemeSidebarNameAsArray($theme_sidebar_names)
    {
        $all_settings_name = config('default.' . $theme_sidebar_names);
        $names = [];
        $ids = [];
        for ($i = 0; $i < sizeof($all_settings_name); $i++) {
            $ids[$i] = getThemeSidebarId($all_settings_name[$i]);
            $names[$i] = $all_settings_name[$i];
        }
        return $names;
    }
}

if (!function_exists('getSidebarWidgetValues')) {
    /**
     * Will return values for widgets in sidebar
     * @param Int $sidebar_has_widget_id
     * @return String
     */
    function getSidebarWidgetValues($sidebar_has_widget_id, $lang)
    {
        $sidebar_widget_value = TlSidebarWidgetHasValue::where('sidebar_has_widget_id', $sidebar_has_widget_id)->first();
        $value = null;
        if ($sidebar_widget_value != null) {
            $translated_value = $sidebar_widget_value->translation('value', $lang);
            if ($sidebar_widget_value->value != null) {
                $value = array_replace(json_decode($sidebar_widget_value->value, true), json_decode($translated_value, true));
            } else {
                $value = json_decode($translated_value, true);
            }
        }
        return $value;
    }
}

if (!function_exists('makeCssProperties')) {
    /**
     * make array to css
     * @param array $themeOption
     * @return string
     */
    function makeCssProperties($themeOption)
    {
        $pre_style = substr(json_encode($themeOption), 1, -1);
        $after_removing_quote = str_replace('"', '', $pre_style);
        $after_removing_colon = str_replace(':{', '{' . "\n", $after_removing_quote);
        $after_removing_comma = str_replace('},', '}' . "\n", $after_removing_colon);
        $after_removing_comma_inside_css = str_replace(';,', ';' . "\n", $after_removing_comma);
        $after_adding_newline = str_replace(';}', ';' . "\n" . '}', $after_removing_comma_inside_css);
        $all_fontface = [
            '@font-face-body_font',
            '@font-face-paragraph_font',
            '@font-face-all_heading_font',
            '@font-face-h1_heading_font',
            '@font-face-h2_heading_font',
            '@font-face-h3_heading_font',
            '@font-face-h4_heading_font',
            '@font-face-h5_heading_font',
            '@font-face-h6_heading_font',
            '@font-face-menu_font',
            '@font-face-sub_menu_font',
            '@font-face-button_font',
            '@font-face-widget_title_font',
            '@font-face-page_title_font',
        ];
        $after_modify_fontface = str_replace($all_fontface, '@font-face', $after_adding_newline);

        return $after_modify_fontface;
    }
}


if (!function_exists('setFolderPermissions')) {
    /**
     * set folder permissions
     * @return string
     */
    function setFolderPermissions($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
        fopen($path, 'w');
        chmod($path, 0777);
    }
}


if (!function_exists('homePageCss')) {
    /**
     * Css From Home Page Builder
     * @return string
     */
    function homePageCss($sections)
    {
        $homePageCss = [];
        foreach ($sections as $key => $properties) {
            $section = '#' . $properties['layout'] . '_' . $key;
            if ($properties['layout'] !== 'ads') {
                if ($properties['layout'] == 'slider') {
                    if ($properties['title_color']) {
                        $homePageCss[$section . ' ' . '.title h1 a']['color'] = $properties['title_color'] . '!important;';
                    }
                    if ($properties['category_color'] && $properties['category_color'] != '') {
                        $homePageCss[$section . ' ' . '.cats a']['color'] = $properties['category_color'] . '!important;';
                    }
                } else {
                    if ($properties['title_color'] && $properties['title_color'] != '') {
                        $homePageCss[$section . ' ' . '.title h2 a']['color'] = $properties['title_color'] . '!important;';
                    }
                    if ($properties['description_color'] && $properties['description_color'] != '') {
                        $homePageCss[$section . ' ' . '.desc p']['color'] = $properties['description_color'] . '!important;';
                    }

                    if ($properties['btn_color'] && $properties['btn_color'] != '') {
                        $homePageCss[$section . ' ' . '.read_more_button']['color'] = $properties['btn_color'] . '!important;';
                    }
                    if ($properties['btn_hover_color'] && $properties['btn_hover_color'] != '') {
                        $homePageCss[$section . ' ' . '.read_more_button:hover']['color'] = $properties['btn_hover_color'] . '!important;';
                    }
                    if ($properties['btn_bg_color'] && $properties['btn_bg_color'] != '') {
                        $homePageCss[$section . ' ' . '.read_more_button']['background-color'] = $properties['btn_bg_color'] . '!important;';
                    }
                    if ($properties['btn_bg_hover_color'] && $properties['btn_bg_hover_color'] != '') {
                        $homePageCss[$section . ' ' . '.read_more_button:hover']['background-color'] = $properties['btn_bg_hover_color'] . '!important;';
                    }
                    $homePageCss[$section . ' ' . '.read_more_button']['border'] = ($properties['btn_border'] ? $properties['btn_border'] : '0') . 'px solid;';
                    if ($properties['btn_border_color'] &&  $properties['btn_border_color'] != '') {
                        $homePageCss[$section . ' ' . '.read_more_button']['border-color'] = $properties['btn_border_color'] . '!important;';
                    }
                    if ($properties['btn_border_hover_color'] && $properties['btn_border_hover_color'] != '') {
                        $homePageCss[$section . ' ' . '.read_more_button:hover']['border-color'] = $properties['btn_border_hover_color'] . '!important;';
                    }
                }
            }

            if ($properties['bg_color'] && $properties['bg_color'] != '') {
                $homePageCss[$section]['background-color'] = $properties['bg_color'] . '!important;';
            }
            if (isset($properties['bg_image']) && !empty($properties['bg_image'])) {
                $homePageCss[$section]['background-image'] = "url('" . asset(getFilePath($properties['bg_image'])) . "');";
            }
            $homePageCss[$section]['background-size'] = $properties['background_size'] . ';';
            $homePageCss[$section]['background-position'] = $properties['background_position'] . ';';
            $homePageCss[$section]['background-repeat'] = $properties['background_repeat'] . ';';

            $homePageCss[$section]['padding-top'] = ($properties['padding_top'] ? $properties['padding_top'] : '0') . 'px;';
            $homePageCss[$section]['padding-right'] = ($properties['padding_right'] ? $properties['padding_right'] : '0') . 'px;';
            $homePageCss[$section]['padding-bottom'] = ($properties['padding_bottom'] ? $properties['padding_bottom'] : '0') . 'px;';
            $homePageCss[$section]['padding-left'] = ($properties['padding_left'] ? $properties['padding_left'] : '0') . 'px;';
            $homePageCss[$section]['margin-top'] = ($properties['margin_top'] ? $properties['margin_top'] : '0') . 'px;';
            $homePageCss[$section]['margin-right'] = ($properties['margin_right'] ? $properties['margin_right'] : '0') . 'px;';
            $homePageCss[$section]['margin-bottom'] = ($properties['margin_bottom'] ? $properties['margin_bottom'] : '0') . 'px;';
            $homePageCss[$section]['margin-left'] = ($properties['margin_left'] ? $properties['margin_left'] : '0') . 'px;';
        }

        $style = '<style>' . "\n" . makeCssProperties($homePageCss) . "\n" . '</style>';
        return $style;
    }
}


if (!function_exists('getJsonThemeOption')) {
    /**
     * get theme options json data
     * @return JSON
     * 
     */
    function getJsonThemeOption($file = false)
    {
        $active_theme = getActiveTheme();
        $data = TlThemeOptionSettings::where('theme_id', $active_theme->id)->get();
        if (!$file) {
            return $data->toJson();
        }
        $filename = 'theme_option.json';

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->json($data, 200, $headers);
    }
}

if (!function_exists('getFrontLocale')) {
    /**
     * get the frontend local lang
     *
     * @return String
     */

    function getFrontLocale()
    {
        $locale = getDefaultLang();
        if (Session::has('api_locale')) {
            $locale = Session::get('api_locale');
        }
        return $locale;
    }
}

if (!function_exists('getActiveFrontLangRTL')) {
    /**
     * get the frontend local lang
     *
     * @return String
     */

    function getActiveFrontLangRTL()
    {
        $rtl = false;
        $active_lang_code = getFrontLocale();
        $lang = Cache::rememberForever('active-frontend-lang', function () use ($active_lang_code) {
            return Language::where('code', $active_lang_code)->first();
        });

        if ($lang->is_rtl == config('settings.general_status.active')) {
            $rtl = true;
        }

        return $rtl;
    }
}

if (!function_exists('blogFilterSeo')) {
    /**
     * Blog Filter Seo
     *@param string $filter
     *@param string $permalink
     * @return array
     */

    function blogFilterSeo($filter, $permalink)
    {
        if ($filter == 'category') {
            $type = TlBlogCategory::where('permalink', $permalink)->first();
        }
        if ($filter == 'tag') {
            $type = TlBlogTag::where('permalink', $permalink)->first();
        }
        $seo = [];
        $seo['site_meta_title'] = $type->meta_title;
        $seo['site_meta_description'] = $type->meta_description;
        $seo['site_meta_image'] = $type->meta_image;
        $seo['filter_name'] = $type->translation('name', getFrontLocale());

        return $seo;
    }
}


if (!function_exists('findAdsense')) {
    /**
     * find adsense
     * @return mixed
     */

    function findAdsense($id, $adsense_list)
    {
        foreach ($adsense_list as $element) {
            if ($element['adsense_index'] == $id) {
               return $element['adsense_code'];
            }
        }
        return false;
    }
}
