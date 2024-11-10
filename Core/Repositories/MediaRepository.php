<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;

class MediaRepository
{    
    /**
     * get media list
     *
     * @param  mixed $match_case
     * @param  mixed $paginate
     * @param  mixed $data
     * @return mixed
     */
    public function getMediaList($match_case,$selected_media,$search_key=false,$paginate=false,$data=false)
    {        
        if(!$data){
            $data = [
                'tl_uploaded_files.id',
                'tl_uploaded_files.media_type',
                'tl_uploaded_files.name',
                'tl_uploaded_files.title',
                'tl_uploaded_files.alt',
                'tl_uploaded_files.caption',
                'tl_uploaded_files.description',
                'tl_uploaded_files.path',
                'tl_uploaded_files.size',
                'tl_uploaded_files.file_type',
                'tl_uploaded_files.extension',
                'tl_uploaded_files.folder_name',
                'tl_uploaded_files.uploaded_by',
                'tl_uploaded_files.created_at',
                'tl_uploaded_files.updated_at'
            ];
        }

        $query =  DB::table('tl_uploaded_files')
        ->where($match_case)
        ->select($data);
        if($search_key && $search_key!=null && $search_key!=''){
            $query = $query->where(function($query) use($search_key) {
                $query->where('tl_uploaded_files.name', 'like', '%' . $search_key . '%')
                    ->orWhere('tl_uploaded_files.title', 'like', '%' . $search_key . '%')
                    ->orWhere('tl_uploaded_files.alt', 'like', '%' . $search_key . '%')
                    ->orWhere('tl_uploaded_files.caption', 'like', '%' . $search_key . '%')
                    ->orWhere('tl_uploaded_files.description', 'like', '%' . $search_key . '%')
                    ->orWhere('tl_uploaded_files.file_type', 'like', '%' . $search_key . '%');
            });
        }
        if($selected_media!="" && $selected_media!=null){
            $order_query = "FIELD(id, $selected_media) DESC";
            $query = $query->orderByRaw($order_query);
        }
        if($paginate){
            return $query
            ->orderBy('updated_at','desc')
            ->paginate(request()->per_page);
        }
        else{
            return $query
            ->orderBy('updated_at','desc')
            ->get();
        }
    }
}