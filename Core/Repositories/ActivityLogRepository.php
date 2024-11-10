<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;

class ActivityLogRepository
{    

    /**
     * get all login activity logs
     *
     * @return mixed
     */
    public function getAllLoginActivityLogs($data,$match_case){
        return DB::table('admin_login_activity_log')
            ->join('tl_users','tl_users.id','=','admin_login_activity_log.user_id')
            ->orderByDesc('admin_login_activity_log.id')
            ->select($data);
    }
}
