<?php

use Illuminate\Support\Facades\Route;
use Core\Http\Controllers\SeoController;
use Core\Http\Controllers\TagController;

use Core\Http\Controllers\BlogController;
use Core\Http\Controllers\MenuController;
use Core\Http\Controllers\PageController;
use Core\Http\Controllers\UserController;
use Core\Http\Controllers\EmailController;
use Core\Http\Controllers\MediaController;
use Core\Http\Controllers\StyleController;
use Core\Http\Controllers\SystemController;
use Core\Http\Controllers\ThemesController;
use Core\Http\Controllers\CommentController;
use Core\Http\Controllers\PluginsController;
use Core\Http\Controllers\LanguageController;
use Core\Http\Controllers\DashboardController;
use Core\Http\Controllers\ActivityLogController;
use Core\Http\Controllers\AIAssistantController;
use Core\Http\Controllers\BlogCategoryController;
use Core\Http\Controllers\SystemUpdateController;
use Core\Http\Controllers\RolePermissionController;
use Core\Http\Controllers\GeneralSettingsController;
use Core\Http\Controllers\License\LicenseController;
use Core\Http\Controllers\Auth\AuthenticationController;


Route::get('/login', [AuthenticationController::class, 'login'])->name('core.login');
Route::post('/login', [AuthenticationController::class, 'attemptLogin'])->name('core.attemptLogin');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('core.logout');

Route::get('/password-reset-link-form', [AuthenticationController::class, 'passwordResetLink'])->name('core.password.reset.link');
Route::post('email-reset-password-link', [AuthenticationController::class, 'emailResetPasswordLink'])->name('core.email.reset.password.link');
Route::get('reset-password/{token}', [AuthenticationController::class, 'resetPassword'])->name('core.reset.password');
Route::post('reset-your-password', [AuthenticationController::class, 'resetPasswordPost'])->name('core.reset.password.post');

Route::get('/', function () {
    return redirect()->route('core.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('admin.dashboard')->middleware(['can:Manage Dashboard']);
    Route::post('/activate-license', [DashboardController::class, 'licenseActive'])
        ->name('admin.license.active')->middleware(['can:Manage Dashboard']);

    //Languages 
    Route::middleware(['can:Manage Language'])->group(function () {
        Route::get('/languages', [LanguageController::class, 'allLanguages'])->name('core.languages');
        Route::get('/add-new-language', [LanguageController::class, 'newLanguage'])->name('core.language.new');
        Route::post('/store-new-language', [LanguageController::class, 'storeNewLanguage'])->name('core.language.new.store');
        Route::get('/edit-language/{id}', [LanguageController::class, 'editLanguage'])->name('core.language.edit');
        Route::post('/update-language', [LanguageController::class, 'updateLanguage'])->name('core.language.update');
        Route::post('/delete-language', [LanguageController::class, 'deleteLanguage'])->name('core.language.delete')->middleware('demo');

        Route::post('/change-language-rtl', [LanguageController::class, 'changeLanguageRtl'])->name('core.language.change.rtl');
        Route::post('/change-language-status', [LanguageController::class, 'changeLanguageStatus'])->name('core.language.change.status');
        Route::get('/language-translations/{lang}', [LanguageController::class, 'languageKeyValues'])->name('core.language.key.values');
        Route::post('/update-language-key-values', [LanguageController::class, 'updateLanguageKeyValues'])->name('core.language.key.values.update');
        Route::get('/frontend-translations/{lang}', [LanguageController::class, 'frontendTranslations'])->name('core.language.frontend.translations');
        Route::post('/update-frontend-translations}', [LanguageController::class, 'updateFrontendTranslations'])->name('core.language.frontend.translations.update');
    });
    Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('core.language.change');

    //optional language routes
    Route::get('/theme-translations', [LanguageController::class, 'themeTranslations'])->name('core.language.theme.translations');
    Route::post('/store-theme-translations', [LanguageController::class, 'storeThemeTranslations'])->name('core.language.theme.translations.store');

    //Roles
    Route::get('/roles', [RolePermissionController::class, 'roles'])->name('core.roles')
        ->middleware(['can:Show Role']);
    Route::post('/add-role', [RolePermissionController::class, 'addRole'])->name('core.add.role')
        ->middleware(['can:Create Role']);
    Route::get('/edit-role', [RolePermissionController::class, 'editRole'])->name('core.edit.role')
        ->middleware(['can:Edit Role']);
    Route::post('/update-role', [RolePermissionController::class, 'updateRole'])->name('core.update.role')
        ->middleware(['can:Edit Role', 'demo']);
    Route::post('/delete-role', [RolePermissionController::class, 'deleteRole'])->name('core.delete.role')
        ->middleware(['can:Delete Role', 'demo']);

    //Permissions
    Route::get('/permissions', [RolePermissionController::class, 'permissions'])
        ->name('core.permissions')
        ->middleware('can:Show Permission');

    //Users
    Route::get('/users', [UserController::class, 'users'])->name('core.users')
        ->middleware(['can:Show User']);
    Route::get('/add-user', [UserController::class, 'addUser'])->name('core.add.user')
        ->middleware(['can:Create User']);
    Route::get('/profile', [UserController::class, 'profile'])->name('core.profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('core.update.profile')->middleware('demo');
    Route::post('/store-user', [UserController::class, 'storeUser'])->name('core.store.user')
        ->middleware(['can:Create User']);
    Route::post('/update-user-status', [UserController::class, 'updateUserStatus'])->name('core.update.user.status')
        ->middleware(['can:Edit User']);
    Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('core.edit.user')
        ->middleware(['can:Edit User', 'demo']);
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('core.update.user')
        ->middleware(['can:Edit User']);
    Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('core.user.delete')
        ->middleware(['can:Delete User', 'demo']);

    //Media Settings
    Route::middleware(['can:Manage Media Settings'])->group(function () {
        Route::get('/image-settings', [MediaController::class, 'imageSettings'])->name('core.image.settings');
        Route::post('/store-media-settings', [MediaController::class, 'storeMediaSettings'])->name('core.store.media.settings')->middleware('demo');
    });

    Route::get('/media-page', [MediaController::class, 'mediaPage'])->name('core.media.page')
        ->middleware(['can:Manage Media']);
    Route::post('/upload-media-file', [MediaController::class, 'uploadMediaFile'])->name('core.upload.media.file')->middleware('demo');
    Route::post('/update-media-file-info', [MediaController::class, 'updateMediaFileInfo'])->name('core.update.media.file.info');
    Route::post('/filter-media-list', [MediaController::class, 'filterMediaList'])->name('core.filter.media.list');
    Route::post('/delete-media-file', [MediaController::class, 'deleteMediaFile'])->name('core.delete.media.file')->middleware('demo');
    Route::post('/get-media-details-by-id', [MediaController::class, 'getMediaDetailsById'])->name('core.get.media.details.by.id');

    //General Settings
    Route::middleware(['can:Manage General Settings'])->group(function () {
        Route::get('/general-settings', [GeneralSettingsController::class, 'generalSettings'])->name('core.general.settings');
        Route::post('/store-general-settings', [GeneralSettingsController::class, 'storeGeneralSettings'])->name('core.store.general.settings')->middleware('demo');
    });

    //Email settings
    Route::middleware(['can:Manage Email Settings'])->group(function () {
        Route::get('/smtp-configuration', [EmailController::class, 'smtpConfiguration'])->name('core.email.smtp.configuration');
        Route::post('/update-smtp-configuration', [EmailController::class, 'updateSmtpConfiguration'])->name('core.email.update.smtp.configuration')->middleware('demo');
    });

    Route::post('/send-test-email', [EmailController::class, 'sendTestMail'])->name('core.email.send.test');

    Route::middleware(['can:Manage Email Templates'])->group(function () {
        Route::get('/email-templates', [EmailController::class, 'emailTemplates'])->name('core.email.templates');
        Route::post('/update-email-template', [EmailController::class, 'updateEmailTemplate'])->name('core.update.email.template')->middleware('demo');
        Route::post('/get-email-template-variables', [EmailController::class, 'getEmailTemplateVariables'])->name('core.get.email.template.variables');
    });

    //Styles
    Route::post('/update-mood', [StyleController::class, 'changeMood'])->name('core.mood.change');

    // Plugins
    Route::middleware(['can:Manage Plugins'])->group(function () {
        Route::get('/plugins', [PluginsController::class, 'index'])->name('core.plugins.index');
        Route::post('/plugin-inactive', [PluginsController::class, 'inactive'])->name('core.plugins.inactive');
        Route::post('/plugin-active', [PluginsController::class, 'activate'])->name('core.plugins.active');
        Route::get('/plugin-create', [PluginsController::class, 'create'])->name('core.plugins.create');
        Route::post('/plugin-install', [PluginsController::class, 'install'])->name('core.plugins.install');
        Route::post('/plugin/verify', [PluginsController::class, 'verify'])->name('core.plugins.purchase.verify');
        Route::delete('/plugin/delete/{plugin}', [PluginsController::class, 'delete'])->name('core.plugins.delete');
    });

    //Themes
    Route::middleware(['can:Manage Themes'])->group(function () {
        Route::get('/themes', [ThemesController::class, 'index'])->name('core.themes.index');
        Route::post('/theme-activate', [ThemesController::class, 'activate'])->name('core.themes.activate');
    });

    //Menu controller
    Route::middleware(['can:Manage Menus', 'menu.maintain'])->group(function () {
        Route::get('manage-menus', [MenuController::class, 'index'])->name('core.manage.menus');
        Route::post('tree-view-data', [MenuController::class, 'treeViewData'])->name('core.tree.view.data');

        Route::middleware('demo')->group(function () {
            Route::post('update-tree-view-data', [MenuController::class, 'updateTreeViewData'])->name('core.update.tree.view.data');
            Route::post('update-menu-structure', [MenuController::class, 'updateMenuStructure'])->name('core.update.menu.structure');
            Route::post('delete-tree-view-data', [MenuController::class, 'deleteTreeViewData'])->name('core.delete.tree.view.data');
            Route::post('add-menu-group', [MenuController::class, 'addMenuGroup'])->name('core.add.menu.group');
            Route::post('update-menu-structure-on-sort', [MenuController::class, 'updateMenuStructureOnSort'])->name('core.update.menu.structure.on.sort');
            Route::post('core-delete-menu-group', [MenuController::class, 'coreDeleteMenuGroup'])->name('core.delete.menu.group');
        });

        Route::post('search-category-by-keywords', [MenuController::class, 'searchCategoryByKeywords'])->name('core.search.category.by.keywords');
        Route::post('search-post-by-keywords', [MenuController::class, 'searchPostByKeywords'])->name('core.search.post.by.keywords');
        Route::post('search-page-by-keywords', [MenuController::class, 'searchPageByKeywords'])->name('core.search.page.by.keywords');
        Route::post('search-tag-by-keywords', [MenuController::class, 'searchTagByKeywords'])->name('core.search.tag.by.keywords');

        Route::post('search-product-category-by-keywords', [MenuController::class, 'searchProductCategoryByKeywords'])->name('core.search.product.category.by.keywords');
        Route::post('search-product-tag-by-keywords', [MenuController::class, 'searchProductTagByKeywords'])->name('core.search.product.tag.by.keywords');
        Route::post('search-product-brand-by-keywords', [MenuController::class, 'searchProductBrandByKeywords'])->name('core.search.product.brand.by.keywords');
    });


    //Activity Log
    Route::middleware(['can:Manage Login activity'])->group(function () {
        Route::get('get-login-activity', [ActivityLogController::class, 'getLoginActivity'])->name('core.get.login.activity');
        Route::get('get-all-login-activity', [ActivityLogController::class, 'getAllLoginActivity'])->name('core.get.all.login.activity');
        Route::post('login-activity-delete', [ActivityLogController::class, 'loginActivityDelete'])->name('core.login.activity.delete');
        Route::post('login-activity-bulk-delete', [ActivityLogController::class, 'loginActivityBulkDelete'])->name('core.login.activity.bulk.delete');
    });


    //----Blog & page----//
    // Blog Category Routes
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::middleware(['can:Manage Category'])->group(function () {
            Route::get('/blog-category', 'blogCategory')->name('core.blog.category');
            Route::get('/add-blog-category', 'addBlogCategory')->name('core.add.blog.category');
            Route::post('/store-blog-category', 'storeBlogCategory')->name('core.store.blog.category');
            Route::get('/edit-blog-category/{id}', 'editBlogCategory')->name('core.edit.blog.category');
            Route::post('/update-blog-category', 'updateBlogCategory')->name('core.update.blog.category');
            Route::post('/blog-category/delete', 'deleteBlogCategory')->name('core.delete.blog.category')->middleware('demo');
            Route::post('/blog-category/bulk-delete', 'bulkDeleteBlogCategory')->name('core.bulk.delete.blog.category')->middleware('demo');
            Route::post('/blog-category/featured-status-update', 'updateBlogCategoryFeaturedStatus')->name('core.update.blog.category.featured.status');
            Route::post('/blog-category/publish-status-update', 'updateBlogCategoryPublicStatus')->name('core.update.blog.category.publish.status');
        });
    });

    //Tag Routes
    Route::controller(TagController::class)->group(function () {
        Route::middleware(['can:Manage Tag'])->group(function () {
            Route::get('/tag', 'tag')->name('core.tag');
            Route::get('/add-tag', 'addTag')->name('core.add.tag');
            Route::post('/store-tag', 'storeTag')->name('core.store.tag');
            Route::get('/edit-tag/{id}', 'editTag')->name('core.edit.tag');
            Route::post('/update-tag', 'updateTag')->name('core.update.tag');
            Route::post('/tag/delete', 'deleteTag')->name('core.delete.tag')->middleware('demo');
            Route::post('/tag/bulk-delete', 'bulkDeleteTag')->name('core.bulk.delete.tag')->middleware('demo');
            Route::post('/tag/publish-status-update', 'updateTagPublicStatus')->name('core.update.tag.publish.status');
        });
    });

    // Blog  Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog-list', 'blog')->name('core.blog')->middleware(['can:Show Blog']);
        Route::get('/add-blog', 'addBlog')->name('core.add.blog')->middleware(['can:Create Blog']);
        Route::post('/store-blog', 'storeBlog')->name('core.store.blog')->middleware(['can:Create Blog']);
        Route::get('/edit-blog/{id}', 'editBlog')->name('core.edit.blog')->middleware(['can:Edit Blog']);
        Route::post('/update-blog', 'updateBlog')->name('core.update.blog')->middleware(['can:Edit Blog']);
        Route::post('/blog/delete', 'deleteBlog')->name('core.delete.blog')->middleware(['can:Delete Blog', 'demo']);
        Route::post('/blog/bulk-delete', 'bulkDeleteBlog')->name('core.bulk.delete.blog')->middleware(['can:Delete Blog', 'demo']);
        Route::post('/blog/featured-status-update', 'updateBlogFeaturedStatus')->name('core.update.blog.featured.status')->middleware(['can:Edit Blog']);
        Route::post('/blog-category-load', 'categoryLoad')->name('core.blog.category.load');
        Route::post('/blog-tag-load', 'TagLoad')->name('core.blog.tag.load');
        Route::post('/blog-content-image', 'blogContentImage')->name('core.blog.content.image');
        Route::post('/blog-draft-preview',  'blogDraftPreview')->name('core.blog.draft.preview');
        Route::get('/blog-preview', 'blogPreview')->name('core.blog.preview');

        Route::get('/blog-share-options', 'shareOptions')->name('core.blog.share.options')->middleware(['can:Edit Blog']);
        Route::post('/blog-share-option-update-status', 'shareOptionUpdateStatus')->name('core.blog.share.options.update.status')->middleware(['can:Edit Blog', 'demo']);

        Route::get('/ai-settings', [AIAssistantController::class, 'AISetting'])->name('core.blog.ai.setting');
        Route::post('/ai-settings-update', [AIAssistantController::class, 'updateAISetting'])->name('core.blog.update.ai.setting')->middleware('demo');
        Route::post('/generate-content-with-ai', [AIAssistantController::class, 'generateContent'])->name('core.blog.generate.content.with.ai');
    });

    //Blog Comment Routes
    Route::controller(CommentController::class)->group(function () {
        Route::middleware(['can:Manage Comment'])->group(function () {
            Route::get('/comments', 'comment')->name('core.blog.comment');
            Route::post('/comment/bulk/action',  'bulkAction')->name('core.blog.comment.bulk.action')->middleware('demo');
            Route::get('/comments/edit/{id}', 'editComment')->name('core.blog.comment.edit')->middleware('demo');
            Route::post('/comments/update', 'updateComment')->name('core.blog.comment.update');
            Route::post('/comment/status', 'changeStatus')->name('core.blog.comment.status')->middleware('demo');
            Route::post('/comment/delete', 'commentDelete')->name('core.blog.comment.delete')->middleware('demo');
            Route::get('/comment-setting', 'commentSetting')->name('core.blog.comment.setting');
            Route::post('/comment-setting/update', 'updateCommentSetting')->name('core.blog.comment.setting.update')->middleware('demo');
            // both in frontend and core
            Route::post('/blog/comment/reply', [CommentController::class, 'replyBlogComment'])->name('core.blog.comment.reply')->middleware('demo');
        });
    });

    // Page Routes
    Route::controller(PageController::class)->group(function () {
        Route::get('/page-list', 'page')->name('core.page')->middleware(['can:Show Page']);
        Route::get('/add-page', 'addPage')->name('core.page.add')->middleware(['can:Create Page']);
        Route::post('/store-page', 'storePage')->name('core.page.store')->middleware(['can:Create Page']);
        Route::get('/edit-page', 'editPage')->name('core.page.edit')->middleware(['can:Edit Page']);
        Route::post('/update-page', 'updatePage')->name('core.page.update')->middleware(['can:Edit Page']);
        Route::post('/page/delete', 'deletePage')->name('core.page.delete')->middleware(['can:Delete Page'])->middleware('demo');
        Route::post('/page/bulk-delete', 'bulkDeletePage')->name('core.bulk.delete.page')->middleware(['can:Delete Page'])->middleware('demo');
        Route::post('/page-change-status', 'pageStatusChange')->name('core.page.status.change')->middleware(['can:Edit Page']);
        Route::post('/page-content-image', 'pageContentImage')->name('core.page.content.image');
        Route::post('/page-draft-preview', 'pageDraftPreview')->name('core.page.draft.preview');
        Route::get('/page-preview', 'pagePreview')->name('core.page.preview');
        Route::get('/page-make-homepage/{page}', 'makeHomepage')->name('core.page.make.homepage')->middleware(['can:Manage Page Builder']);
    });
    //----Blog & page End----//

    /**
     * Seo settings
     */
    Route::middleware(['can:Manage Seo Settings'])->group(function () {
        Route::get('/seo-settings', [SeoController::class, 'seoSettings'])->name('core.seo.settings');
        Route::post('/update-seo-settings', [SeoController::class, 'updateSeoSettings'])->name('core.seo.settings.update');
    });

    /**
     * System routes
     */
    Route::get('/clear-system-cache', [SystemController::class, 'clearSystemCache'])->name('core.admin.clear.system.cache');
    Route::view('/sitemap', 'core::base.sitemap.sitemap')->name('core.admin.sitemap');
    Route::get('/generate-sitemap', [SystemController::class, 'generateSitemap'])->name('core.admin.generate.sitemap');

    Route::view('activate-license', 'core::base.license.activate')->name('core.license.active');
    Route::post('verify-license', [LicenseController::class, 'activateLicense'])->name('core.license.key.verify');
    Route::view('welcome', 'core::base.welcome.index')->name('core.admin.welcome');

});
