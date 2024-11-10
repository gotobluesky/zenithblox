<?php

namespace Theme\Default\Models;

use Illuminate\Database\Eloquent\Model;

class TlThemeSidebar extends Model
{
    protected $guarded = [];

    // Sidebar has many widget
    public function widgets()
    {
        return $this->hasMany(TlSidebarHasWidget::class, 'sidebar_id');
    }
}
