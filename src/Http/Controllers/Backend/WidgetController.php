<?php

namespace Theme\Default\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Theme\Default\Repositories\WidgetRepository;

class WidgetController extends Controller
{

  public function __construct(protected WidgetRepository $widget_repository)
  {
    getThemeWidgetNameAsArray('default_theme_widget');//theme widget
    getThemeSidebarNameAsArray('default_theme_sidebar');//theme sidebars
  }

  /**
   * Manage Widgets Page
   * @return View
   */
  public function widgets()
  {
    try {
      $active_theme = getActiveTheme();
      $condition = [
        ['theme_id', $active_theme->id]
      ];

      $widgets = $this->widget_repository->getWidgets($condition)->get();
      $sidebars = $this->widget_repository->getSidebar($condition)->get();
      return view('theme/default::backend.widgets.widget', compact('widgets', 'sidebars'));
    } catch (\Exception $e) {
      toastNotification('error', translate('Widget Page Failed'));
      return redirect()->back();
    }
  }


  /**
   * Getting A widgets Input Field
   * @param $request widget id via Ajax
   * @return response
   */
  public function getWidgetInputFields(Request $request)
  {
    try {
      if (isset($request->sidebar_has_widget_id) && is_numeric($request->sidebar_has_widget_id)) {
        $widget_id = $request->widget_id;
        $sidebar_has_widget_id = $request->sidebar_has_widget_id;
        $lang = $request->lang == '' ? getDefaultLang():$request->lang;
        $widget_name = getThemeWidgetName($widget_id);
        $value = getSidebarWidgetValues($sidebar_has_widget_id,$lang);
        
        $html = view('theme/default::backend.widgets.widget-forms.'.$widget_name, compact('value','sidebar_has_widget_id','widget_id','lang'))->render();
        return response()->json(['html' => $html, 'lang_name' => getLanguageNameByCode($lang)]);
      }
    } catch (\Exception $e) {
      return response()->json(['error' => translate('Widget Input Menu Opening Failed')]);
    }
  }


  /**
   * Add Widget To sidebar
   * @param $request from Ajax
   * @return Response
   */
  public function addWidgetToSidebar(Request $request)
  {
    try {
      $widget = $this->widget_repository->getWidgets([['id', $request->widget_id]])->exists();
      $sidebar = $this->widget_repository->getSidebar([['id', $request->sidebar_id]])->exists();

      if ($widget && $sidebar) {
        DB::beginTransaction();
        $sidebar_has_widget_id = $this->widget_repository->addWidgetToSidebar($request->widget_id, $request->sidebar_id);
        DB::commit();
        return response()->json(['success' => translate('Sidebar Updated'), 'sidebar_has_widget_id' => $sidebar_has_widget_id]);
      } else {
        return response()->json(['error' => translate('Widget Or Sidebar Does not exists.')]);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('Widget Save to Sidebar Failed')]);
    }
  }

  /**
   * Remove Widget From sidebar
   * @param $request from AJax
   * @return Response
   */
  public function removeWidgetFromSidebar(Request $request)
  {
    try {
      $sidebar_has_widget = $this->widget_repository->getSidebarHasWidgets([['id', $request->sidebar_has_widget_id]])->exists();
      $sidebar = $this->widget_repository->getSidebar([['id', $request->sidebar_id]])->exists();

      if ($sidebar_has_widget && $sidebar) {
        DB::beginTransaction();
        $this->widget_repository->removeWidgetFromSidebar($request->sidebar_has_widget_id);
        DB::commit();
        return response()->json(['success' => translate('Widget Removed From Sidebar')]);
      } else {
        return response()->json(['success' => translate('Widget Removed From Sidebar')]);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('Widget Remove From Sidebar Failed')]);
    }
  }

  /**
   * Save Widget Sidebar Input
   * @param $request from AJax
   * @return Response
   */
  public function saveWidgetSidebarInput(Request $request)
  {
    try {
      $sidebar_has_widget = $this->widget_repository->getSidebarHasWidgets([['id', $request->sidebar_has_widget_id]])->exists();

      if ($sidebar_has_widget) {
        DB::beginTransaction();
        $this->widget_repository->saveWidgetSidebarInput($request->sidebar_has_widget_id, $request->data);
        DB::commit();
        toastNotification('success', translate('Widget Form Saved'));
      } else {
        return response()->json(['error' => translate('Widget Input Fields Saving Failed')]);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('Widget Input Fields Saving Failed')]);
    }
  }

  /**
   * Save Widget Order
   * @param $request from AJax
   * @return Response
   */
  public function saveWidgetOrder(Request $request)
  {
    try {
      if ($request->sidebar_id) {
        DB::beginTransaction();
        $this->widget_repository->saveWidgetOrder($request->order);
        DB::commit();
      } else {
        return response()->json(['error' => translate('Widget Order Change Failed')]);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => translate('Widget Order Change Failed')]);
    }
  }
}
