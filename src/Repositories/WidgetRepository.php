<?php

namespace Theme\Default\Repositories;

use Theme\Default\Models\TlWidget;
use Theme\Default\Models\TlThemeSidebar;
use Theme\Default\Models\TlSidebarHasWidget;
use Theme\Default\Models\TlSidebarWidgetHasValue;
use Theme\Default\Models\TlSidebarWidgetHasTranslateValue;

class WidgetRepository
{
    /**
     * Get all the widgets
     */
    public function getWidgets($condition = null)
    {
        $widgets = TlWidget::where($condition);
        return $widgets;
    }

    /**
     * Get all the widgets
     */
    public function getSidebar($condition = null)
    {
        $sidebars = TlThemeSidebar::where($condition);
        return $sidebars;
    }

    /**
     * Get all the sidebar has widgets
     */
    public function getSidebarHasWidgets($condition = null)
    {
        $sidebars = TlSidebarHasWidget::where($condition);
        return $sidebars;
    }

    /**
     * Add widget to sidebar
     * @param integer $widget_id Widget Id
     * @param integer $sidebar_id Sidebar Id
     * @return integer
     */
    public function addWidgetToSidebar($widget_id, $sidebar_id)
    {
        $sidebar_widget = new TlSidebarHasWidget();
        $sidebar_widget->sidebar_id = $sidebar_id;
        $sidebar_widget->widget_id = $widget_id;
        $sidebar_widget->save();
        return $sidebar_widget->id;
    }

    /**
     * remove widget from sidebar
     * @param $widget_id Widget Id
     * @param $sidebar_id Sidebar Id
     * @return void
     */
    public function removeWidgetFromSidebar($sidebar_has_widget_id)
    {
        $condition = [
            ['id', $sidebar_has_widget_id],
        ];
        $this->getSidebarHasWidgets($condition)->first()->delete();
    }

    /**
     * save widget input fields to sidebar
     * @param integer $sidebar_has_widget_id
     * @param array $data 
     * @return void
     */
    public function saveWidgetSidebarInput($sidebar_has_widget_id, $data)
    {
        $updatedData = [];
        $lang = '';
        foreach($data as $key => $value){
            if($value['name'] === 'lang'){
                $lang = $value['value'];
            } else {
                if(str_contains($value['name'],'author_image')){
                    $updatedData['author_image'] = $value['value']; 
                } else {
                    $updatedData[$value['name']] = xss_clean($value['value']); 
                }
            }
        }

        if ($lang != '' && $lang != 'en'){
            $sidebar_widget_value = TlSidebarWidgetHasValue::firstOrCreate(['sidebar_has_widget_id' => $sidebar_has_widget_id]);
            $value_translation = TlSidebarWidgetHasTranslateValue::firstOrNew(['sidebar_widget_has_values_id' => $sidebar_widget_value->id, 'lang' => $lang]);
            $value_translation->value = json_encode($updatedData);
            $value_translation->save();
        } else {
            TlSidebarWidgetHasValue::updateOrCreate([
                'sidebar_has_widget_id' => $sidebar_has_widget_id
                ],[
                    'value' => json_encode($updatedData)
                ]);
        }
    }


    /**
     * Save sidebar widget order
     * @param integer $sidebar_id Sidebar Id
     * @param array $order widget order
     * @return void
     */
    public function saveWidgetOrder($order)
    {
        foreach ($order as $value) {
            TlSidebarHasWidget::where('id', $value['id'])->update([
                'order' => $value['position']
            ]);
        }
    }
}
