<?php

namespace Theme\Default\Repositories;

use Core\Models\TlPage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Core\Models\TlPageTemplates;
use Core\Models\TlPageTranslation;

class PageRepository
{
    /**
     * Get page List by different conditions.
     * 
     * @param array $data select from
     * @param array $match_case where condition
     * @param integer $paginate_page paginate number
     * @param string $search search text
     *
     * @return mixed|integer|boolean
     */
    public function getPages($data = ['*'], $match_case = [], $paginate_page = null, $search = '')
    {
        $pages = DB::table('tl_pages')
            ->join('tl_users', 'tl_users.id', '=', 'tl_pages.user_id')
            ->orderBy('tl_pages.id', 'desc')
            ->groupBy('tl_pages.id')
            ->where($match_case);

        $pages = $pages->where(function ($query) use ($search) {
            $query->where('tl_pages.title', 'like', '%' . $search . '%')
                ->orWhere('tl_pages.visibility', 'like', '%' . $search . '%')
                ->orWhere('tl_pages.content', 'like', '%' . $search . '%')
                ->orWhere('tl_users.name', 'like', '%' . $search . '%');
        });

        $pages = $pages->select($data);

        if (isset($paginate_page)) {
            $pages = $pages->paginate($paginate_page);
        } else {
            $pages;
        }
        return $pages;
    }

    /**
     ** get a page by permalink
     * @param Tlpage $permalink
     * @return mixed|array
     */
    public function findPage($permalink)
    {
        $page = TlPage::where('permalink', $permalink)->first();
        return $page;
    }
}
