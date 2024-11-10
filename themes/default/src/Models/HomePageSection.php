<?php

namespace Theme\Default\Models;

use Illuminate\Database\Eloquent\Model;
use Theme\Default\Models\HomeSectionProperties;

class HomePageSection extends Model
{

    protected $table = "tl_theme_default_home_page_sections";

    public function section_properties()
    {
        return $this->hasMany(HomeSectionProperties::class, 'section_id', 'id');
    }
}
