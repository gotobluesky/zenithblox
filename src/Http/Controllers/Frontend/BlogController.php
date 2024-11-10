<?php

namespace Theme\Default\Http\Controllers\Frontend;

use Core\Models\User;
use Core\Models\TlBlog;
use Core\Models\TlBlogTag;
use Illuminate\Http\Request;
use Core\Models\TlBlogCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Theme\Default\Repositories\BlogRepository;
use Share;

class BlogController extends Controller
{
    protected $blog_repository;
    public $comment_setting;
    /**
     ** Initializing Blog Repository
     */
    public function __construct(BlogRepository $blog_repository)
    {
        $this->blog_repository = $blog_repository;
        $this->comment_setting = commentFormSettings();
    }

    /**
     ** Show all the blogs
     *
     * @return View
     */
    public function blogs()
    {
        try {
            $blogs = $this->blogFilter(null, '', true);
            return view('theme/default::frontend.pages.blogs', compact('blogs'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     ** Show all the blogs
     * @param $permalink TlBlogCategory permalink
     * @return View
     */
    public function blogByCategory($permalink)
    {
        try {
            $category = TlBlogCategory::where('permalink', $permalink)->first();

            if ($category && $category->is_publish == 1) {
                $condition = ['tl_blog_categories.permalink', '=', $permalink];
                $blogs = $this->blogFilter($condition);
                $filter = 'category';
                return view('theme/default::frontend.pages.blogs', compact('blogs', 'filter', 'permalink'));
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     ** Show all the blogs
     * @param $permalink TlBlogTag permalink
     * @return View
     */
    public function blogByTag($permalink)
    {
        try {
            $tag = TlBlogTag::where('permalink', $permalink)->first();

            if ($tag && $tag->is_publish == 1) {
                $condition = ['tl_blog_tags.permalink', '=', $permalink];
                $blogs = $this->blogFilter($condition);
                $filter = 'tag';
                return view('theme/default::frontend.pages.blogs', compact('blogs', 'filter', 'permalink'));
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     ** Show all the featured Blogs
     * @return View
     */
    public function blogByFeatured()
    {
        try {
            $condition = ['tl_blogs.is_featured', '=', 1];
            $blogs = $this->blogFilter($condition);
            $filter = 'featured';
            return view('theme/default::frontend.pages.blogs', compact('blogs', 'filter'));
        } catch (\Exception $e) {
            abort(404);
        }
    }


    /**
     ** Show all the blog matching text
     * @return View
     */
    public function blogBySearch($text)
    {
        try {
            $blogs = $this->blogFilter(null, $text);
            $filter = 'search';
            return view('theme/default::frontend.pages.blogs', compact('blogs', 'filter', 'text'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     ** Show all the blog under a author
     * @return View
     */
    public function blogByAuthor($author)
    {
        try {
            $author_name = str_replace('-', ' ', $author);
            $author = User::where('name', $author_name)->first();
            $condition = ['tl_blogs.user_id', '=', $author->id];
            $blogs = $this->blogFilter($condition);
            $filter = 'author';
            $author_name = $author->name;
            return view('theme/default::frontend.pages.blogs', compact('blogs', 'filter', 'author_name', 'author'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     ** Show all the blog under a date
     * @return View
     */
    public function blogByDate($date)
    {
        try {
            $blog_date =  Carbon::create($date)->toDateString();
            Session::put('blog-filter-date', $blog_date);
            $blogs = $this->blogFilter(null);
            Session::forget('blog-filter-date');
            $filter = 'date';
            return view('theme/default::frontend.pages.blogs', compact('blogs', 'filter', 'date'));
        } catch (\Exception $e) {
            abort(404);
        }
    }


    /**
     ** Blogs Filter By Different Condition
     * @param $condition
     * @return View
     */
    public function blogFilter($condition = null, $search = '', $sticky = false)
    {
        $active_theme = getActiveTheme();
        $blog = getThemeOption('blog', $active_theme->id);
        $paginate = 10;
        if (isset($blog['custom_blog_style']) && $blog['custom_blog_style'] == 1 && isset($blog['blog_perpage']) && !empty($blog['blog_perpage']) && $blog['blog_perpage'] != 0) {
            $paginate = $blog['blog_perpage'];
        }
        $data = [
            DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.visibility) as visibility'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.short_description) as short_description'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.reading_time) as reading_time'),
            DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
            DB::raw('GROUP_CONCAT(distinct tl_users.id) as user_id'),
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
        if (isset($condition)) {
            array_push($match_case, $condition);
        }
        $locale = getFrontLocale();

        $blog = $this->blog_repository->getBlogs($data, $match_case, null, $paginate, $search, $sticky, false, $locale);
        return $blog;
    }

    /**
     ** Show the Blog Details page
     * @return View
     */
    public function blog_details($slug)
    {
        try {
            $data = [
                DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.short_description) as short_description'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.reading_time) as reading_time'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.visibility) as visibility'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.content) as content'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.is_featured) as is_featured'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.is_publish) as is_publish'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.meta_title) as meta_title'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.meta_description) as meta_description'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.meta_image) as meta_image'),
                DB::raw('GROUP_CONCAT(distinct tl_users.id) as user_id'),
                DB::raw('GROUP_CONCAT(distinct tl_blog_categories.id) as category'),
                DB::raw('GROUP_CONCAT(distinct tl_blog_tags.id) as tag'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.formate) as formate'),
                DB::raw('GROUP_CONCAT(distinct tl_blogs.gallery_images) as gallery_images'),
            ];
            $match_case = [
                ['tl_blogs.publish_at', '<', currentDateTime()],
                ['tl_blogs.is_publish', '=',  config('settings.blog_status.publish')],
                ['tl_blogs.permalink', '=', $slug],
            ];
            $locale = getFrontLocale();

            $blog = $this->blog_repository->getBlogs($data, $match_case, null, null, '', false, false, $locale)->first();
            if ($blog != null) {
                $blog->name = count($blog->blog_translations) ? $blog->blog_translations->first()->name : $blog->name;
                $blog->short_description = count($blog->blog_translations) ? $blog->blog_translations->first()->short_description : $blog->short_description;
                $content = TlBlog::find($blog->id)->content;
                $blog->content = count($blog->blog_translations) ? $blog->blog_translations->first()->content : $content;
                if (count($blog->categories)) {
                    foreach ($blog->categories as $key => $category) {
                        if (count($category->category_translations)) {
                            $category->name = $category->category_translations->first()->name;
                        }
                    }
                }

                $blog->blog_category = $blog->categories;
                $blog->content = fix_image_urls($blog->content);

                TlBlog::find($blog->id)->increment('views');
                $blog_shares = Share::load(route('theme.default.blog_details', $blog->permalink), $blog->name)->services();
                return view('theme/default::frontend.pages.blog_details', compact('blog', 'blog_shares'));
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     ** Get Blog Content for Password protected Blog
     *
     * @param Request $request via AJAX
     * @return \Illuminate\Http\Response json
     */
    public function getBlogContent(Request $request)
    {
        try {
            $permalink = isset($request->permalink) ? $request->permalink : null;

            if (!isset($permalink)) {
                return response()->json(['error' => front_translate('Blog Content Loading Failed')]);
            }
            $blog = $this->blog_repository->findBlog($permalink);

            if ($request->is_authenticate == 'true') {
                return response()->json(['success' => 'Success', 'content' => xss_clean(fix_image_urls($blog->content))]);
            }

            if ($request->password == Crypt::decrypt($blog->blog_password)) {
                $content = xss_clean($blog->translation('content', getFrontLocale()));
                return response()->json(['success' => 'Success', 'content' => $content]);
            } else {
                return response()->json(['error' => front_translate('Incorrect Password')]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => front_translate('Blog Content Loading Failed')]);
        }
    }

    /**
     ** Load Comment for a blog
     *
     * @param Request $request via AJAX
     * @return \Illuminate\Http\Response json
     */
    public function loadBlogComment(Request $request)
    {
        try {
            $blog = $this->blog_repository->findBlog($request->permalink, ['id', 'publish_at', 'permalink']);
            $blog_comments = $this->blog_repository->getBlogComment($blog->id);
            $comment_setting = $this->comment_setting;

            $view = view('theme/default::frontend.includes.blog_comment', compact('blog_comments', 'blog', 'comment_setting'))->render();
            return response()->json(['success' => front_translate('Comment Loaded Successfully'), 'view' => $view]);
        } catch (\Exception $e) {
            return response()->json(['error' => front_translate('Comment Loading Failed')]);
        }
    }

    /**
     ** Create Blog Comment
     *
     * @param Request $request via AJAX
     * @return \Illuminate\Http\Response json
     */
    public function createBlogComment(Request $request)
    {
        try {
            $rules = [
                'comment' => 'required'
            ];
            if (!$request->user_id) {
                if ($this->comment_setting['require_name_email'] == '1') {
                    $rules['user_name'] = 'required|max:50';
                    $rules['user_email'] = 'required|email';
                } else {
                    $rules['user_name'] = 'nullable|max:50';
                    $rules['user_email'] = 'nullable|email';
                }
            }
            $validator = Validator::make($request->all(), $rules);

            if ($validator->passes()) {
                DB::beginTransaction();
                $comment = $this->blog_repository->createBlogComment($request);
                $commentFiltrationResult = $this->blog_repository->commentFiltration($comment);
                DB::commit();

                return response()->json($commentFiltrationResult);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => front_translate('Comment Added Failed')]);
        }
    }
}
