<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Core\Repositories\LanguageRepository;
use Core\Repositories\BlogRepository;
use Core\Http\Requests\BlogCategoryRequest;

class BlogCategoryController extends Controller
{

    protected $language_repository;
    protected $blogCategory_repository;

    public function __construct(LanguageRepository $language_repository, BlogRepository $blogCategory_repository)
    {
        $this->language_repository = $language_repository;
        $this->blogCategory_repository = $blogCategory_repository;
    }


    /**
     * Show all the Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function blogCategory(Request $request)
    {
        try {
            $pagination = 10;
            $search = '';
            $match_case = [];
            if ($request->per_page) {
                $pagination = (int)$request->per_page;
            }
            if ($request->status) {
                switch ($request->status) {
                    case 'featured':
                        array_push($match_case, ['is_featured', '1']);
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

            $bcategories = $this->blogCategory_repository->getAllBlogCategories($match_case, $pagination, $search);
            return view('core::base.blog.category.blog_category', compact('bcategories'));
        } catch (\Exception $e) {
            toastNotification('error', translate('Blog Categories Page unavailable'));
            return redirect()->back();
        }
    }

    /**
     * Show the add blog Category Page for adding  a new category
     *
     * @return \Illuminate\Http\Response
     */
    public function addBlogCategory()
    {
        try {
            $categories = $this->blogCategory_repository->getParentCategories();
            return view('core::base.blog.category.add_blog_category', compact('categories'));
        } catch (\Exception $e) {
            toastNotification('error', translate('Category Add Page unavailable'));
            return redirect()->back();
        }
    }

    /**
     * Store a new Category to Database
     *
     * @param \Core\Http\Requests\BlogCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeBlogCategory(BlogCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->blogCategory_repository->addNewCategory($request);
            DB::commit();
            toastNotification('success', translate('New Blog Category Created Successfully!'));
            return redirect()->route('core.edit.blog.category', ['id' =>  $category->id, 'lang' => getDefaultLang()]);
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('New Category Creating Failed'));
            return redirect()->route('core.add.blog.category');
        }
    }

    /**
     * Show the edit category page for updating a category
     * Find if the given $id is there and is a numeric value 
     * If the category found by the $id then redirect with success or redirect with error
     *
     * @param \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editBlogCategory(Request $request, $id)
    {
        try {
            if ($request->id && is_numeric($request->id) && $request->lang) {

                $languages = $this->language_repository->allLanguages();
                $lang =  $request->lang;
                $bcategory = $this->blogCategory_repository->findCategory($request->id);
                $categories = $this->blogCategory_repository->getParentCategories();

                return view('core::base.blog.category.edit_blog_category', compact('categories', 'bcategory', 'languages', 'lang'));
            } else {
                toastNotification('error', translate('Category not found'));
                return redirect()->route('core.blog.category');
            }
        } catch (\Exception $e) {
            toastNotification('error', translate('Something Went Wrong'));
            return redirect()->route('core.blog.category');
        }
    }

    /**
     * Update a category from the database
     *
     * @param \Core\Http\Requests\BlogCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateBlogCategory(BlogCategoryRequest $request)
    {
        try {
            if ($request->id && is_numeric($request->id)  && $request->lang) {
                DB::beginTransaction();
                $this->blogCategory_repository->updateCategory($request);
                DB::commit();
                toastNotification('success', translate('Blog Category Updated Successfully'));
                return redirect()->route('core.edit.blog.category', ['id' =>  $request->id, 'lang' => $request->lang]);
            } else {
                toastNotification('error', translate('Blog Category Update Failed'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Blog Category Update Failed'));
            return redirect()->back();
        }
    }


    /**
     * Delete a category from the database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteBlogCategory(Request $request)
    {
        try {
            if ($request->id && is_numeric($request->id)) {
                DB::beginTransaction();
                $deleteCategoryRespose = $this->blogCategory_repository->deleteCategory($request->id);
                DB::commit();

                toastNotification($deleteCategoryRespose['status'], $deleteCategoryRespose['message']);
                return redirect()->route('core.blog.category');
            } else {
                toastNotification('error', translate('Blog Category Deleting Failed'));
                return redirect()->route('core.blog.category');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Blog Category Deleting Failed'));
            return redirect()->route('core.blog.category');
        }
    }


    /**
     * Bulk Delete from the database
     *
     * @param \Illuminate\Http\Request $request (Via Ajax)
     * @return \Illuminate\Http\Response (Via Ajax)
     */
    public function bulkDeleteBlogCategory(Request $request)
    {
        try {
            if ($request->has('data')) {
                DB::beginTransaction();
                $bulkDeleteCategoryResponse = $this->blogCategory_repository->bulkDeleteCategory($request->data);
                DB::commit();

                toastNotification($bulkDeleteCategoryResponse['status'], $bulkDeleteCategoryResponse['message']);
            } else {
                toastNotification('error', translate('Blog Category Bulk Deleting Failed'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Blog Category Bulk Deleting Failed'));
        }
    }


    /**
     * Update a category featured status from the database
     *
     * @param \Illuminate\Http\Request $request (Via Ajax)
     * @return \Illuminate\Http\Response (Via Ajax)
     */
    public function updateBlogCategoryFeaturedStatus(Request $request)
    {
        try {
            if ($request->id && is_numeric($request->id)) {
                DB::beginTransaction();
                $updateCategoryStatus = $this->blogCategory_repository->updateCategoryStatus('featured', $request->id);
                DB::commit();
                return response()->json($updateCategoryStatus);
            } else {
                return response()->json(['error' => translate('Blog Category Featured Status Changing Failed')]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => translate('Blog Category Featured Status Changing Failed')]);
        }
    }


    /**
     * Update a category publish status from the database
     *
     * @param \Illuminate\Http\Request $request (Via Ajax)
     * @return \Illuminate\Http\Response (Via Ajax)
     */
    public function updateBlogCategoryPublicStatus(Request $request)
    {
        try {

            if ($request->id && is_numeric($request->id)) {
                DB::beginTransaction();
                $updateCategoryStatus = $this->blogCategory_repository->updateCategoryStatus('publish', $request->id);
                DB::commit();
                return response()->json($updateCategoryStatus);
            } else {
                return response()->json(['error' => translate('Blog Category Publish Status Changing Failed')]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => translate('Blog Category Publish Status Changing Failed')]);
        }
    }
}
