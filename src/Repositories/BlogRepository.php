<?php

namespace Theme\Default\Repositories;

use Core\Models\User;
use Core\Models\TlBlog;
use Core\Models\TlBlogTag;
use Core\Models\TlBlogComment;
use Core\Models\TlBlogCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Core\Notifications\CommentMailNotification;

class BlogRepository
{


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
     * Get Blog List by different conditions.
     *
     * @return mixed|integer|boolean
     */
    public function getBlogs($data = ['*'], $match_case = [], $limit = null, $paginate_page = null, $search = '', $sticky = false, $most_viewed = false, $locale = 'en')
    {
        try {
            $blogs = TlBlog::join('tl_users', 'tl_users.id', '=', 'tl_blogs.user_id')
                ->leftJoin('tl_blogs_categories', 'tl_blogs_categories.blog_id', '=', 'tl_blogs.id')
                ->leftJoin('tl_blog_categories', 'tl_blog_categories.id', '=', 'tl_blogs_categories.category_id')
                ->leftJoin('tl_blogs_tags', 'tl_blogs_tags.blog_id', '=', 'tl_blogs.id')
                ->leftJoin('tl_blog_tags', 'tl_blog_tags.id', '=', 'tl_blogs_tags.tag_id')
                ->with([
                    'blog_translations' => function ($query) use ($locale) {
                        $query->where('lang', $locale)
                            ->select(['id', 'blog_id', 'name', 'short_description', 'content']);
                    }
                ])
                ->with(['categories' => function ($query) use ($locale) {
                    $query->where('is_publish', 1)
                        ->select([
                            'tl_blog_categories.id',
                            'tl_blog_categories.name',
                            'tl_blog_categories.permalink'
                        ])
                        ->with(['category_translations' => function ($query) use ($locale) {
                            $query->where('lang', $locale)
                                ->select(['id', 'name', 'category_id']);
                        }]);
                }]);

            if ($most_viewed) {
                $blogs = $blogs->orderBy('tl_blogs.views', 'desc');
            }
            if ($sticky) {
                $blogs = $blogs->orderBy('tl_blogs.is_sticky', 'desc');
            }
            $blogs = $blogs->orderBy('tl_blogs.created_at', 'desc')
                ->groupBy('tl_blogs.id')
                ->where($match_case);

            if (Session::has('blog-filter-date')) {
                $blogs = $blogs->whereDate('tl_blogs.created_at', Session::get('blog-filter-date'));
            }

            $blogs = $blogs->where(function ($query) use ($search) {
                $query->where('tl_blogs.name', 'like', '%' . $search . '%')
                    ->orWhere('tl_blogs.visibility', 'like', '%' . $search . '%')
                    ->orWhere('tl_blog_categories.name', 'like', '%' . $search . '%')
                    ->orWhere('tl_blog_tags.name', 'like', '%' . $search . '%')
                    ->orWhere('tl_blogs.content', 'like', '%' . $search . '%')
                    ->orWhere('tl_users.name', 'like', '%' . $search . '%');
            });

            $blogs = $blogs->select($data)->withCount('allblogComment');

            if (isset($paginate_page)) {
                $blogs = $blogs->paginate($paginate_page);
                $blogs->getCollection()->transform(function ($blog) use ($locale) {
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
            } else {
                if (isset($limit)) {
                    $blogs = $blogs->limit($limit)->get();
                    $blogs->map(function ($blog) {
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
                }
            }
            return $blogs;
        } catch (\Exception $e) {
            abort(404);
        }
    }


    /**
     ** Get all the category for a blog
     * @param TlBlog $id
     * @return mixed|array
     */
    public function getBlogCategory($ids, $locale)
    {
        $ids = explode(',', $ids);
        $categories = TlBlogCategory::with([
            'category_translations' => function ($query) use ($locale) {
                $query->where('lang', $locale)
                    ->select(['id', 'category_id', 'name']);
            }
        ])
            ->whereIn('id', $ids)
            ->where('is_publish', '1')
            ->orderBy('id', 'desc')
            ->select(['id', 'name', 'permalink'])
            ->get()
            ->map(function ($category) {
                if (count($category->category_translations)) {
                    $category->name = $category->category_translations->first()->name;
                }
                return $category;
            });

        return $categories;
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
    public function findBlog($permalink, $data = '*')
    {
        return TlBlog::where('permalink', $permalink)->select($data)->first();
    }

    /**
     ** get a blog by id
     * @param TlBlog $id
     * @return mixed|array
     */
    public function findBlogByID($id)
    {
        return TlBlog::where('id', $id)->first();
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

        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            $user_id = $user->id;
            $user_name = $user->name;
            $user_email = $user->email;
            $user_type = 'admin';
            $user_website = URL::to('/');
        } else {
            $user_id = null;
            $user_name = $request['user_name'] != null ? $request['user_name'] : 'Anonymous';
            $user_email = $request['user_email'];
            $user_website = $request['user_website'];
            $user_type = 'anonymous';
        }


        $comment = new TlBlogComment();
        $comment->blog_id = $blog->id;
        $comment->user_id = $user_id;
        $comment->user_type = $user_type;
        $comment->user_ip_address = $_SERVER['REMOTE_ADDR'];
        $comment->user_name = xss_clean($user_name);
        $comment->user_email = xss_clean($user_email);
        $comment->user_website = xss_clean($user_website);
        $comment->comment = xss_clean($request['comment']);
        $comment->comment_date = currentDateTime();
        $comment->parent = $request['parent'] == '' ? null : $request['parent'];
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
     ** Get Blog Comment
     * @param string $permalink
     * @return mixed|array
     */
    public function getBlogComment($blog_id)
    {
        $comment_setting = commentFormSettings();

        if ($comment_setting['page_comments'] == 1) {
            $paginate = $comment_setting['comments_per_page'];
            $order = $comment_setting['comment_order'] == '1' ? 'DESC' : 'ASC';
        } else {
            $paginate = null;
            $order = 'DESC';
        }

        $blog_comments =  TlBlogComment::leftJoin('tl_users', 'tl_users.id', '=', 'tl_blog_comments.user_id')
            ->leftJoin('tl_blogs', 'tl_blogs.id', '=', 'tl_blog_comments.blog_id')
            ->where(
                [
                    ['tl_blog_comments.comment_date', '<', currentDateTime()],
                    ['tl_blog_comments.blog_id', '=', $blog_id],
                    ['tl_blog_comments.parent', '=', null],
                    ['tl_blog_comments.status', '=', config('settings.blog_comment_status.approve')],
                ]
            )
            ->select([
                'tl_blog_comments.id',
                'tl_blog_comments.user_name',
                'tl_blog_comments.comment',
                'tl_blog_comments.comment_date',
                'tl_blog_comments.user_type',
                'tl_users.name as admin_user_name',
                'tl_users.image as admin_user_image',
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
            '_blog_link_' => route('theme.default.blog_details', $comment->blog_permalink),
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
     * @return object
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
