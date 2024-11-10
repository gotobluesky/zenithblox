<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

Route::group(['prefix' => 'install', 'middleware' => ['web', 'install','redirectIfInstalled']], function () {
    Route::get('/', [InstallController::class, 'index'])->name('install.welcome');
    Route::get('/requirements', [InstallController::class, 'requirements'])->name('install.requirements');
    Route::get('/permissions', [InstallController::class, 'permissions'])->name('install.permissions');
    Route::view('/database', 'install.database')->name('install.database');
    Route::post('/save-and-test-database', [InstallController::class, 'saveDatabase'])->name('install.database.save');
    Route::view('/import-sql', 'install.import_sql')->name('install.database.import');
    Route::post('/import-ecommerce-sql', [InstallController::class, 'importDatabase'])->name('install.database.import.ecommerce');
    Route::view('/registration', 'install.registration')->name('install.user.registration');
    Route::post('/registration', [InstallController::class, 'saveUser'])->name('install.user.registration.complete');
});
