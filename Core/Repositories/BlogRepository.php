<?php

namespace Core\Repositories;

use Core\Models\User;
use Core\Models\TlBlog;
use Core\Models\TlBlogTag;
use Core\Models\TlBlogsTag;
use Core\Models\TlBlogComment;
use Core\Models\TlBlogCategory;
use Core\Models\TlBlogsCategory;
use Core\Models\TlBlogTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Core\Models\TlBlogTagTranslation;
use Illuminate\Support\Facades\Crypt;
use Core\Models\TlBlogCategoryTranslation;
use Illuminate\Support\Facades\Notification;
use Core\Notifications\CommentMailNotification;

class BlogRepository
{
    /**
     * Get all the Categories.
     *
     * @return mixed|array|boolean
     */
    public function getAllBlogCategories($match_case, $per_page, $search = '')
    {
        return  TlBlogCategory::where($match_case)->where('name', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->paginate($per_page);
    }

    /**
     * Get all the parent categories.
     *
     * @return mixed|array|boolean
     */
    public function getParentCategories($condition = null)
    {
        return TlBlogCategory::where('parent', NULL)->where($condition)->orderBy('id', 'DESC')->get();
    }

    /**
     * Store new category.
     *
     * @param mixed|$request array
     */
    public function addNewCategory($request)
    {
        $category = new TlBlogCategory();
        $category->name = xss_clean($request['name']);
        $category->parent = $request['parent'];
        $category->meta_title = xss_clean($request['meta_title']);
        $category->permalink = xss_clean($request['permalink']);
        $category->meta_description = xss_clean($request['meta_description']);
        $category->short_description = xss_clean($request['short_description']);
        $category->meta_image = $request['meta_image'];
        $category->is_publish = 1;
        $category->save();
        return $category;
    }

    /**
     * Find a category by id.
     *@param TlBlogCategory id
     * @return mixed|boolean
     */
    public function findCategory($category_id)
    {
        return  TlBlogCategory::findOrFail($category_id);
    }

    /**
     * Update a Category.
     * If lang is not en then store or update translation.
     * 
     * @param mixed|$request array
     * @return mixed|boolean
     */
    public function updateCategory($request)
    {
        if ($request['lang'] != null && $request['lang'] != getDefaultLang()) {
            $category_translation = TlBlogCategoryTranslation::firstOrNew(['category_id' => $request['id'], 'lang' => $request['lang']]);
            $category_translation->name = xss_clean($request['name']);
            $category_translation->short_description = xss_clean($request['short_description']);
            $category_translation->save();
        } else {

            $category = TlBlogCategory::findOrFail($request['id']);
            $category->name = xss_clean($request['name']);
            $category->parent = $request['parent'];
            $category->meta_title = xss_clean($request['meta_title']);
            $category->permalink = xss_clean($request['permalink']);
            $category->meta_description = xss_clean($request['meta_description']);
            $category->short_description = xss_clean($request['short_description']);
            $category->meta_image = $request['meta_image'];
            $category->is_publish = 1;
            $category->update();
        }
    }

    /**
     * Delete a Category.
     * before deleting check if category has blog/child or not.
     * 
     *@param TlBlogCategory id
     * @return mixed|boolean
     */
    public function deleteCategory($category_id)
    {
        $category = $this->findCategory($category_id);
        $blogs = $this->blogCountByCategory($category_id);

        if ($blogs == 0) {
            if (count($category->childs)) {
                return [
                    'status' => 'error',
                    'message' => translate('A Parent Category Cannot Be deleted.First Delete The Child Category')
                ];
            }
            $category->delete();
            return [
                'status' => 'success',
                'message' => translate('Blog Category Deleted Successfully')
            ];
        } else {
            return [
                'status' => 'error',
                'message' => $category->name . translate('Category Cannot Be Deleted! There are Blogs Available')
            ];
        }
    }

    /**
     * Bulk Delete a Category.
     * before deleting check if category has blog/child or not.
     * 
     * @param TlBlogCategory id array
     * @return mixed|array|boolean
     */
    public function bulkDeleteCategory($data)
    {
        $blogs = TlBlogsCategory::whereIn('category_id', $data)->get();
        $categories = TlBlogCategory::whereIn('id', $data)->get();

        if (count($blogs) > 0) {
            return [
                'status' => 'error',
                'message' => translate('Category Cannot Be Deleted! There are Blogs Available')
            ];
        } else {

            foreach ($categories as $category) {
                if (count($category->childs)) {
                    return [
                        'status' => 'error',
                        'message' => translate('A Parent Category Cannot Be deleted.First Delete The Child Category')
                    ];
                }
            }
            TlBlogCategory::whereIn('id', $data)->delete();
            return [
                'status' => 'success',
                'message' => translate('Blog Category Deleted Successfully')
            ];
        }
    }

    /**
     * Category Featured/Publish Status Update
     * 
     * @param TlBlogCategory id array
     * @param string $status
     * @return mixed|array|boolean
     */
    public function updateCategoryStatus($status, $category_id)
    {
        $category = $this->findCategory($category_id);

        switch ($status) {
            case 'featured':
                if ($category->is_featured == 1) {
                    $category->is_featured = null;
                    $result = 'of';
                } else {
                    $category->is_featured = 1;
                    $result = 'on';
                }
                $category->update();
                return ['success' => translate('Blog Category Featured Status Changed Successfully'), 'result' => $result];
                break;

            case 'publish':
                if ($category->is_publish == 1) {
                    $category->is_publish = null;
                    $result = 'of';
                } else {
                    $category->is_publish = 1;
                    $result = 'on';
                }
                $category->update();
                return ['success' => translate('Blog Category Publish Status Changed Successfully'), 'result' => $result];
                break;
        }
    }

    /**
     * Count Blogs for a category
     * 
     * @param TlBlogCategory id array
     * @return mixed|integer|boolean
     */
    public function blogCountByCategory($category_id)
    {
        return count(TlBlogsCategory::where('category_id', $category_id)->get());
    }

    /**
     * Get All Tags on condition
     * @param array $condition where condition
     * @param integer $limit limit
     * 
     * @return mixed|array|boolean
     */
    public function getAllTags($condition = null, $limit = null, $pagination = null, $search = '')
    {
        $tags = TlBlogTag::where($condition)->where('name', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc');

        if (isset($pagination)) {
            $tags = $tags->paginate($pagination);
        } else {
            if (isset($limit)) {
                $tags = $tags->limit($limit)->get();
            } else {
                $tags = $tags->get();
            }
        }

        return  $tags;
    }

    /**
     * Add a new Tag
     * @param array Request $request 
     */
    public function addNewTag($request)
    {
        $tag = new TlBlogTag();
        $tag->name = xss_clean($request['name']);
        $tag->permalink = xss_clean($request['permalink']);
        $tag->meta_title = xss_clean($request['meta_title']);
        $tag->meta_description = xss_clean($request['meta_description']);
        $tag->meta_image = $request['meta_image'];
        $tag->is_publish = 1;
        $tag->save();
        return $tag;
    }

    /**
     * Find a tag
     * @param array Request $request 
     * @return mixed|array
     */
    public function findTag($tag_id)
    {
        return TlBlogTag::findOrFail($tag_id);
    }

    /**
     * Update a Tag.
     * If lang is not en then store or update translation.
     * 
     * @param mixed|array $request 
     * @return void
     */
    public function updateTag($request)
    {
        if ($request['lang'] != null && $request['lang'] != getDefaultLang()) {

            $tag_translation = TlBlogTagTranslation::firstOrNew(['tag_id' => $request['id'], 'lang' => $request['lang']]);
            $tag_translation->name = xss_clean($request['name']);
            $tag_translation->save();
        } else {
            $tag = $this->findTag($request['id']);
            $tag->name = xss_clean($request['name']);
            $tag->permalink = xss_clean($request['permalink']);
            $tag->meta_title = xss_clean($request['meta_title']);
            $tag->meta_description = xss_clean($request['meta_description']);
            $tag->meta_image = $request['meta_image'];
            $tag->is_publish = 1;
            $tag->update();
        }
    }

    /**
     * Delete a Tag.
     * 
     *@param integer Tag $tag_id
     * @return mixed|array
     */
    public function deleteTag($tag_id)
    {
        $this->findTag($tag_id)->delete();
    }


    /**
     * Bulk Delete a Tag.
     * 
     * @param array $data Tag ids array
     * @return mixed|array
     */
    public function bulkDeleteTag($data)
    {
        TlBlogTag::whereIn('id', $data)->delete();
    }

    /**
     * Bulk Delete a Tag.
     * 
     * @param array $data Tag ids array
     * @return mixed|array
     */
    public function updateTagPublicStatus($request)
    {
        $tag = $this->findTag($request['id']);

        if ($tag->is_publish == 1) {
            $tag->is_publish = null;
            $result = 'of';
        } else {
            $tag->is_publish = 1;
            $result = 'on';
        }
        $tag->update();
        return ['success' => translate('Tag Publish Status Changed Successfully'), 'result' => $result];
    }

    /**
     * Get Blog List by different conditions.
     * 
     * @param array $data select from
     * @param array $match_case where condition
     * @param integer $limit limit
     * @param integer $paginate_page paginate number
     * @param string $search search text
     * @param boolean $sticky order sticky true/false
     *
     * @return mixed|integer|boolean
     */
    public function getBlogs($data = ['*'], $match_case = [], $limit = null, $paginate_page = null, $search = '', $sticky = false)
    {

        $blogs = TlBlog::join('tl_users', 'tl_users.id', '=', 'tl_blogs.user_id')
            ->leftJoin('tl_blogs_categories', 'tl_blogs_categories.blog_id', '=', 'tl_blogs.id')
            ->leftJoin('tl_blog_categories', 'tl_blog_categories.id', '=', 'tl_blogs_categories.category_id')
            ->leftJoin('tl_blogs_tags', 'tl_blogs_tags.blog_id', '=', 'tl_blogs.id')
            ->leftJoin('tl_blog_tags', 'tl_blog_tags.id', '=', 'tl_blogs_tags.tag_id');

        if ($sticky) {
            $blogs = $blogs->orderBy('tl_blogs.is_sticky', 'desc');
        }
        $blogs = $blogs->orderBy('tl_blogs.created_at', 'desc')
            ->groupBy('tl_blogs.id')
            ->where($match_case);

        $blogs = $blogs->where(function ($query) use ($search) {
            $query->where('tl_blogs.name', 'like', '%' . $search . '%')
                ->orWhere('tl_blog_categories.name', 'like', '%' . $search . '%')
                ->orWhere('tl_blog_tags.name', 'like', '%' . $search . '%')
                ->orWhere('tl_blogs.content', 'like', '%' . $search . '%')
                ->orWhere('tl_users.name', 'like', '%' . $search . '%');
        });

        $blogs = $blogs->select($data);

        if (isset($paginate_page)) {
            $blogs = $blogs->paginate($paginate_page);
        } else {
            if (isset($limit)) {
                $blogs = $blogs->limit($limit)->get();
            }
        }
        return $blogs;
    }


    /**
     ** Get all the category for a blog
     * @param TlBlog $id
     * @return mixed|array
     */
    public function getBlogCategory($id)
    {

        $blog_categories =  DB::table('tl_blogs_categories')
            ->where('blog_id', '=', $id)
            ->select(DB::raw('group_concat(category_id) as categories'))
            ->get();

        $blog_category = explode(',', $blog_categories[0]->categories);

        if ($blog_category[0] == '') {
            return null;
        } else {
            return $blog_category;
        }
    }

    /**
     ** get all the tags for a blog
     * @param TlBlog $id
     * @return mixed|array
     */
    public function getBlogTag($id)
    {
        $blog_tags =  DB::table('tl_blogs_tags')
            ->where('blog_id', '=', $id)
            ->select(DB::raw('group_concat(tag_id) as tags'))
            ->get();

        $blog_tag = explode(',', $blog_tags[0]->tags);

        if ($blog_tag[0] == '') {
            return null;
        } else {
            return $blog_tag;
        }
    }

    /**
     ** get a blog by permalink
     * @param TlBlog $permalink
     * @return mixed|array
     */
    public function findBlog($permalink)
    {
        return TlBlog::where('permalink', $permalink)->first();
    }

    /**
     ** get a blog by id
     * @param TlBlog $id
     * @return mixed|array
     */
    public function findBlogByID($id)
    {
        return TlBlog::findOrFail($id);
    }

    /**
     ** blog update
     * @param TlBlog $request
     * @return void
     */
    public function blogUpdate($request)
    {
        if ($request['lang'] != null && $request['lang'] != getDefaultLang()) {

            $blog_translation = TlBlogTranslation::firstOrNew(['blog_id' => $request['id'], 'lang' => $request['lang']]);
            $blog_translation->name = xss_clean($request['name']);
            $blog_translation->short_description = xss_clean($request['short_description']);
            $blog_translation->content = xss_clean($request['content']);
            $blog_translation->save();
        } else {
            $this->blogCreateUpdate($request, $request->id);
        }
    }

    /**
     ** This function is for Create Or Update blog based on parameter passed.
     ** If Id is set then it will update the blog , if not
     ** it will create a new blog.
     ** action param is for draft and preview. if action is set then publish is null and if action is not set then publish is 1.
     * @param mixed|array $request
     * @param mixed $id
     * @param mixed $action
     * @return mixed/array created or updated $blog
     */
    public function blogCreateUpdate($request, $id = null, $action = null)
    {
        $blog = TlBlog::firstOrNew(['id' => $id]);
        $blog->reading_time = getReadingTime($request['content']);

        if (isset($request['blog_image'])) {
            $blog->image = $request['blog_image'];
        }
        $blog->name = xss_clean($request['name']);
        $blog->permalink = xss_clean($request['permalink']);
        $blog->short_description = xss_clean($request['short_description']);
        $blog->content = xss_clean(fix_image_urls($request['content'], 'remove'));

        $blog->visibility = $request['visibility'];
        $blog->is_sticky = isset($request['sticky']) ? 1 : 0;

        if ($request['visibility'] == 'password') {
            if (!isset($request['blog_password'])) {
                $blog->visibility = 'public';
            }
        }

        $blog->blog_password = $request['blog_password'] != '' ? Crypt::encrypt($request['blog_password']) : null;
        $blog->publish_at = isset($request['publish_at']) &&  $request['publish_at'] != '' ? $request['publish_at'] : currentDateTime();
        $blog->meta_title = xss_clean($request['meta_title']);
        $blog->meta_description = xss_clean($request['meta_description']);
        $blog->meta_image = $request['meta_image'];
        $blog->is_featured = isset($request['is_featured']) ? 1 : null;
        $formats = ['standard', 'video', 'audio', 'gallery'];
        $blog->formate = isset($request['formate']) && in_array($request['formate'], $formats) ? $request['formate']:'standard';
        if(isset($request['gallery_images']) && $request['formate'] === 'gallery'){
            $blog->gallery_images = isset($request['gallery_images']) && $request['formate'] === 'gallery' ? $request['gallery_images']:null;
        }

        if (isset($id)) {

            if (isset($action)) {

                if (!($action == 'preview' && $blog->is_publish == config('settings.blog_status.publish'))) {
                    if ($action === 'pending') {
                        $blog->is_publish = config('settings.blog_status.pending');
                    } else {
                        $blog->is_publish = config('settings.blog_status.draft');
                    }
                }
            } else {
                $blog->is_publish = config('settings.blog_status.publish');
            }

            $blog->update();
        } else {

            if (isset($action)) {
                if ($action === 'pending') {
                    $blog->is_publish = config('settings.blog_status.pending');
                } else {
                    $blog->is_publish = config('settings.blog_status.draft');
                }
            } else {
                $blog->is_publish = config('settings.blog_status.publish');
            }

            $blog->user_id = Auth::user()->id;
            $blog->save();
        }

        $this->storeToBlogsCategory($blog->id, isset($request['categories']) ? $request['categories'] : null);
        $this->storeToBlogsTag($blog->id, isset($request['tags']) ? $request['tags'] : null);

        $blog_category = $this->getBlogCategory($blog->id);
        $blog->category = $blog_category;

        $blog_tag = $this->getBlogTag($blog->id);
        $blog->tag = $blog_tag;

        return $blog;
    }

    /**
     ** Store all the given category to blogs_categories table and also add to category table if new category given
     * @param Int $blog_id
     * @param array|null $categories
     * @return void
     */
    public function storeToBlogsCategory($blog_id, $categories = null)
    {

        DB::table('tl_blogs_categories')
            ->where('blog_id', '=', $blog_id)
            ->select('tl_blogs_categories.id')
            ->delete();

        if (isset($categories)) {

            $updated_category = [];
            foreach ($categories as $category) {
                array_push($updated_category, (int)$category);
            }

            $data = [];
            foreach ($updated_category as $key => $category_id) {
                $category = [
                    'blog_id' => $blog_id,
                    'category_id' => (int)$category_id
                ];
                array_push($data, $category);
            }

            TlBlogsCategory::insert($data);
        } else {
            $category_id = TlBlogCategory::where('permalink','uncategorized')->first()->id;
            TlBlogsCategory::create([
                'blog_id' => $blog_id,
                'category_id' => (int)$category_id
            ]);
        }
    }

    /**
     ** Store all the given tag to blogs_tags table and also add to tag table if new a tag given
     * @param Int $blog_id
     * @param array|null $tags
     * @return void
     */
    public function storeToBlogsTag($blog_id, $tags = null)
    {

        DB::table('tl_blogs_tags')
            ->where('blog_id', '=', $blog_id)
            ->select('tl_blogs_tags.id')
            ->delete();

        if (isset($tags)) {

            $updated_tag = [];
            foreach ($tags as $tag) {
                array_push($updated_tag, (int)$tag);
            }

            $data = [];
            foreach ($updated_tag as $key => $tag_id) {
                $tag = [
                    'blog_id' => $blog_id,
                    'tag_id' => (int)$tag_id
                ];
                array_push($data, $tag);
            }

            TlBlogsTag::insert($data);
        }
    }

    /**
     ** delete a blog by permalink
     * @param TlBlog $permalink
     * @return mixed|array
     */
    public function deleteBlog($permalink)
    {
        $blog = $this->findBlog($permalink);
        $blog->delete();
    }

    /**
     ** bulk delete blog by ids
     * @param array $data of TlBlog id
     * @return void
     */
    public function bulkDeleteBlog($data)
    {
        TlBlog::whereIn('id', $data)->delete();
    }

    /**
     ** update Blog Featured Status by id
     * @param integer TlBlog $id
     * @return void
     */
    public function updateBlogFeaturedStatus($id)
    {
        $blog = TlBlog::findOrFail($id);

        if ($blog->is_featured == 1) {
            $blog->is_featured = null;
            $result = 'of';
        } else {
            $blog->is_featured = 1;
            $result = 'on';
        }
        $blog->update();
        return $result;
    }

    /**
     ** Category save from blog add or edit page
     * @param array $request
     * @return mixed
     */
    public function categorySaveLoad($request)
    {
        $category = new TlBlogCategory();
        $category->name = xss_clean($request['category']);
        $category->permalink = xss_clean($request['permalink']);
        $category->is_publish = 1;

        if ($request['parent'] != '') {
            $category->parent = $request['parent'];
        }
        $category->save();
        return $category->id;
    }

    /**
     ** Tag save from blog add or edit page
     * @param array $request
     * @return mixed
     */
    public function tagSaveLoad($request)
    {
        $tag = new TlBlogTag();
        $tag->name = xss_clean($request['tag']);
        $tag->permalink = xss_clean($request['permalink']);
        $tag->is_publish = 1;
        $tag->save();
        $id = $tag->id;
        return $id;
    }


    /**
     ** Find Comment
     * @param TLBlogComment $id
     * @return mixed|array
     */
    public function findComment($id)
    {
        return TlBlogComment::findorFail($id);
    }

    /**
     ** Create Blog Comment
     * @param array $request via Ajax
     * @return mixed|array
     */
    public function createBlogComment($request)
    {
        $blog = $this->findBlog($request['blog_permalink']);
        $user = User::findOrFail($request['user_id']);

        $comment = new TlBlogComment();
        $comment->blog_id = $blog->id;
        $comment->user_id = $request['user_id'];
        $comment->user_type = 'admin';
        $comment->user_ip_address = $_SERVER['REMOTE_ADDR'];
        $comment->user_name = xss_clean($user->name);
        $comment->user_email = $user->email;
        $comment->user_website = xss_clean(URL::to('/'));
        $comment->comment = xss_clean($request['comment']);
        $comment->comment_date = currentDateTime();
        $comment->parent = (!isset($request['parent']) || $request['parent'] == '') ? null : $request['parent'];
        $comment->save();

        $comment->user_agent = $this->userAgent();
        $comment->blog_name = $blog->name;
        $comment->blog_permalink = $blog->permalink;

        return $comment;
    }

    /**
     ** private Function for user browser agent
     * @return string
     */
    private function userAgent()
    {
        $agent = $_SERVER["HTTP_USER_AGENT"];

        if (preg_match('/MSIE (\d+\.\d+);/', $agent)) {
            return 'internet explorer';
        } else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent)) {
            return 'chrome';
        } else if (preg_match('/Edge\/\d+/', $agent)) {
            return 'edge';
        } else if (preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent)) {
            return 'firefox';
        } else if (preg_match('/OPR[\/\s](\d+\.\d+)/', $agent)) {
            return 'opera';
        } else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent)) {
            return 'safari';
        }
    }

    /**
     ** Update Blog Comment
     * @param array $request
     * @return void
     */
    public function updateComment($request)
    {
        $comment = $this->findComment($request['id']);

        $comment->user_name    = xss_clean($request['user_name']);
        $comment->user_email   = xss_clean($request['user_email']);
        $comment->user_website = xss_clean($request['user_website']);
        $comment->comment      = xss_clean($request['comment']);
        $comment->comment_date = $request['comment_date'];
        $comment->status       = config('settings.blog_comment_status.' . $request['status']);
        $comment->update();
    }


    /**
     ** Get Blog Comment
     * @param string $permalink
     * @return mixed|array
     */
    public function getBlogComment($permalink)
    {
        $blog = $this->findBlog($permalink);
        $comment_setting = commentFormSettings();

        if ($comment_setting['page_comments'] == 1) {
            $paginate = $comment_setting['comments_per_page'];
            $order = $comment_setting['comment_order'] == '1' ? 'DESC' : 'ASC';
        } else {
            $paginate = null;
            $order = 'DESC';
        }

        $blog_comments =  DB::table('tl_blog_comments')
            ->leftJoin('tl_users', 'tl_users.id', '=', 'tl_blog_comments.user_id')
            ->leftJoin('tl_blogs', 'tl_blogs.id', '=', 'tl_blog_comments.blog_id')
            ->where(
                [
                    ['tl_blog_comments.comment_date', '<', currentDateTime()],
                    ['tl_blog_comments.blog_id', '=', $blog->id],
                    ['tl_blog_comments.parent', '=', null],
                    ['tl_blog_comments.status', '=', config('settings.blog_comment_status.approve')],
                ]
            )
            ->select([
                'tl_blog_comments.id',
                'tl_blog_comments.user_id',
                'tl_blog_comments.user_name',
                'tl_blog_comments.comment',
                'tl_blog_comments.comment_date',
                'tl_users.image as user_image',
            ])
            ->orderBy('tl_blog_comments.comment_date', $order);

        if (isset($paginate)) {
            $blog_comments = $blog_comments->paginate($paginate);
        } else {
            $blog_comments = $blog_comments->get();
        }

        return $blog_comments;
    }

    /**
     ** Get all Blog Comment
     * @param array $match_case
     * @param integer $paginate
     * 
     * @return mixed|array
     */
    public function getAllBlogComment($match_case, $paginate, $search_key = '')
    {
        $comments = DB::table('tl_blog_comments')
            ->leftJoin('tl_blogs', 'tl_blogs.id', '=', 'tl_blog_comments.blog_id')
            ->where($match_case);

        $comments = $comments->where(function ($query) use ($search_key) {
            $query->where('tl_blog_comments.user_name', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blog_comments.user_email', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blog_comments.user_website', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blog_comments.comment', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blogs.name', 'like', '%' . $search_key . '%');
        });

        $comments = $comments->select([
            'tl_blog_comments.id',
            'tl_blog_comments.blog_id',
            'tl_blog_comments.user_id',
            'tl_blog_comments.user_type',
            'tl_blog_comments.user_ip_address',
            'tl_blog_comments.user_name',
            'tl_blog_comments.user_email',
            'tl_blog_comments.user_website',
            'tl_blog_comments.comment',
            'tl_blog_comments.parent',
            'tl_blog_comments.status',
            'tl_blog_comments.previous_status',
            'tl_blog_comments.comment_date',
            'tl_blogs.permalink as blog_permalink',
        ])
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        array_map(function ($item) {
            $item->blog = $this->findBlog($item->blog_permalink);
        }, $comments->items());

        return  $comments;
    }

    /**
     ** Change Blog Status
     * @param array $request via Ajax
     * @return void
     */
    public function changeStatus($request)
    {
        $comment = TlBlogComment::where('id', $request['id'])->first();

        switch ($request['status']) {
            case 'unapprove':
                $comment->status = config('settings.blog_comment_status.pending');
                break;

            case 'approve':
                $comment->status = config('settings.blog_comment_status.approve');
                break;

            case 'spam':
                $comment->previous_status = $comment->status;
                $comment->status = config('settings.blog_comment_status.spam');
                break;

            case 'trash':
                $comment->previous_status = $comment->status;
                $comment->status = config('settings.blog_comment_status.trash');
                break;

            case 'not_spam':
                $comment->status = $comment->previous_status;
                $comment->previous_status = null;
                break;

            case 'restore':
                $comment->status = $comment->previous_status;
                $comment->previous_status = null;
                break;

            default:
                return false;
                break;
        }
        $comment->update();
        return true;
    }

    /**
     ** Change Blog Status
     * @param array $request via Ajax
     * @return  void
     */
    public function commentDelete($request)
    {
        $comment = $this->findComment($request['id']);
        $comment->delete();
    }

    /**
     ** Bulk Comment Action
     * @param array $request via Ajax
     * @return boolean
     */
    public function bulkCommentAction($request)
    {
        switch ($request['action']) {
            case 'delete_all':
                TlBlogComment::whereIn('id', $request['data'])->delete();
                return true;
                break;

            case 'unapprove':
                TlBlogComment::whereIn('id',  $request['data'])->update(['status' => config('settings.blog_comment_status.unapprove')]);
                return true;
                break;

            case 'approve':
                TlBlogComment::whereIn('id', $request['data'])->update(['status' => config('settings.blog_comment_status.approve')]);
                return true;
                break;

            case 'spam':
                TlBlogComment::whereIn('id', $request['data'])->update(['previous_status' =>  DB::raw('status')]);
                TlBlogComment::whereIn('id', $request['data'])->update(['status' =>  config('settings.blog_comment_status.spam')]);
                return true;
                break;

            case 'trash':
                TlBlogComment::whereIn('id', $request['data'])->update(['previous_status' =>  DB::raw('status')]);
                TlBlogComment::whereIn('id', $request['data'])->update(['status' =>  config('settings.blog_comment_status.trash')]);
                return true;
                break;
            case 'not_spam':
                TlBlogComment::whereIn('id', $request['data'])->update(['status' =>  DB::raw('previous_status')]);
                TlBlogComment::whereIn('id', $request['data'])->update(['previous_status' =>  null]);
                return true;
                break;
            case 'restore':
                TlBlogComment::whereIn('id', $request['data'])->update(['status' =>  DB::raw('previous_status')]);
                TlBlogComment::whereIn('id', $request['data'])->update(['previous_status' =>  null]);
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Update Comment Setting
     * @param array $request via Ajax
     * @return  void
     */
    public function updateCommentSetting($request)
    {
        $updated_array = [];
        $comment_general_settings = config('settings.blog_comment_general_settings_name');
        $comment_other_settings = config('settings.blog_comment_other_settings_name');

        // general settings updated array
        foreach ($comment_general_settings as $key => $value) {
            if (array_key_exists($value, $request)) {
                $updated_array[$value] = 1;
            } else {
                $updated_array[$value] = 0;
            }
        }

        // other settings updated array
        foreach ($comment_other_settings as $key => $value) {
            if ($value == 'close_comments_days_old') {
                if ($request['close_comments_days_old'] == null) {
                    $updated_array[$value] = 1;
                } else {
                    $updated_array[$value] = $request[$value];
                }
            } elseif ($value == 'comments_per_page') {
                if ($request['comments_per_page'] == null) {
                    $updated_array[$value] = 8;
                } else {
                    $updated_array[$value] = $request[$value];
                }
            } elseif ($value == 'avatar_default') {
                if (isset($request['avatar_default'])) {
                    $updated_array[$value] = $request[$value];
                } else {
                    $updated_array[$value] = 'mystery';
                }
            } else {
                $updated_array[$value] = $request[$value];
            }
        }

        // setting merge
        $comment_general_settings_id = getGeneralSettingIdAsArray('blog_comment_general_settings_name');
        $comment_other_settings_id = getGeneralSettingIdAsArray('blog_comment_other_settings_name');
        $all_comment_settings_name = array_merge($comment_general_settings, $comment_other_settings);
        $all_comment_settings_id = array_merge($comment_general_settings_id, $comment_other_settings_id);
        // make setting name and id key = value array
        $all_settings = array_combine($all_comment_settings_name, $all_comment_settings_id);

        $data = [];
        $settings_id = [];

        foreach ($updated_array as $key => $value) {
            array_push($data, [
                'settings_id' =>  $all_settings[$key],
                'value' => xss_clean($value)
            ]);
            array_push($settings_id, $all_settings[$key]);
        }
        DB::table('tl_general_settings_has_values')->whereIn('settings_id', $settings_id)->delete();
        DB::table('tl_general_settings_has_values')->insert($data);
    }

    /**
     ** Comment Filter before Approve
     * @param array $comment
     * @return array
     */
    public function commentFiltration($comment)
    {
        $comment_setting = commentFormSettings();

        // filter for disallowed keys
        if ($comment_setting['comment_disallowed_keys'] != null) {
            if ($this->dissAllowedKeys($comment, $comment_setting['comment_disallowed_keys'])) {
                return ['error' => translate('Your Comment is not Approved')];
            }
        }

        // filter for links in comment
        if ($this->commentMaxLink($comment, $comment_setting['comment_max_links'])) {
            return ['warning' => translate('Your Comment is in Moderation')];
        }

        // filter for comment moderation
        if ($comment_setting['comment_moderation_keys'] != null) {
            if ($this->commentModeration($comment, $comment_setting['comment_moderation_keys'])) {
                return ['warning' => translate('Your Comment is in Moderation')];
            }
        }

        // checking if comment manual is on and previously approve or not
        if ($comment_setting['comment_moderation'] == '1') {
            if ($comment_setting['comment_previously_approved'] == '1') {
                if (!$this->commentPreviouslyApprove($comment)) {
                    return ['pending' => translate('Please wait for your Comment Approval')];
                }
            } else {
                return ['pending' => translate('Please wait for your Comment Approval')];
            }
        }

        $updated_comment = $this->findComment($comment['id']);
        $updated_comment->status = config('settings.blog_comment_status.approve');
        $updated_comment->update();

        $updated_comment->blog_name = $comment['blog_name'];
        $updated_comment->blog_permalink = $comment['blog_permalink'];

        if ($comment_setting['comments_notify_email'] == 1) {
            $this->sendMail($updated_comment);
        }

        return ['success' => translate('Your Comment Added')];
    }

    /**
     ** Checking if any disallowed keys is available or not
     * @param array $comment
     * @param string $comment_setting
     * @return boolean
     */
    private function dissAllowedKeys($comment, $comment_setting_disallowed_keys)
    {
        $comment_setting = commentFormSettings();

        $comment_disallowed_keys = explode(',', strtolower($comment_setting_disallowed_keys));

        $main_comment = strtolower($comment['comment']);

        $matched_keys = [];

        foreach ($comment_disallowed_keys as $key => $value) {

            if ($this->CommentFilter($value, $main_comment)) {
                array_push($matched_keys, $this->CommentFilter($value, $main_comment));
            }

            if ($this->CommentFilter($value, $comment['user_name'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_name']));
            }

            if ($this->CommentFilter($value, $comment['user_email'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_email']));
            }

            if ($this->CommentFilter($value, $comment['user_ip_address'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_ip_address']));
            }

            if ($this->CommentFilter($value, $comment['user_agent'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_agent']));
            }

            if ($this->CommentFilter($value, $comment['user_website'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_website']));
            }
        }

        if (count($matched_keys) > 0) {
            $updated_comment = $this->findComment($comment['id']);
            $updated_comment->status = config('settings.blog_comment_status.trash');
            $updated_comment->update();

            $updated_comment->blog_name = $comment['blog_name'];
            $updated_comment->blog_permalink = $comment['blog_permalink'];

            if ($comment_setting['comments_notify_email'] == 1) {
                $this->sendMail($updated_comment);
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     ** Checking if comment has more links than the max links limit
     * @param array $comment
     * @param string $comment_setting
     * @return boolean
     */
    private function commentMaxLink($comment, $max_links)
    {
        $comment_setting = commentFormSettings();

        $main_comment = strtolower($comment['comment']);
        if ($max_links == 0 || $max_links == null) {
            return false;
        } else {
            $pattern = '~[a-z]+://\S+~';
            $link_count = preg_match_all($pattern, $main_comment);

            if ($link_count >=  $max_links) {
                $updated_comment = $this->findComment($comment['id']);
                $updated_comment->status = config('settings.blog_comment_status.pending');
                $updated_comment->update();

                $updated_comment->blog_name = $comment['blog_name'];
                $updated_comment->blog_permalink = $comment['blog_permalink'];
                if ($comment_setting['comments_notify_email'] == 1 || $comment_setting['comments_moderation_notify_email'] == 1) {
                    $this->sendMail($updated_comment);
                }
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     ** Checking if any moderation keys is available or not
     * @param array $comment
     * @param string $comment_setting
     * @return boolean
     */
    private function commentModeration($comment, $comment_setting_moderation_keys)
    {
        $comment_setting = commentFormSettings();

        $comment_moderation_keys = explode(',', strtolower($comment_setting_moderation_keys));

        $main_comment = strtolower($comment['comment']);

        $matched_keys = [];

        foreach ($comment_moderation_keys as $key => $value) {

            if ($this->CommentFilter($value, $main_comment)) {
                array_push($matched_keys, $this->CommentFilter($value, $main_comment));
            }

            if ($this->CommentFilter($value, $comment['user_name'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_name']));
            }

            if ($this->CommentFilter($value, $comment['user_email'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_email']));
            }

            if ($this->CommentFilter($value, $comment['user_ip_address'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_ip_address']));
            }

            if ($this->CommentFilter($value, $comment['user_agent'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_agent']));
            }

            if ($this->CommentFilter($value, $comment['user_website'])) {
                array_push($matched_keys, $this->CommentFilter($value, $comment['user_website']));
            }
        }

        if (count($matched_keys) > 0) {
            $updated_comment = $this->findComment($comment['id']);
            $updated_comment->status = config('settings.blog_comment_status.pending');
            $updated_comment->update();

            $updated_comment->blog_name = $comment['blog_name'];
            $updated_comment->blog_permalink = $comment['blog_permalink'];
            if ($comment_setting['comments_notify_email'] == 1 || $comment_setting['comments_moderation_notify_email'] == 1) {
                $this->sendMail($updated_comment);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     ** Checking if the authors comment was previously approve or not
     * @param array $comment
     * @param string $previously_approve
     * @return boolean
     */
    private function commentPreviouslyApprove($comment)
    {
        $comment_by_email = TlBlogComment::where('user_email', $comment['user_email'])->where('status', config('settings.blog_comment_status.approve'))->exists();
        $comment_by_ip = TlBlogComment::where('user_ip_address', $comment['user_ip_address'])->where('status', config('settings.blog_comment_status.approve'))->exists();

        if ($comment_by_email || $comment_by_ip) {
            return true;
        } else {
            return false;
        }
    }

    /**
     ** Checking if comment should be manually approve or not based on previously approve!
     * @param string $value setting disallowed keys & moderation keys
     * @param string $information the string that the $value will be match
     * @return string|boolean if match? then return the matched key or return false
     */
    private function CommentFilter($value, $information)
    {
        $keys = preg_match("/{$value}/i", $information);

        if ($keys) {
            return $keys;
        } else {
            return false;
        }
    }

    /**
     ** Sending Mail if Comment notify is on
     * @return response
     */
    public function sendMail($comment)
    {
        $comment_setting = commentFormSettings();
        $emails = $this->hasBlogPermission()->toArray();
        array_push($emails, User::role('Super Admin')->first()->email);

        $comment_status = translate('A New Comment Added.');
        $comment_url = route('core.blog.comment.edit', $comment->id);
        if ($comment_setting['comments_moderation_notify_email'] == 1) {
            if ($comment->status == config('settings.blog_comment_status.pending')) {
                $comment_status = translate('A New Comment is Held For Moderation.');
            }
        }

        $data = [
            '_blog_link_' =>  URL::to('/') . "/blog/" . $comment->blog_permalink,
            '_blog_name_' => $comment->blog_name,
            '_comment_status_' => $comment_status,
            '_author_name_' => $comment->user_name,
            '_main_comment_' => $comment->comment,
            '_comment_link_' => $comment_url,
        ];

        $keywords = getEmailTemplateVariables(config('settings.email_template.blog_comment_email_template'), true);

        $template = DB::table('tl_email_template_properties')
            ->where('email_type', config('settings.email_template.blog_comment_email_template'))
            ->select([
                'subject'
            ])->first();

        foreach ($emails as $email) {
            Notification::route('mail', $email)
                ->notify(new CommentMailNotification($data, $keywords, $template->subject));
        }
    }

    /**
     ** Get the Email of the user who has blog permission
     * @return response
     */
    public function hasBlogPermission()
    {
        $email = User::whereHas('roles', function ($query) {
            $query->whereHas('permissions', function ($query) {
                $query->where('name', 'Manage Comment');
            });
        })->pluck('email');
        return $email;
    }
}
