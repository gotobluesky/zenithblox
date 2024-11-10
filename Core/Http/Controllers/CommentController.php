<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Core\Repositories\BlogRepository;
use Illuminate\Support\Facades\Cache;
use Core\Http\Requests\CommentRequest;
use Core\Repositories\SettingsRepository;
use Illuminate\Support\Facades\Validator;
use Core\Http\Requests\CommentSettingRequest;

class CommentController extends Controller
{
    protected $blog_repository;

    protected $settings_repository;

    public function __construct(BlogRepository $blog_repository, SettingsRepository $settings_repository)
    {
        $this->blog_repository = $blog_repository;
        $this->settings_repository = $settings_repository;
    }

    /**
     ** Get all Blog Comment and go to comments page
     * @param Request $request
     * @return view
     */
    public function comment(Request $request)
    {
        try {
            $match_case = [
                ['tl_blog_comments.status', '!=',  config('settings.blog_comment_status.spam')],
                ['tl_blog_comments.status', '!=',  config('settings.blog_comment_status.trash')],
            ];

            if ($request->per_page) {
                $paginate = (int)$request->per_page;
            } else {
                $paginate = 10;
            }
            $search = '';

            if ($request->status) {
                switch ($request->status) {
                    case 'mine':
                        array_push($match_case, ['tl_blog_comments.user_id', '=', Auth::user()->id]);
                        break;
                    case 'approve':
                        array_push($match_case, ['tl_blog_comments.status', '=',  config('settings.blog_comment_status.approve')]);
                        break;
                    case 'pending':
                        array_push($match_case, ['tl_blog_comments.status', '=',  config('settings.blog_comment_status.pending')]);
                        break;
                    case 'spam':
                        $match_case = [['tl_blog_comments.status', '=',  config('settings.blog_comment_status.spam')]];
                        break;
                    case 'trash':
                        $match_case = [['tl_blog_comments.status', '=', config('settings.blog_comment_status.trash')]];
                        break;
                    case 'user_ip_address':
                        $match_case;
                        break;
                    case 'search_text':
                        $match_case;
                        break;
                    case 'singel_blog_comment':
                        $match_case;
                        break;
                    default:
                        toastNotification('error', translate('Blog Comment Not Found'));
                        return redirect()->back();
                        break;
                }

                if ($request->blog) {
                    array_push($match_case, ['tl_blog_comments.blog_id', '=', $request->blog]);
                }

                if ($request->search) {
                    $search = $request->search;
                }

                if ($request->ip_address) {
                    array_push($match_case, ['tl_blog_comments.user_ip_address', '=', $request->ip_address]);
                }
            }
            $comments = $this->blog_repository->getAllBlogComment($match_case, $paginate, $search);

            return view('core::base.blog.comment.comment', compact('comments'));
        } catch (\Exception $e) {
            toastNotification('error', translate('Blog Comment Not Found'));
            return redirect()->back();
        }
    }

    /**
     ** Change Comment status
     * @param Request $request Ajax
     * @return response
     */
    public function changeStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $status = $this->blog_repository->changeStatus($request);
            DB::commit();

            if ($status == true) {
                toastNotification('success', translate('Comment Status Change!!'));
            } else {
                toastNotification('error', translate('Comment Status Change  Failed'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => translate('Comment Status Change  Failed')]);
        }
    }

    /**
     ** Edit Comment Page
     * @param Request $request
     * @return response
     */
    public function editComment($id)
    {
        try {
            if (is_numeric($id)) {
                $match_case = [
                    ['tl_blog_comments.id', '=', $id],
                ];
                $comment = $this->blog_repository->getAllBlogComment($match_case, 1)[0];
                return view('core::base.blog.comment.edit_comment', compact('comment'));
            } else {
                toastNotification('error', translate('Comment Edit Page Failed'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            toastNotification('error', translate('Comment Edit Page Failed'));
            return redirect()->back();
        }
    }


    /**
     ** comment delete
     * @param Request $request Ajax
     * @return response
     */
    public function commentDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->blog_repository->commentDelete($request);
            DB::commit();
            toastNotification('success', translate('Comment Deleted Successfully!!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => translate('Comment Deleting Failed')]);
        }
    }

    /**
     ** Update Comment
     * @param Request $request
     * @return response
     */
    public function updateComment(CommentRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->blog_repository->updateComment($request);
            DB::commit();

            toastNotification('success', translate('Comment Update Successfully'));
            return redirect()->route('core.blog.comment.edit', $request->id);
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Comment Update Failed'));
            return redirect()->route('core.blog.comment.edit', $request->id);
        }
    }

    /**
     ** Bulk Action
     * @param Request $request
     * @return response
     */
    public function bulkAction(Request $request)
    {
        try {
            if ($request->data && $request->action) {
                DB::beginTransaction();
                $bulkAction = $this->blog_repository->bulkCommentAction($request);
                DB::commit();

                if ($bulkAction == false) {
                    toastNotification('error', translate('Comment Bulk Action Failed'));
                } else {
                    toastNotification('success', translate('Comment Bulk Action Successful'));
                }
            } else {
                toastNotification('error', translate('Comment Bulk Action Failed no data'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Comment Bulk Action Failed'));
        }
    }


    /**
     ** Comment Setting
     * @param Request $request
     * @return response
     */
    public function commentSetting()
    {
        return view('core::base.blog.settings.comment_setting');
    }

    /**
     ** Update Comment Setting
     * @param Request $request
     * @return response
     */
    public function updateCommentSetting(CommentSettingRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->blog_repository->updateCommentSetting($request->all());
            DB::commit();
            Cache::forget('comment-setting');
            toastNotification('success', translate('Comment Settings Updated Successfully'));
            return redirect()->route('core.blog.comment.setting');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Comment Settings Update Failed'));
            return redirect()->route('core.blog.comment.setting');
        }
    }

    /**
     ** Create Blog Comment
     *
     * @param Request $request via AJAX
     * @return \Illuminate\Http\Response json
     */
    public function replyBlogComment(Request $request)
    {
        try {
            $comment_setting = commentFormSettings();
            $rules = [
                'comment' => 'required'
            ];
            if (!$request->user_id) {
                if ($comment_setting['require_name_email'] == '1') {
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
            return response()->json(['error' => translate('Comment Added Failed')]);
        }
    }
}
