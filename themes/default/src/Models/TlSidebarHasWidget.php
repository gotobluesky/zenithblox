<?php

namespace Theme\Default\Models;

use Illuminate\Database\Eloquent\Model;

class TlSidebarHasWidget extends Model
{
    protected $table = "tl_sidebar_has_widgets";
    protected $guarded = [];
    public $timestamps = false;

    // This belongs to an widget
    public function widget()
    {
        return $this->belongsTo(TlWidget::class, 'widget_id');
    }

    // this has many values
    public function sidebar_has_widget_value()
    {
        return $this->hasMany(TlSidebarWidgetHasValue::class, 'sidebar_has_widget_id')->select('value');
    }
}
