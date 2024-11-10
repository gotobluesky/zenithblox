<?php
namespace Core\Repositories;

use Core\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository{

    public function getUserProfileInfo($data,$match_case=[])
    {
        $data = User::with('info:*')
        ->leftJoin('tl_uploaded_files','tl_uploaded_files.id','=','tl_users.image')
        ->where($match_case)
        ->select($data);
        return $data;
    }

}