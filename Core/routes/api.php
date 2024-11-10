<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Core\Http\Controllers\LeadController;
use Theme\Default\Http\Controllers\Backend\ThemeOptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/signup', [LeadController::class, 'store'])->name('lead.signup');
Route::post('/get-theme-option', [ThemeOptionController::class, 'getOptionFormApi'])->name('api.theme.option');