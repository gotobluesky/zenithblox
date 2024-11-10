<?php

use Illuminate\Support\Facades\Route;
use Plugin\DemoPlugin\Http\Controllers\DemoPluginController;

Route::group(['prefix' => getAdminPrefix()], function () {
    Route::get('demo-plugin', [DemoPluginController::class, 'index'])->name('plugin.demo-plugin.index');
});
