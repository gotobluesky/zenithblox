<?php

namespace Theme\Default\Models;

use Illuminate\Database\Eloquent\Model;

class TlWidget extends Model
{
    protected $guarded = [];

    // Widget Has many inputs
    public function widgetInputFields()
    {
        return $this->hasMany(TlWidgetInputField::class, 'widget_id')->select('id','field_type','title_text');
    }
}
