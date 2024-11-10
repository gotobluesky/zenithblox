<?php

namespace Theme\Default\Models;

use Illuminate\Database\Eloquent\Model;

class TlWidgetInputField extends Model
{
    protected $guarded = [];
    // Widget Has many inputs
    public function widgetInputOptions()
    {
        return $this->hasMany(TlWidgetInputOption::class, 'widget_input_id');
    }
}
