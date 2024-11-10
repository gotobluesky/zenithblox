<?php

use Core\Models\Themes;
use Core\Models\Language;
use Illuminate\Support\Facades\Cache;
// use Session;

if (!function_exists('getActiveThemeOptions')) {
    /**
     * get active theme's theme options
     *
     * @return String
     */
    function getActiveThemeOptions()
    {
        $theme = getActiveTheme();
        $item = 'theme/' . $theme->location . '::backend.includes.themeOptions';
        return $item;
    }
}


if (!function_exists('getActiveTheme')) {
    /**
     * get active theme
     *
     * @return Collection
     */
    function getActiveTheme()
    {
        $active_theme = Cache::rememberForever('active-theme', function(){
            return Themes::where('is_activated', 1)->first();
        });
        return $active_theme;
    }
}