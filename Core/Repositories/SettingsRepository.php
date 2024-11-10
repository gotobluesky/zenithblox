<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;

class SettingsRepository
{
    /**
     * get settings data
     */
    public function getSettingsData($data,$match_case=[])
    {
        $media_settings_value = DB::table('tl_general_settings')
        ->leftJoin('tl_general_settings_has_values','tl_general_settings.id','=','tl_general_settings_has_values.settings_id')
        ->leftJoin('tl_uploaded_files','tl_uploaded_files.id','=','tl_general_settings_has_values.value')
        ->where($match_case)
        ->select($data)->get();
        return $media_settings_value;
    }
}