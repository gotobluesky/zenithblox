<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Core\Models\TlBlog;
use Illuminate\Support\Facades\DB;
use Core\Models\TlBlogTag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Core\Models\TlBlogCategory;
use Core\Repositories\LanguageRepository;
use Illuminate\Support\Facades\Validator;
use Core\Http\Requests\BlogRequest;
use Core\Models\BlogShareOption;
use Core\Repositories\BlogRepository;

class BlogController extends Controller
{

  protected $language_repository;
  protected $blog_repository;


  public function __construct(LanguageRepository $language_repository, BlogRepository $blog_repository)
  {
    $this->language_repository = $language_repository;
    $this->blog_repository = $blog_repository;
  }

  /**
   ** Show all the blogs from database and get all the categories under the blogs
   * @return mixed
   */
  public function blog(Request $request)
  {
    try {
      $data = [
        DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.name) as name'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.permalink) as permalink'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.image) as image'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.visibility) as visibility'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.publish_at) as publish_at'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.is_featured) as is_featured'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.is_publish) as is_publish'),
        DB::raw('GROUP_CONCAT(distinct tl_blogs.updated_at) as updated_at'),
        DB::raw('GROUP_CONCAT(distinct tl_users.name) as user_name'),
        DB::raw('GROUP_CONCAT(distinct tl_blog_categories.id) as category'),
      ];

      $match_case = [];
      $pagination = 10;
      $search = '';

      if ($request->per_page) {
        $pagination = (int)$request->per_page;
      }

      if ($request->status) {

        switch ($request->status) {
          case 'mine':
            array_push($match_case, ['tl_blogs.user_id', '=', Auth::user()->id]);
            break;
          case 'publish':
            array_push($match_case, ['tl_blogs.is_publish', '=', config('settings.blog_status.publish')]);
            array_push($match_case, ['tl_blogs.publish_at', '<', currentDateTime()]);
            break;
          case 'schedule':
            array_push($match_case, ['tl_blogs.publish_at', '>', currentDateTime()]);
            break;
          case 'draft':
            array_push($match_case, ['tl_blogs.is_publish', '=', config('settings.blog_status.draft')]);
            break;
          case 'pending':
            array_push($match_case, ['tl_blogs.is_publish', '=',  config('settings.blog_status.pending')]);
            break;
          case 'featured':
            array_push($match_case, ['tl_blogs.is_featured', '=',  1]);
            break;
          case 'search_text':
            $match_case;
            break;
          default:
            toastNotification('error', translate('Blog Comment Not Found'));
            return redirect()->back();
            break;
        }

        if ($request->search) {
          $search = $request->search;
        }
      }

      $blogs = $this->blog_repository->getBlogs($data, $match_case, null, $pagination, $search);

      return view('core::base.blog.blog', compact('blogs'));
    } catch (\Exception $e) {

      toastNotification('error', translate('Blogs Not Found'));
      return redirect()->back();
    }
  }

  /**
   ** Add Blog
   * @return mixed
   */
  public function addBlog()
  {
    try {
      $categories = $this->blog_repository->getParentCategories([['is_publish', '1']]);
      $tags = $this->blog_repository->getAllTags();

      return view('core::base.blog.add_blog', compact('categories', 'tags'));
    } catch (\Exception $e) {

      toastNotification('error', translate('Something Went Wrong'));
      return redirect()->route('core.blog');
    }
  }

  /**
   ** Store a new blog as Publish to DB
   * @param \Core\Http\Requests\BlogRequest $request
   * @return \Illuminate\Http\Response
   */

  public function storeBlog(BlogRequest $request)
  {
    try {
      DB::beginTransaction();
      $blog = $this->blog_repository->blogCreateUpdate($request, isset($request->id) ? $request->id : null);
      DB::commit();

      toastNotification('success', translate('New Blog Saved'));
      return redirect()->route('core.edit.blog', ['id' => $blog->id, 'lang' => getDefaultLang()]);
    } catch (\Exception $e) {
      DB::rollBack();
      toastNotification('error', translate('New Blog Saving Failed'));
      return redirect()->route('core.add.blog');
    }
  }

  /**
   ** Edit Blog
   * @param \App\Models\Blog $id
   * @return \Illuminate\Http\Response
   */
  public function editBlog(Request $request, $id)
  {
    try {
      if (isset($request->id) && is_numeric($request->id) && $request->lang) {

        $languages = $this->language_repository->allLanguages();
        $lang =  $request->lang;

        $blog = $this->blog_repository->findBlogByID($id);
        $blog->content = fix_image_urls($blog->content);
        $blog->blog_password = isset($blog->blog_password) ? Crypt::decrypt($blog->blog_password) : null;
        $categories = $this->blog_repository->getParentCategories();
        $tags = $this->blog_repository->getAllTags();

        return view('core::base.blog.edit_blog', compact('blog', 'categories', 'tags', 'languages', 'lang'));
      } else {
        toastNotification('error', translate('Blog not found'));
        return redirect()->route('core.blog');
      }
    } catch (\Exception $e) {
      toastNotification('error', translate('Blog not found'));
      return redirect()->route('core.blog');
    }
  }

  /**
   ** Update Blog
   * @param \App\Http\Requests\BlogRequest $request
   * @return \Illuminate\Http\Response
   */
  public function updateBlog(BlogRequest $request)
  {
    try {
      if (isset($request->id) && is_numeric($request->id)  && $request->lang) {

        $this->blog_repository->blogUpdate($request);
        toastNotification('success', translate('Blog Updated Successfully'));

        return redirect()->route('core.edit.blog', ['id' =>  $request->id, 'lang' => $request->lang]);
      } else {
        toastNotification('error', translate('Blog Update Failed'));
        return redirect()->route('core.edit.blog', ['id' =>  $request->id, 'lang' => $request->lang]);
      }
    } catch (\Exception $e) {
      toastNotification('error', translate('Blog Update Failed'));
      return redirect()->back();
    }
  }

  /**
   ** Delete Blog
   * @param \App\Models\Blog $id
   * @return \Illuminate\Http\Response
   */
  public function deleteBlog(Request $request)
  {
    try {
      if (isset($request->permalink)) {

        DB::beginTransaction();
        $this->blog_repository->deleteBlog($request->permalink);
        DB::commit();

        toastNotification('success', translate('Blog Deleted Successfully'));
      } else {
        toastNotification('error', translate('Blog Deleting Failed'));
      }
    } catch (\Exception $e) {
      DB::rollBack();
      toastNotification('error', translate('Blog Deleting Failed'));
    } catch (\Error $e) {
      toastNotification('error', translate('Error in Code'));
    }

    return redirect()->route('core.blog');
  }

  /**
   ** Blog Draft Preview
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function blogDraftPreview(Request $request)
  {
    try {
      if (!isset($request->name)) {
        return response()->json(['error' => translate('Name Field is Required')]);
      }
      if (strlen($request->name) > 225) {
        return response()->json(['error' => translate('Please Write The Blog Name under 225 words')]);
      }

      if (!$request->id && (TlBlog::where('permalink', $request->permalink)->exists() || TlBlog::where('name', $request->name)->exists())) {
        return response()->json(['error' => translate('This Blog Name or Permalink is Already Available Please Insert Different Name or Permalink')]);
      }

      DB::beginTransaction();
      $blog = $this->blog_repository->blogCreateUpdate($request, isset($request->id) ? $request->id : null, $request->action);
      DB::commit();

      switch ($request->action) {
        case 'draft':
          return response()->json(['success' => translate('Blog Draft Saved'), 'id' => $blog->id]);
          break;

        case 'preview':
          return response()->json(['id' => $blog->id, 'permalink' => $blog->permalink]);
          break;

        case 'pending':
          return response()->json(['success' => translate('Blog Saved as Pending'), 'id' => $blog->id]);
          break;
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('Blog Saved Failed') . $e->getMessage()]);
    }
  }

  /**
   ** blog preview page
   * @param \Illuminate\Http\Request $request via ajax
   * @return View
   */
  public function blogPreview(Request $request)
  {
    try {
      $blog = $this->blog_repository->findBlog($request->name);
      $blog_category = $this->blog_repository->getBlogCategory($blog->id);
      $blog->category = $blog_category;
      $blog_tag = $this->blog_repository->getBlogTag($blog->id);
      $blog->tag = $blog_tag;
      return view('theme/default::backend.blog_preview', compact('blog'));
    } catch (\Exception $e) {
      abort(404);
    }
  }

  /**
   * Bulk Delete Blog
   * @param \Illuminate\Http\Request $request (Via Ajax)
   * @return \Illuminate\Http\Response (Via Ajax)
   */
  public function bulkDeleteBlog(Request $request)
  {
    try {
      if ($request->has('data')) {
        DB::beginTransaction();
        $this->blog_repository->bulkDeleteBlog($request->data);
        DB::commit();
        toastNotification('success', translate('Blogs Bulk Delete Successful'));
      } else {

        toastNotification('error', translate('Blogs Bulk Deleting Failed'));
      }
    } catch (\Exception $e) {
      DB::rollBack();
      toastNotification('error', translate('Blogs Bulk Deleting Failed'));
    }
  }

  /**
   * Update featured status
   *
   * @param \Illuminate\Http\Request $request (Via Ajax)
   * @return \Illuminate\Http\Response (Via Ajax)
   */
  public function updateBlogFeaturedStatus(Request $request)
  {
    try {

      if ($request->id && is_numeric($request->id)) {

        DB::beginTransaction();
        $result = $this->blog_repository->updateBlogFeaturedStatus($request->id);
        DB::commit();

        return response()->json(['success' => translate('Blog Featured Status Changed Successfully'), 'result' => $result]);
      } else {
        return response()->json(['error' => translate('Blog Featured Status Changing Failed')]);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('Blog Featured Status Changing Failed')]);
    }
  }

  /**
   ** Blog Content (Summernote) Image Upload and validate to send a response
   * @param \Illuminate\Http\Request $request
   * @return mixed
   */
  public function blogContentImage(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'image' => 'required|image|mimes:jpg,png,svg,jpeg,bmp|max:1020',
    ]);

    if ($validator->passes()) {

      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $image = 'blog_content_image' . time() . rand() . '.' . $extension;
        $file->move('public/uploaded/blog/content/', $image);
        $path = asset('/public/uploaded/blog/content/' . $image);
        return response()->json(['url' => $path]);
      }
    }
    return response()->json(['error' => $validator->errors()->all()]);
  }

  /**
   ** Ajax Category Load
   * @param Request via Ajax
   * @return mixed|array
   */
  public function categoryLoad(Request $request)
  {
    try {
      if ($request->category) {
        if (TlBlogCategory::where('permalink', $request->permalink)->exists() || TlBlogCategory::where('name', $request->category)->exists()) {
          return response()->json(['error' => translate('This Category Name or Slug is Already Available Please Insert Another')]);
        }

        DB::beginTransaction();
        $id = $this->blog_repository->categorySaveLoad($request);
        DB::commit();
      } else {
        $id = null;
      }

      if ($request->id) {
        $blog_category = $this->blog_repository->getBlogCategory($request->id);
      } else {
        $blog_category = null;
      }

      $categories = $this->blog_repository->getParentCategories();
      $view = view('core::base.blog.includes.category-select', compact('categories', 'blog_category'))->render();
      return response()->json(['view' => $view, 'id' => $id, 'blog_category' => $blog_category]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('New Category Creating Failed')]);
    }
  }

  /**
   ** Ajax Tag Load
   * @param Request via Ajax
   * @return mixed|array
   */
  public function TagLoad(Request $request)
  {
    try {
      if ($request->tag) {

        if (TlBlogTag::where('permalink', $request->permalink)->exists() || TlBlogTag::where('name', $request->tag)->exists()) {
          return response()->json(['error' => translate('This Tag Name or Slug is Already Available Please Insert Another')]);
        }

        DB::beginTransaction();
        $id = $this->blog_repository->tagSaveLoad($request);
        DB::commit();
      } else {
        $id = null;
      }

      if ($request->id) {
        $blog_tag = $this->blog_repository->getBlogTag($request->id);
      } else {
        $blog_tag = null;
      }

      $tags = $this->blog_repository->getAllTags();
      $view = view('core::base.blog.includes.tag-select', compact('tags', 'blog_tag'))->render();

      return response()->json(['view' => $view, 'id' => $id]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('New Tag Creating Failed')]);
    }
  }


  /**
   * Will return blog share options
   * 
   * @return mixed
   */
  public function shareOptions()
  {
    $share_options = BlogShareOption::all();
    return view('core::base.blog.settings.share_options')->with(
      [
        'share_options' => $share_options,
      ]
    );
  }

  /**
   * Update status of blog share option
   * 
   * @param \Illuminate\Http\Request $request
   * @return void
   */
  public function shareOptionUpdateStatus(Request $request)
  {
    try {
      DB::beginTransaction();
      $option = BlogShareOption::find($request['id']);
      $option->status = $option->status == config('settings.general_status.active') ? config('settings.general_status.in_active') : config('settings.general_status.active');
      $option->save();
      DB::commit();
      toastNotification('success', translate('Status updated successfully'));
    } catch (\Exception $e) {
      DB::rollBack();
      toastNotification('error', translate('Status update failed'));
    }
  }
}
