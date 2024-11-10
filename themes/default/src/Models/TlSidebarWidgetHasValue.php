<?php

namespace Theme\Default\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Theme\Default\Models\TlSidebarWidgetHasTranslateValue;

class TlSidebarWidgetHasValue extends Model
{
    protected $table = "tl_sidebar_widget_has_values";

    protected $guarded = [];
    public $timestamps = false;

    public function translation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $widget_value_translations = $this->widget_value_translations->where('lang', $lang)->first();
        return $widget_value_translations != null ? $widget_value_translations->$field : $this->$field;
    }

    // A Blog Has Many Translations
    public function widget_value_translations()
    {
        return $this->hasMany(TlSidebarWidgetHasTranslateValue::class, 'sidebar_widget_has_values_id');
    }
}
