<?php

use Illuminate\Support\Facades\Route;
use Theme\Default\Http\Controllers\Frontend\BlogController;
use Theme\Default\Http\Controllers\Backend\ReportController;

use Theme\Default\Http\Controllers\Backend\WidgetController;
use Theme\Default\Http\Controllers\Backend\HomePageController;
use Theme\Default\Http\Controllers\Frontend\FrontendController;
use Theme\Default\Http\Controllers\Backend\ThemeOptionController;
use Theme\Default\Http\Controllers\Frontend\NewsletterController;

//Frontend

Route::middleware('tract.visitor')->group(function () {
    // All Blog Related Routes
    Route::get('/', [FrontendController::class, 'home'])->name('theme.default.home');
    Route::get('/blogs', [BlogController::class, 'blogs'])->name('theme.default.allBlog');

    // blog filter by
    Route::get('/blog/category/{permalink}', [BlogController::class, 'blogByCategory'])->name('theme.default.blogByCategory');
    Route::get('/blog/tag/{permalink}', [BlogController::class, 'blogByTag'])->name('theme.default.blogByTag');
    Route::get('/blog/featured', [BlogController::class, 'blogByFeatured'])->name('theme.default.blogByFeatured');
    Route::get('/blog/search/{text}', [BlogController::class, 'blogBySearch'])->name('theme.default.blogBySearch');
    Route::get('/blog/author/{name}', [BlogController::class, 'blogByAuthor'])->name('theme.default.blogByAuthor');
    Route::get('/blog/date/{date}', [BlogController::class, 'blogByDate'])->where('date', '.+')->name('theme.default.blogByDate');

    // details
    Route::get('/blog/{slug}', [BlogController::class, 'blog_details'])->name('theme.default.blog_details');

    // Contact Page
    Route::view('/contact', 'theme/default::frontend.pages.contact');
});

// Language change
Route::post('/language-change', [FrontendController::class, 'changeLanguage'])->name('theme.default.language.change');

// blog details page
Route::post('/blog/password/load', [BlogController::class, 'getBlogContent'])->name('theme.default.password.load');
Route::post('/blog/comment', [BlogController::class, 'loadBlogComment'])->name('theme.default.comment.load');
Route::post('/blog/comment/create', [BlogController::class, 'createBlogComment'])->name('theme.default.comment.create');

// Newsletter Subscribe
Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('theme.default.newsletter.store');

// Submit Contact Message
Route::post('/sent-message', [FrontendController::class, 'sendMessage'])->name('theme.default.send.message');

// Dark Mode Light Mood Change
Route::post('/change-mood', [FrontendController::class, 'changeDarkMode'])->name('theme.default.mood.change');


//Backend
Route::group(['middleware' => 'auth', 'prefix' => getAdminPrefix()], function () {
    // Frontend Visitor
    Route::post('website-visitor-reports', [ReportController::class, 'visitorReports'])->name('theme.default.visitor.reports');

    Route::middleware(['can:Manage Home Page Builder'])->group(function () {
        // Home Page Builder
        Route::get('home-page-sections', [HomePageController::class, 'homePageSections'])->name('theme.default.homePageSections');
        Route::get('create-new-section', [HomePageController::class, 'newHomePageSection'])->name('theme.default.homePageSection.new');
        Route::post('get-layout-options', [HomePageController::class, 'layoutOptions'])->name('theme.default.homePageSection.layout.options');
        Route::post('store-new-section', [HomePageController::class, 'storeNewHomePageSection'])->name('theme.default.homePageSection.store');
        Route::post('get-ads-layout-options', [HomePageController::class, 'adsLayoutOptions'])->name('theme.default.homePageSection.ads.layout.options');
        Route::post('sorting-sections', [HomePageController::class, 'sortingHomePageSection'])->name('theme.default.homePageSection.sorting');
        Route::post('remove-home-page-section', [HomePageController::class, 'removeHomePageSection'])->name('theme.default.homePageSection.remove')->middleware('demo');
        Route::post('update-home-page-section-status', [HomePageController::class, 'updateHomePageSectionStatus'])->name('theme.default.homePageSection.update.status');
        Route::get('edit-home-page-section/{id}', [HomePageController::class, 'editHomePageSection'])->name('theme.default.homePageSection.edit');
        Route::post('update-home-section', [HomePageController::class, 'updateHomePageSection'])->name('theme.default.homePageSection.update');
    });


    Route::middleware(['can:Manage Widget'])->group(function () {
        // Widgets Controller
        Route::get('/manage-widgets', [WidgetController::class, 'widgets'])->name('theme.default.widgets');
        Route::post('/get-widget-input', [WidgetController::class, 'getWidgetInputFields'])->name('theme.default.widget.get_input_field');
        Route::post('/add-widget-sidebar', [WidgetController::class, 'addWidgetToSidebar'])->name('theme.default.widget.addToSidebar');
        Route::post('/remove-widget-sidebar', [WidgetController::class, 'removeWidgetFromSidebar'])->name('theme.default.widget.removeFromSidebar')->middleware('demo');
        Route::post('/save-sidebar-widget-form', [WidgetController::class, 'saveWidgetSidebarInput'])->name('theme.default.widget.widgetSidebarForm');
        Route::post('/widget-order-save', [WidgetController::class, 'saveWidgetOrder'])->name('theme.default.widget.saveWidgetOrder');
    });

    Route::middleware(['can:Manage Theme General settings'])->group(function () {
        //Theme Options
        Route::get('/theme-options', [ThemeOptionController::class, 'themeOptions'])->name('theme.default.options');
        Route::post('/get-theme-option-form', [ThemeOptionController::class, 'getOptionForm'])->name('theme.default.get.option.form');
        Route::post('/save-theme-option-form', [ThemeOptionController::class, 'saveOptionForm'])->name('theme.default.save.option.form')->middleware('demo');
        Route::post('/import-theme-option', [ThemeOptionController::class, 'importThemeOption'])->name('theme.default.theme-option.import');
        Route::get('/theme-option/download', [ThemeOptionController::class, 'downloadThemeOption'])->name('theme.default.theme-option.download');
    });
});

// for page
Route::get('/page/{permalink?}', [FrontendController::class, 'pageDetails'])->name('theme.default.viewPage')->where('permalink', '.+')->middleware('tract.visitor');
Route::post('/page/password/load', [FrontendController::class, 'getPageContent'])->name('theme.default.page.password.load');
