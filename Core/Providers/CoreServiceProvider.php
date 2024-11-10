<?php

namespace Core\Providers;

use Illuminate\Support\Facades\View;
use Core\Views\Composer\Core;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Plugn helper functions
        $has_helpers = file_exists(base_path('Core/Helpers/Plugin.php'));
        if ($has_helpers) {
            require_once(base_path('Core/Helpers/Plugin.php'));
        }

        $this->loadViewsFrom(base_path('Core/Views'), 'core');
        View::composer(['core::base.layouts.header', 'core::base.layouts.master', 'core::base'], Core::class);
    }
}
