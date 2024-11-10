<?php

namespace Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Core\Models\AdminLoginActivityLog;
use Yajra\DataTables\Facades\DataTables;
use Core\Repositories\ActivityLogRepository;


class ActivityLogController extends Controller
{

    protected $repository;
    public function __construct(ActivityLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * will redirect to login activity
     *
     * @return mixed
     */
    public function getLoginActivity()
    {
        return view('core::base.activity_log.login_activity');
    }

    /**
     * get all login activity
     *
     * @return mixed
     */
    public function getAllLoginActivity()
    {
        try {
            $data = [
                DB::raw('DATE_FORMAT(admin_login_activity_log.login_at, "%Y-%m-%d %h:%i") as login_at'),
                DB::raw('DATE_FORMAT(admin_login_activity_log.logout_at, "%Y-%m-%d %h:%i") as logout_at'),
                'admin_login_activity_log.id as log_id',
                'admin_login_activity_log.ip', 'admin_login_activity_log.os',
                'admin_login_activity_log.browser', 'tl_users.name as user_name'
            ];

            $query = $this->repository->getAllLoginActivityLogs($data,[]);       

            $logs = DataTables::of($query)->toJson();

            return $logs;
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => translate("Unable to fetch login activity list")
            ], 500);
        }
    }

    /**
     * login activity delete
     *
     * @param  Request $request
     * @return mixed
     */
    public function loginActivityDelete(Request $request)
    {
        try {
            $log = AdminLoginActivityLog::findOrFail($request['id']);
            $log->delete();
            Toastr::success(translate('Login activity log deleted successfully'));
            return redirect()->route('core.get.login.activity');
        } catch (Exception $e) {
            Toastr::error(translate('Unable to delete login activity log'));
            return back();
        }
    }

    /**
     * Delete login activity in bulk
     *
     * @param  Request $request
     * @return mixed
     */
    public function loginActivityBulkDelete(Request $request)
    {
        try {
            if ($request->has('data')) {
                foreach ($request['data'] as $log_id) {
                    $log = AdminLoginActivityLog::findOrFail($log_id);
                    $log->delete();
                }
            }
            toastNotification('success', translate('Items Deleted Successfully'));
        } catch (\Exception $e) {
            toastNotification('error', translate('Action Failed'));
        } catch (\Error $e) {
            toastNotification('error', translate('Action Failed'));
        }
    }
}
