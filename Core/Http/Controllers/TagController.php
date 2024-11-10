<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Core\Repositories\LanguageRepository;
use Core\Http\Requests\TagRequest;
use Core\Repositories\BlogRepository;

class TagController extends Controller
{

    protected $language_repository;
    protected $blog_repository;

    public function __construct(LanguageRepository $language_repository, BlogRepository $blog_repository)
    {
        $this->language_repository = $language_repository;
        $this->blog_repository = $blog_repository;
    }


    /**
     * Show all the Tags
     * @return \Illuminate\Http\Response
     */
    public function tag(Request $request)
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
                    case 'publish':
                        array_push($match_case, ['is_publish', '1']);
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
            $tags = $this->blog_repository->getAllTags($match_case, null, $pagination, $search);
            return view('core::base.blog.tag.tag', compact('tags'));
        } catch (\Exception $e) {
            toastNotification('error', translate('Tags Page unavailable'));
            return redirect()->back();
        }
    }

    /**
     * Show the add Tag Page for adding  a new tag
     *
     * @return \Illuminate\Http\Response
     */
    public function addTag()
    {
        return view('core::base.blog.tag.add_tag');
    }

    /**
     * Store a new Tag
     * @param TagRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeTag(TagRequest $request)
    {
        try {
            DB::beginTransaction();
            $tag = $this->blog_repository->addNewTag($request);
            DB::commit();

            toastNotification('success', translate('New Tag Created Successfully!'));
            return redirect()->route('core.edit.tag', ['id' =>  $tag->id, 'lang' => getDefaultLang()]);
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('New Tag Creating Faile'));
            return redirect()->route('core.add.tag');
        }
    }

    /**
     * Show the edit tag page
     * @param \Illuminate\Http\Request $request
     * @param Int $id
     * @return \Illuminate\Http\Response
     */
    public function editTag(Request $request, $id)
    {
        try {
            if ($request->id && is_numeric($request->id) && $request->lang) {

                $languages = $this->language_repository->allLanguages();
                $lang =  $request->lang;
                $tag = $this->blog_repository->findTag($request->id);
                return view('core::base.blog.tag.edit_tag', compact('tag', 'languages', 'lang'));
            } else {

                toastNotification('error', translate('Tag not found'));
                return redirect()->route('core.tag');
            }
        } catch (\Exception $e) {
            toastNotification('error', translate('Tag not found'));
            return redirect()->route('core.blog.Tag');
        }
    }

    /**
     * Update a Tag
     * @param \Core\Http\Requests\TagRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateTag(TagRequest $request)
    {
        try {
            if ($request->id && is_numeric($request->id)  && $request->lang) {
                DB::beginTransaction();
                $this->blog_repository->updateTag($request);
                DB::commit();

                toastNotification('success', translate('Tag Updated Successfully'));
                return redirect()->route('core.edit.tag', ['id' =>  $request->id, 'lang' => $request->lang]);
            } else {
                toastNotification('error', translate('Tag Update Failed'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Tag Update Failed'));
            return redirect()->back();
        }
    }


    /**
     * Delete a tag
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteTag(Request $request)
    {
        try {
            if ($request->id && is_numeric($request->id)) {
                DB::beginTransaction();
                $this->blog_repository->deleteTag($request->id);
                DB::commit();
                toastNotification('success', translate('Tag Deleted Successfully'));
                return redirect()->back();
            } else {
                toastNotification('error', translate('Tag Deleting Failed'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Tag Deleting Failed'));
            return redirect()->back();
        }
    }


    /**
     * Bulk Delete Tag
     * @param \Illuminate\Http\Request $request (Via Ajax)
     * @return \Illuminate\Http\Response (Via Ajax)
     */
    public function bulkDeleteTag(Request $request)
    {
        try {
            if ($request->has('data')) {
                DB::beginTransaction();
                $this->blog_repository->bulkDeleteTag($request->data);
                DB::commit();
                toastNotification('success', translate('Tag Bulk Deleted Successfully'));
            } else {
                toastNotification('error', translate('Tag Bulk Deleting Failed'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Tag Bulk Deleting Failed'));
        }
    }

    /**
     * Update a tag publish status
     * @param \Illuminate\Http\Request $request (Via Ajax)
     * @return \Illuminate\Http\Response (Via Ajax)
     */
    public function updateTagPublicStatus(Request $request)
    {
        try {
            if ($request->id && is_numeric($request->id)) {
                DB::beginTransaction();
                $updatetagStatusResponse = $this->blog_repository->updateTagPublicStatus($request);
                DB::commit();

                return response()->json($updatetagStatusResponse);
            } else {
                return response()->json(['error' => translate('TagPublish Status Changing Failed')]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => translate('Tag Publish Status Changing Failed')]);
        }
    }
}
