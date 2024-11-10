<?php

namespace Core\Models;
use Illuminate\Database\Eloquent\Model;

class ThemeTranslations extends Model
{
    protected $table = "tl_theme_translations";
    protected $fillable = ['theme','lang_key','lang'];
}
