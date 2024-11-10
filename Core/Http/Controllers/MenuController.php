<?php

namespace Core\Http\Controllers;

use Core\Models\Menu;
use Core\Models\Language;
use Core\Models\MenuGroup;
use Illuminate\Http\Request;
use Core\Models\TlBlog;
use Core\Models\TlPage;
use Core\Models\MenuTranslations;
use Core\Models\MenuGroupPosition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Core\Models\TlBlogTag;
use App\Http\Controllers\Controller;
use Core\Models\MenuGroupTranslation;
use Core\Repositories\MenuRepository;
use Core\Models\TlBlogCategory;
use Exception;

class MenuController extends Controller
{
  protected $pushed_menu_id = [];

  protected $menu_repository;
  protected $default_lang;

  public function __construct(MenuRepository $menu_repository)
  {
    $this->menu_repository = $menu_repository;
    $this->default_lang = getGeneralSetting('default_language');
  }

  /**
   * Will redirect to menu list
   */
  public function index()
  {
    return view('core::base.menu.index');
  }

  /**
   * Will return menu list in tree view
   */
  public function treeViewData()
  {
    try {
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
        'tl_uploaded_files.alt as alt'
      ];

      $match_case = [];
      if (isset(request()->menu_group_id)) {
        array_push($match_case, [
          'tl_menus.menu_group_id', '=', request()->menu_group_id
        ]);
        $menu_group = MenuGroup::find(request()->menu_group_id);
      }

      $data = $this->menu_repository->getAllMenus($menu_info, $match_case);

      for ($i = 0; $i < sizeof($data); $i++) {
        $data[$i]->index = $i;
        if ($data[$i]->icon == null || $data[$i]->icon == 'null' || $data[$i]->icon == '' ||  $data[$i]->icon == ' ') {
          $data[$i]->path = $placeholder_image->placeholder_image;
          $data[$i]->alt = $placeholder_image->placeholder_image_alt;
          if (isset(request()->lang_id) && request()->lang_id != $this->default_lang) {
            $translated_title = getTranslatedMenuTitleByLangId($data[$i]->id, request()->lang_id, $data[$i]->title);
            $data[$i]->title = $translated_title;
          }
        } else {
          $data[$i]->alt = $data[$i]->title;
        }
        if ($data[$i]->menu_type_id != null) {
          $data[$i]->preview_url = $data[$i]->url;
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

      $menu_position = [];

      if (isset(request()->menu_group_id)) {
        $data = DB::table('tl_menu_group_has_positon')
          ->where('menu_group_id', '=', request()->menu_group_id)
          ->pluck('menu_position_id');
        $menu_position = $data;
      }

      $menu_group_name = request()->menu_group_name;
      if (isset(request()->lang_id) && request()->lang_id != $this->default_lang) {
        $menu_group_name = getTranslatedMenuTitleByLangId(request()->menu_group_id, request()->lang_id, request()->menu_group_name);
      }

      return response()->json([
        'data' => $final_data,
        'menu_position' => $menu_position,
        'menu_group_name' => $menu_group_name,
        'success' => true
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Unable to fetch menu list")
      ], 500);
    }
  }

  /**
   * done
   * Update group menu list
   *
   * @param  mixed $request
   */
  public function updateMenuStructure(Request $request)
  {
    $this->validate($request, [
      'menu_group_name' => 'required|unique:tl_menu_groups,name,' . $request['menu_group_id']
    ]);
    try {
      DB::beginTransaction();
      $menu_group = MenuGroup::find((int)$request['menu_group_id']);
      if (isset($request['lang_id']) && $request['lang_id'] == $this->default_lang) {
        $menu_group->name = xss_clean($request['menu_group_name']);
      }
      $menu_group->update();

      if (isset($request['lang_id']) && $request['lang_id'] != $this->default_lang) {
        $this->translateMenuGroup($menu_group->id, $request['lang_id'], $request['menu_group_name']);
      }

      $menu_group_position = isset($request['all_position']) ? $request['all_position'] : [];
      $data = [];

      if (isset($menu_group_position)) {
        DB::table('tl_menu_group_has_positon')
          ->where('menu_group_id', '=', $request['menu_group_id'])
          ->orWhereIn('menu_position_id', $menu_group_position)
          ->delete();
      }

      for ($i = 0; $i < sizeof($menu_group_position); $i++) {
        $single_row = [
          'menu_group_id' => $request['menu_group_id'],
          'menu_position_id' => $menu_group_position[$i]
        ];
        array_push($data, $single_row);
      }
      MenuGroupPosition::insert($data);

      DB::commit();
      toastNotification('success', translate('Menu list updated successfully'));
      return response()->json([
        'success' => true,
        'message' => translate('Menu list updated successfully')
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'success' => false,
        'message' => translate("Unable to update menu list")
      ], 500);
    }
  }


  /**
   * translate menu
   *
   * @param  int $menu_id
   * @param  int $lang_id
   * @param  String $menu_name
   * @return void
   */
  public function translateMenu($menu_id, $lang_id, $menu_name)
  {
    $lang = Language::find((int)$lang_id);
    $menu_trans = DB::table('tl_menu_translations')
      ->where('menu_id', '=', (int)$menu_id)
      ->where('lang', '=', $lang->code);

    if ($menu_trans->exists()) {
      $menu = MenuTranslations::find($menu_trans->first()->id);
      $menu->name = $menu_name;
      $menu->update();
    } else {
      $menu = new MenuTranslations();
      $menu->name = $menu_name;
      $menu->lang = $lang->code;
      $menu->menu_id = $menu_id;
      $menu->saveOrFail();
    }
  }

  /**
   * translate menu group
   *
   * @param  int $menu_group_id
   * @param  int $lang_id
   * @param  string $menu_group_name
   * @return void
   */
  public function translateMenuGroup($menu_group_id, $lang_id, $menu_group_name)
  {
    $lang = Language::find((int)$lang_id);
    $menu_group_trans = DB::table('tl_menu_groups_translations')
      ->where('menu_group_id', '=', (int)$menu_group_id)
      ->where('lang', '=', $lang->code);

    if ($menu_group_trans->exists()) {
      $menu_group = MenuGroupTranslation::find($menu_group_trans->first()->id);
      $menu_group->name = $menu_group_name;
      $menu_group->update();
    } else {
      $menu_group = new MenuGroupTranslation();
      $menu_group->name = $menu_group_name;
      $menu_group->lang = $lang->code;
      $menu_group->menu_group_id = $menu_group_id;
      $menu_group->saveOrFail();
    }
  }

  /**
   * Add new menu group
   *
   * @param  mixed $request
   */
  public function addMenuGroup(Request $request)
  {
    $validation = $this->validate($request, [
      'menu_name' => 'required|unique:tl_menu_groups,name'
    ]);
    try {
      DB::beginTransaction();
      $menu_group = new MenuGroup();
      $menu_group->name = xss_clean($request['menu_name']);
      $menu_group->saveOrFail();

      $menu_group_position = (array)$request['all_position'];
      $data = [];

      if (isset($menu_group_position)) {
        DB::table('tl_menu_group_has_positon')
          ->where('menu_group_id', '=', $request['menu_group_id'])
          ->orWhereIn('menu_position_id', $menu_group_position)
          ->delete();
      }

      for ($i = 0; $i < sizeof($menu_group_position); $i++) {
        $single_row = [
          'menu_group_id' => $menu_group->id,
          'menu_position_id' => $menu_group_position[$i]
        ];

        array_push($data, $single_row);
      }

      MenuGroupPosition::insert($data);

      toastNotification('success', translate('Menu list updated successfully'));
      DB::commit();
      return response()->json([
        'success' => true,
        'message' => translate('Menu list updated successfully')
      ]);
    } catch (\Exception $th) {
      DB::rollBack();
      return response()->json([
        'success' => false,
        'message' => translate("Unable to update menu list")
      ], 500);
    }
  }

  /**
   * Will update menu list
   *
   * @param  mixed $request
   */
  public function updateTreeViewData(Request $request)
  {
    try {
      if ($request['id'] != -1) {
        $menu = Menu::find($request['id']);
      } else {
        $menu = new Menu();
      }

      if (isset($request['parent_id']) && $request['parent_id'] != "") {
        $menu->parent_id = $request['parent_id'];
      } elseif (isset($request['sorting'])  && $request['sorting'] != "") {
        $menu->parent_id = NULL;
      }
      if (isset($request['level']) && $request['level'] != "") {
        $menu->level = $request['level'];
      }
      if (isset($request['url']) && $request['url'] != "") {
        $menu->url  = $request['url'];
      }
      if (isset($request['name']) && $request['name'] != "" && isset($request['lang_id']) && $request['lang_id'] == $this->default_lang) {
        $menu->title = $request['name'];
      }

      if (isset($request['menu_group_id']) && $request['menu_group_id'] != "") {
        $menu->menu_group_id = $request['menu_group_id'];
      }
      if ($request['id'] != -1) {
        $menu->update();
      } else {
        $menu->saveOrFail();
      }

      if (isset($request['lang_id']) && $request['lang_id'] != $this->default_lang) {
        $this->translateMenu($menu->id, $request['lang_id'], $request['name']);
      }

      $this->updateChildMenuPosition($request['id'], $request['level']);
      return response()->json([
        'success' => true,
        'message' => translate('Menu list updated successfully')
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Unable to update menu list")
      ], 500);
    }
  }

  /**
   * Will delete menu from tree view
   *
   * @param  mixed $request
   */
  public function deleteTreeViewData(Request $request)
  {
    try {
      $has_child = DB::table('tl_menus')->where('parent_id', '=', $request['id'])->exists();
      if (!$has_child) {
        $menu = Menu::find((int)$request['id']);
        $menu->delete();
        return response()->json([
          'success' => true,
          'message' => translate('Menu deleted successfully')
        ]);
      } else {
        return response()->json([
          'success' => false,
          'message' => translate('Unable to delete menu')
        ], 500);
      }
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate('Unable to delete menu')
      ], 500);
    }
  }

  /**
   * Will update child menu position
   *
   * @param  mixed $menu_id
   * @param  mixed $level
   */
  public function updateChildMenuPosition($menu_id, $level)
  {
    $child_menus = $data = DB::table('tl_menus')
      ->where('parent_id', '=', $menu_id)
      ->select([
        'id',
        'level'
      ])->get();

    for ($i = 0; $i < sizeof($child_menus); $i++) {
      $menu = Menu::find($child_menus[$i]->id);
      $menu->level = $level + 1;
      $menu->update();
      $this->updateChildMenuPosition($child_menus[$i]->id, $level + 1);
    }
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

  public function updateMenuStructureOnSort(Request $request)
  {
    try {
      $menus = $request['data'];
      for ($i = 0; $i < sizeof($menus); $i++) {
        if ($menus[$i]['id'] != "-1") {
          $menu = Menu::find((int)$menus[$i]['id']);
          if ($menu != null) {
            $menu->parent_id = (int)$menus[$i]['parent_id'];
            $menu->level = (int)$menus[$i]['level'];
            $menu->index = $i;
            $menu->update();
          }
        } else {
          $menu = new Menu();
          if (isset($menus[$i]['menu_type_id'])) {
            $menu->menu_type_id = $menus[$i]['menu_type_id'];
            $menu->menu_type = $menus[$i]['menu_type'];
            $menu->url = $menus[$i]['url'];
          } else {
            $menu->url = $menus[$i]['url'];
          }

          $menu->menu_group_id = $request['menu_group_id'];
          $menu->parent_id = 0;
          $menu->level = 1;
          $menu->index = $i;

          $menu->title = $menus[$i]['title'];


          $menu->saveOrFail();
        }
      }

      return response()->json([
        'success' => true,
        'message' => translate('Menu list updated successfully')
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Unable to update menu list")
      ], 500);
    }
  }

  public function coreDeleteMenuGroup(Request $request)
  {
    try {
      $menu_group = MenuGroup::find((int)$request['menu_group_id']);
      $menu_group->delete();

      return response()->json([
        'success' => true,
        'message' => translate('Menu group deleted successfully')
      ]);
    } catch (\Exception $th) {
      return response()->json([
        'success' => false,
        'message' => translate("Unable to delete menu group")
      ], 500);
    }
  }

  public function searchCategoryByKeywords(Request $request)
  {
    try {
      $search_key = $request['keyword'];
      $all_categories = TlBlogCategory::where([
        ['is_publish', '=', '1'],
        ['name', 'like', '%' . $search_key . '%']
      ])
        ->select([
          'id',
          'name',
          'permalink',
        ])->get();


      for ($i = 0; $i < sizeof($all_categories); $i++) {
        $permalink = $all_categories[$i]->permalink;
        $all_categories[$i]->permalink = "/blog/category/" . $permalink;
        $all_categories[$i]->preview_url = URL::to('/') . '/blog/category/' . $permalink;
      }

      return view('core::base.menu.partial.filtered_default_categories', compact('all_categories'));
    } catch (\Exception $th) {
      return response()->json([
        'success' => false,
        'message' => "Invalid Request"
      ], 500);
    }
  }

  public function searchPostByKeywords(Request $request)
  {
    try {
      $search_key = $request['keyword'];
      $all_posts = TlBlog::where([
        ['publish_at', '<', currentDateTime()],
        ['is_publish', '=', config('settings.blog_status.publish')],
        ['visibility', '!=', 'private'],
        ['name', 'like', '%' . $search_key . '%']
      ])
        ->select([
          'id',
          'name',
          'permalink'
        ])->get();

      for ($i = 0; $i < sizeof($all_posts); $i++) {
        $permalink = $all_posts[$i]->permalink;
        $all_posts[$i]->permalink = "/blog/" . $permalink;
        $all_posts[$i]->preview_url = URL::to('/' . $permalink);
      }

      return view('core::base.menu.partial.filtered_default_posts', compact('all_posts'));
    } catch (\Exception $th) {
      return response()->json([
        'success' => false,
        'message' => translate("Invalid Request")
      ], 500);
    }
  }

  public function searchPageByKeywords(Request $request)
  {
    try {
      $search_key = $request['keyword'];
      $all_pages = TlPage::where([
        ['publish_at', '<', currentDateTime()],
        ['visibility', '!=', 'private'],
        ['publish_status', '=',  config('settings.page_status.publish')],
        ['title', 'like', '%' . $search_key . '%']
      ])
        ->select([
          'id',
          'title as name',
          'permalink'
        ])->get();

      for ($i = 0; $i < sizeof($all_pages); $i++) {

        //getting the parent url
        $singlePage = TlPage::where('id', $all_pages[$i]->id)->first();
        $parentUrl = getParentUrl($singlePage);

        $permalink = $all_pages[$i]->permalink;
        $all_pages[$i]->permalink = '/page/' . $parentUrl . $permalink;
        $all_pages[$i]->preview_url = URL::to('/' . $parentUrl . $permalink);
      }

      return view('core::base.menu.partial.filtered_default_pages', compact('all_pages'));
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Invalid Request")
      ], 500);
    }
  }

  public function searchTagByKeywords(Request $request)
  {
    try {
      $search_key = $request['keyword'];

      $all_tags = TlBlogTag::where([
        ['is_publish', '=', '1'],
        ['name', 'like', '%' . $search_key . '%']
      ])
        ->select([
          'id',
          'name',
          'permalink',
        ])->get();

      for ($i = 0; $i < sizeof($all_tags); $i++) {
        $permalink = $all_tags[$i]->permalink;
        $all_tags[$i]->permalink = "/blog/tag/" . $permalink;
        $all_tags[$i]->preview_url = URL::to('/') . "/blog/tag/" . $permalink;
      }
      return view('core::base.menu.partial.filtered_default_tags', compact('all_tags'));
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Invalid Request")
      ], 500);
    }
  }

  public function searchProductCategoryByKeywords(Request $request)
  {
    try {
      $search_key = $request['keyword'];

      $all_product_categories = DB::table('tl_com_categories')
        ->where([
          ['tl_com_categories.status', '=', config('settings.general_status.active')],
          ['tl_com_categories.name', 'like', '%' . $search_key . '%']
        ])
        ->select([
          'tl_com_categories.id',
          'tl_com_categories.name',
          'tl_com_categories.permalink',
        ])->get();

      for ($i = 0; $i < sizeof($all_product_categories); $i++) {
        $permalink = $all_product_categories[$i]->permalink;
        $all_product_categories[$i]->permalink = "/products/category/" . $permalink;
        $all_product_categories[$i]->preview_url = URL::to('/') . '/products/category/' . $permalink;
      }

      return view('plugin/tlecommercecore::menu.partial.filtered_product_categories', compact('all_product_categories'));
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Invalid Request")
      ], 500);
    }
  }

  public function searchProductTagByKeywords(Request $request)
  {
    try {
      $search_key = $request['keyword'];

      $all_product_tags = DB::table('tl_com_product_tags')
        ->where([
          ['tl_com_product_tags.status', '=', config('settings.general_status.active')],
          ['tl_com_product_tags.name', 'like', '%' . $search_key . '%']
        ])
        ->select([
          'tl_com_product_tags.id',
          'tl_com_product_tags.name',
          'tl_com_product_tags.permalink'
        ])->get();

      for ($i = 0; $i < sizeof($all_product_tags); $i++) {
        $permalink = $all_product_tags[$i]->permalink;
        $all_product_tags[$i]->permalink = "/tags/" . $permalink;
        $all_product_tags[$i]->preview_url = URL::to('/') . '/tags/' . $permalink;
      }

      return view('plugin/tlecommercecore::menu.partial.filtered_product_tags', compact('all_product_tags'));
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Invalid Request")
      ], 500);
    }
  }

  public function searchProductBrandByKeywords(Request $request)
  {
    try {
      $search_key = $request['keyword'];

      $all_product_brands = DB::table('tl_com_brands')
        ->where([
          ['tl_com_brands.status', '=', config('settings.general_status.active')],
          ['tl_com_brands.name', 'like', '%' . $search_key . '%']
        ])
        ->select([
          'tl_com_brands.id',
          'tl_com_brands.name',
          'tl_com_brands.permalink',
        ])->get();

      for ($i = 0; $i < sizeof($all_product_brands); $i++) {
        $permalink = $all_product_brands[$i]->permalink;
        $all_product_brands[$i]->permalink = "/brand/" . $permalink;
        $all_product_brands[$i]->preview_url = URL::to('/') . '/brand/' . $permalink;
      }
      return view('plugin/tlecommercecore::menu.partial.filtered_product_brands', compact('all_product_brands'));
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => translate("Invalid Request")
      ], 500);
    }
  }
}
