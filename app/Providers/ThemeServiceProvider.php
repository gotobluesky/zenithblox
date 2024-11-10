<?php

namespace App\Providers;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('IS_USER_REGISTERED') == 1) {
            $active_theme = getActiveTheme();
            if ($active_theme != null) {
                //Merge config
                $has_config = file_exists(base_path('themes/' . $active_theme->location .  '/config/config.php'));
                if ($has_config) {
                    $this->mergeConfigFrom(base_path('themes/' . $active_theme->location .  '/config/config.php'), $active_theme->location);
                }

                //Load helper functions
                $has_helpers = file_exists(base_path('themes/' . $active_theme->location . '/helpers/helpers.php'));
                if ($has_helpers) {
                    require_once(base_path('themes/' . $active_theme->location . '/helpers/helpers.php'));
                }

                //Generate namespace
                $loader = new ClassLoader;
                $loader->setPsr4($active_theme->namespace, base_path('themes/' . $active_theme->location . '/src'));
                $loader->register(true);
                //Load view
                $this->loadViewsFrom(base_path('themes/' . $active_theme->location . '/resources/views'), 'theme/' . $active_theme->location);
            }
        }
    }
}
