<?php

namespace App\Providers;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
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
        if (env('IS_USER_REGISTERED')==1) {
            $plugins = getActivePlugins();

            foreach ($plugins as $plugin) {
                //Merge config
                $has_config = file_exists(base_path('plugins/' . $plugin->location . '/config/config.php'));
                if ($has_config) {
                    $this->mergeConfigFrom(base_path('plugins/' . $plugin->location . '/config/config.php'), $plugin->location);
                }
                //Load helper
                $has_helpers = file_exists(base_path('plugins/' . $plugin->location . '/helpers/helpers.php'));
                if ($has_helpers) {
                    require_once(base_path('plugins/' . $plugin->location . '/helpers/helpers.php'));
                }
                //Load view
                $this->loadViewsFrom(base_path('plugins/' . $plugin->location . '/views'), 'plugin/' . $plugin->location);

                //Generate Namespace
                $loader = new ClassLoader;
                $loader->setPsr4($plugin->namespace, base_path('plugins/' . $plugin->location . '/src'));
                $loader->register(true);
            }
        }
    }
}
