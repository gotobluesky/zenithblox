<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class MenuRepository
{
    protected $pushed_menu_id = [];

    public function getAllMenus($data, $match_case = [])
    {
        $data = DB::table('tl_menus')
            ->join('tl_menu_groups', 'tl_menu_groups.id', '=', 'tl_menus.menu_group_id')
            ->leftJoin('tl_menu_group_has_positon', 'tl_menu_group_has_positon.menu_group_id', '=', 'tl_menu_groups.id')
            ->leftJoin('tl_uploaded_files', 'tl_uploaded_files.id', '=', 'tl_menus.icon')
            ->orderBy('index')
            ->orderBy('level')
            ->where($match_case)
            ->select($data)->get();
        return $data;
    }

    public function getMenuStructureForView($position_id)
    {
        $placeholder_image = getPlaceHolderImage();
        $menu_info = [
            'tl_menus.id',
            'tl_menus.parent_id',
            'tl_menus.level',
            'tl_menus.title',
            'tl_menus.url',
            'tl_menus.url as preview_url',
            'tl_menus.icon',

            'tl_menus.menu_type_id',
            'tl_menus.menu_type',

            'tl_uploaded_files.path as path',
            'tl_uploaded_files.alt as alt',

            'tl_menu_groups.name as group_name'
        ];
        $match_case = [];
        array_push($match_case, [
            'tl_menu_group_has_positon.menu_position_id', '=', $position_id
        ]);

        $data = $this->getAllMenus($menu_info, $match_case);
        $default_lang = getGeneralSetting('default_language');

        for ($i = 0; $i < sizeof($data); $i++) {
            $data[$i]->index = $i;
            if ($data[$i]->icon == null || $data[$i]->icon == 'null' || $data[$i]->icon == '' ||  $data[$i]->icon == ' ') {
                $data[$i]->path = $placeholder_image->placeholder_image;
                $data[$i]->alt = $placeholder_image->placeholder_image_alt;
                if (Session::get('api_locale') != null && Session::get('api_locale') != $default_lang) {
                    $translated_title = getTranslatedMenuTitle($data[$i]->id, Session::get('api_locale'), $data[$i]->title);
                    $data[$i]->title = $translated_title;
                } else {
                    $translated_title = getTranslatedMenuTitle($data[$i]->id, $default_lang, $data[$i]->title);
                    $data[$i]->title = $translated_title;
                }
            } else {
                $data[$i]->alt = $data[$i]->title;
            }
            if ($data[$i]->menu_type_id != null) {
                $data[$i]->preview_url = URL::to($data[$i]->url);
            } else {
                $str = $data[$i]->url;
                if (substr($str, 0, 1) === "/") {
                    $data[$i]->url = URL::to($data[$i]->url);
                }
            }
        }

        $final_data = [];
        for ($i = 0; $i < sizeof($data); $i++) {
            if (!in_array($data[$i]->id, $this->pushed_menu_id)) {
                array_push($final_data, $data[$i]);
                array_push($this->pushed_menu_id, $data[$i]->id);
                $final_data = $this->getChildMenus($data[$i]->id, $data, $final_data);
            }
        }

        return $final_data;
    }

    /**
     * Will return array with child menus
     *
     * @param  mixed $menu_id
     * @param  mixed $data
     * @param  mixed $final_data
     */
    public function getChildMenus($menu_id, $data, $final_data)
    {
        for ($i = 0; $i < sizeof($data); $i++) {
            if ($menu_id == $data[$i]->parent_id && !in_array($data[$i]->id, $this->pushed_menu_id)) {
                array_push($final_data, $data[$i]);
                array_push($this->pushed_menu_id, $data[$i]->id);
                $final_data = $this->getChildMenus($data[$i]->id, $data, $final_data);
            }
        }
        return $final_data;
    }
}
