<?php

use Core\Models\TlBlog;
use Core\Models\TlPage;
use Carbon\CarbonPeriod;
use Core\Models\Language;
use Core\Models\TlBlogTag;
use Illuminate\Support\Str;
use Core\Models\ActivityLog;
use Core\Models\MenuPosition;
use Core\Models\Translations;
use Core\Models\UploadedFile;
use Illuminate\Support\Carbon;
use Core\Models\TlBlogCategory;
use Core\Models\GeneralSettings;
use Core\Models\ThemeTranslations;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Core\Repositories\BlogRepository;
use Core\Repositories\MenuRepository;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Core\Models\GeneralSettingsHasValue;
use Spatie\Permission\Models\Permission;
use Core\Repositories\SettingsRepository;

/**
 * translate
 *
 * @param  mixed $key
 * @param  mixed $lang
 * @param  mixed $addslashes
 * @return mixed
 */
function translate($key, $lang = null, $addslashes = false)
{
    if ($lang == null) {
        $lang = session()->get('locale');
    }


    $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

    $translations_en = Cache::rememberForever('translations-en', function () {
        return Translations::where('lang', 'en')->pluck('lang_value', 'lang_key')->toArray();
    });

    if (!isset($translations_en[$lang_key])) {
        $translation_def = new Translations;
        $translation_def->lang = 'en';
        $translation_def->lang_key = $lang_key;
        $translation_def->lang_value = str_replace(array("\r", "\n", "\r\n"), "", $key);
        $translation_def->save();
        cache_clear();
    }

    // return user session lang
    $translation_locale = Cache::rememberForever("translations-{$lang}", function () use ($lang) {
        return Translations::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
    });

    if (isset($translation_locale[$lang_key])) {
        return $addslashes ? addslashes(trim($translation_locale[$lang_key])) : trim($translation_locale[$lang_key]);
    }


    // return default lang if session lang not found
    $translations_default = Cache::rememberForever('translations-' . env('DEFAULT_LANGUAGE', 'en'), function () {
        return Translations::where('lang', env('DEFAULT_LANGUAGE', 'en'))->pluck('lang_value', 'lang_key')->toArray();
    });

    if (isset($translations_default[$lang_key])) {
        return $addslashes ? addslashes(trim($translations_default[$lang_key])) : trim($translations_default[$lang_key]);
    }

    // fallback to en lang
    if (!isset($translations_en[$lang_key])) {
        return trim($key);
    }

    return $addslashes ? addslashes(trim($translations_en[$lang_key])) : trim($translations_en[$lang_key]);
}

/**
 * frontend translate
 *
 * @param  mixed $key
 * @param  mixed $lang
 * @param  mixed $addslashes
 * @return mixed
 */
function front_translate($key, $lang = null, $addslashes = false)
{
    $active_theme = getActiveTheme();

    if ($lang == null) {
        $lang = session()->get('api_locale');
    }

    $lang_key = trim($key);

    $translations_en = Cache::rememberForever('front-translations-en', function () use ($active_theme) {
        return ThemeTranslations::where('lang', 'en')->where('theme', $active_theme->location)->pluck('lang_value', 'lang_key')->toArray();
    });


    if (!isset($translations_en[$lang_key])) {
        $translation_def = new ThemeTranslations();
        $translation_def->lang = 'en';
        $translation_def->theme = $active_theme->location;
        $translation_def->lang_key = $lang_key;
        $translation_def->lang_value = $lang_key;
        $translation_def->save();
        cache_clear();
    }

    // return user session lang
    $translation_locale = Cache::rememberForever("front-translations-{$lang}", function () use ($lang, $active_theme) {
        return ThemeTranslations::where('lang', $lang)->where('theme', $active_theme->location)->pluck('lang_value', 'lang_key')->toArray();
    });

    if (isset($translation_locale[$lang_key])) {
        return $addslashes ? addslashes(trim($translation_locale[$lang_key])) : trim($translation_locale[$lang_key]);
    }

    // return default lang if session lang not found
    $translations_default = Cache::rememberForever('front-translations-' . env('DEFAULT_LANGUAGE', 'en'), function () use ($active_theme) {
        return ThemeTranslations::where('lang', env('DEFAULT_LANGUAGE', 'en'))->where('theme', $active_theme->location)->pluck('lang_value', 'lang_key')->toArray();
    });

    if (isset($translations_default[$lang_key])) {
        return $addslashes ? addslashes(trim($translations_default[$lang_key])) : trim($translations_default[$lang_key]);
    }

    // fallback to en lang
    if (!isset($translations_en[$lang_key])) {
        return trim($key);
    }

    return $addslashes ? addslashes(trim($translations_en[$lang_key])) : trim($translations_en[$lang_key]);
}

/**
 * save keys for theme frontend
 * @param string $key
 */
function storeFrontendTranslation($key)
{
    $active_theme = getActiveTheme();
    $translation = ThemeTranslations::where('lang', 'en')->where('theme', $active_theme->location)->where('lang_key', trim($key))->first();

    if ($translation == null) {
        $new_translation = new ThemeTranslations;
        $new_translation->lang = 'en';
        $new_translation->theme = $active_theme->location;
        $new_translation->lang_key = trim($key);
        $new_translation->lang_value = trim($key);
        $new_translation->save();
    }
}

if (!function_exists('cache_clear')) {
    /**
     * cache clear
     *
     * @return void
     */
    function cache_clear()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
    }
}

if (!function_exists('errorMessage')) {
    /**
     * Redirect to error page
     *
     * @param  mixed $title
     * @param  mixed $message
     * @param  mixed $route
     * @return mixed
     */
    function errorMessage($title, $message, $route)
    {
        return response()->view(
            'core::base.errors.500',
            [
                'title' => $title,
                'message' => $message,
                'route' => $route
            ]
        );
    }
}

if (!function_exists('saveFileInStorage')) {
    /**
     * save file
     *
     * @param  mixed $file
     * @param  mixed $file_name
     * @param  mixed $location
     * @return mixed
     */
    function saveFileInStorage($file, $file_name, $location, $file_type, $media_type)
    {
        $full_path = $file->storeAs('/public/' . $location, $file_name);
        $path = $location . '/' . $file_name;

        $permission = substr(sprintf('%o', fileperms('public/storage/' . $location)), -4);
        if ($permission !== '0777') {
            chmod('public/storage/' . $location, 0777);
        }

        $exploded_file_name = explode('.', $file_name);
        $original_file_name = $exploded_file_name[0];
        $db_file = saveImageInfo($file, $full_path, $path, $location, $file_type, $media_type, $original_file_name);

        if ($file_type == 'image') {
            $cropping_sizes = getDefaultCroppingSizes($file, $location, $path, $original_file_name);
            $db_file->variant = json_encode($cropping_sizes);
            $db_file->update();
        }

        return $db_file->id;
    }
}

if (!function_exists('saveImageInfo')) {
    /**
     * get image info
     *
     * @return mixed
     */
    function saveImageInfo($file, $full_path, $path, $location, $type, $media_type, $original_file_name)
    {
        $uploaded_file = new UploadedFile();
        $uploaded_file->media_type = $media_type;
        $uploaded_file->name = $original_file_name;
        $uploaded_file->size = Storage::size($full_path);
        $uploaded_file->path = 'storage/' . $path;
        $uploaded_file->folder_name = 'storage/' . $location;
        $uploaded_file->file_type = $type;
        $uploaded_file->uploaded_by = Auth::user() != null ? Auth::user()->name : null;
        $uploaded_file->extension = $file->getClientOriginalExtension();
        $uploaded_file->saveOrFail();
        return $uploaded_file;
    }
}

if (!function_exists('getDefaultCroppingSizes')) {
    /**
     * get image info
     *
     * @return mixed
     */
    function getDefaultCroppingSizes($file, $location, $original_path, $original_file_name)
    {
        $file_name = $original_file_name;
        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $path = $location . '/' . $file_name . '.' . $extension;
        chmod('public/storage/' . $path, 0777);

        $large_thumb_image = DB::table('tl_general_settings_has_values')
            ->whereIn('settings_id', [
                getGeneralSettingId('large_thumb_image_width'),
                getGeneralSettingId('large_thumb_image_height')
            ])->pluck('value')->toArray();

        $large_thumb_image = sizeof($large_thumb_image) == 0 ? [1000, 1000] : $large_thumb_image;

        $path = $location . '/' . $file_name . implode('x', $large_thumb_image) . '.' . $extension;
        $img = Image::make('public/storage/' . $original_path)->fit($large_thumb_image[0], $large_thumb_image[1]);
        $img->save('public/storage/' . $path);
        chmod('public/storage/' . $path, 0777);

        $medium_thumb_image = DB::table('tl_general_settings_has_values')
            ->whereIn('settings_id', [
                getGeneralSettingId('medium_thumb_image_width'),
                getGeneralSettingId('medium_thumb_image_height')
            ])->pluck('value')->toArray();

        $medium_thumb_image = sizeof($medium_thumb_image) == 0 ? [700, 700] : $medium_thumb_image;

        $path = $location . '/' . $file_name . implode('x', $medium_thumb_image) . '.' . $extension;
        $img = Image::make('public/storage/' . $original_path)->fit($medium_thumb_image[0], $medium_thumb_image[1]);
        $img->save('public/storage/' . $path);
        chmod('public/storage/' . $path, 0777);

        $small_thumb_image = DB::table('tl_general_settings_has_values')
            ->whereIn('settings_id', [
                getGeneralSettingId('small_thumb_image_width'),
                getGeneralSettingId('small_thumb_image_height')
            ])->pluck('value')->toArray();

        $small_thumb_image = sizeof($small_thumb_image) == 0 ? [200, 200] : $small_thumb_image;


        $path = $location . '/' . $file_name . implode('x', $small_thumb_image) . '.' . $extension;
        $img = Image::make('public/storage/' . $original_path)->fit($small_thumb_image[0], $small_thumb_image[1]);
        $img->save('public/storage/' . $path);
        chmod('public/storage/' . $path, 0777);

        return [
            'large_size' => [$large_thumb_image[0], $large_thumb_image[1]],
            'medium_size' => [$medium_thumb_image[0], $medium_thumb_image[1]],
            'small_size' => [$small_thumb_image[0], $small_thumb_image[1]]
        ];
    }
}



if (!function_exists('removeMediaById')) {
    /**
     * Will remove single media by id
     * 
     * @param Int $media_id
     * @return bool
     */
    function removeMediaById($media_id)
    {
        try {
            DB::beginTransaction();
            $media = UploadedFile::find((int) $media_id);
            $exploded_location = explode('storage/', $media->path);
            Storage::delete($exploded_location[1]);
            $media->delete();
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }
}

if (!function_exists('getAllRole')) {
    /**
     * get all roles
     *
     * @return mixed
     */
    function getAllRole()
    {
        return Role::all();
    }
}

if (!function_exists('getAllRoleForAssign')) {
    /**
     * get all roles
     *
     * @return mixed
     */
    function getAllRoleForAssign()
    {
        return DB::table('roles')
            ->where('id', '!=', 1)
            ->select(['*'])->get();
    }
}

if (!function_exists('userHasRole')) {
    /**
     * get requested user role
     *
     * @return mixed
     */
    function userHasRole($user_id, $role_id)
    {
        return DB::table('model_has_roles')
            ->where('model_id', '=', $user_id)
            ->where('role_id', '=', $role_id)
            ->exists();
    }
}

if (!function_exists('getAllPermissions')) {
    /**
     * get all permissions
     *
     * @return mixed
     */
    function getAllPermissions()
    {
        return Permission::all();
    }
}

if (!function_exists('getPermissionsModules')) {
    /**
     * get all permission module
     *
     * @return mixed
     */
    function getPermissionsModules()
    {
        $active_theme = getActiveTheme();
        $modules = DB::table('permission_module')
            ->orderBy('permission_module.order')
            ->select([
                'id', 'module_name', 'parent_module', 'module_type', 'location'
            ])->get();

        $modules =  array_filter($modules->toArray(), function ($item) use ($active_theme) {
            if ($item->module_type == 'theme') {
                $theme_location =  $item->location;
                $theme = DB::table('tl_themes')->where('location', '=', $theme_location);
                if ($theme->exists()) {
                    return $theme->first()->id == $active_theme->id ? true : false;
                } else {
                    return false;
                }
            } else if ($item->module_type == 'plugin') {
                return isActivePluging($item->location);
            } else {
                return true;
            }
        });

        return array_values($modules);
    }
}

if (!function_exists('getPermissionsOfModule')) {
    /**
     * get all permissions of this module
     *
     * @return mixed
     */
    function getPermissionsOfModule($module_id)
    {
        return Permission::where('module_id', $module_id)->select('*')->get();
    }
}

if (!function_exists('hasPermissionInThisModule')) {
    /**
     * has permission in this module
     *
     * @return mixed
     */
    function hasPermissionInThisModule($module_id, $permission_name)
    {
        $permissions = Permission::where('module_id', $module_id)
            ->where('name', '=', $permission_name);

        if ($permissions->exists()) {
            return $permissions->first()->id;
        }
        return false;
    }
}


if (!function_exists('hasAllModulePermission')) {
    /**
     * check if user has all module permissions
     *
     * @return mixed
     */
    function hasAllModulePermission($module_id, $role_id)
    {
        $role = Role::find($role_id);
        $permissions = Permission::where('module_id', $module_id)->select('*')->get();
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('getLastPermissionId')) {
    /**
     * get last permission id
     *
     * @return int
     */
    function getLastPermissionId()
    {
        return Permission::latest()->first()->id;
    }
}


if (!function_exists('getAdminPrefix')) {
    /**
     * get admin dashboard prefix
     *
     * @return string
     */
    function getAdminPrefix()
    {
        return 'admin';
    }
}

if (!function_exists('getAllImageTypes')) {
    /**
     * get all image types
     *
     * @return void
     */
    function getAllImageTypes()
    {
        return DB::table('tl_media_type')->select([
            'id',
            'name'
        ])->get();
    }
}

if (!function_exists('getAllLanguages')) {
    /**
     * will return all languages
     *
     * @return mixed
     */
    function getAllLanguages()
    {
        return DB::table('tl_languages')
            ->select([
                'id', 'name', 'code', 'status'
            ])->get();
    }
}


if (!function_exists('getCurrencyPosition')) {
    /**
     * will return all currency position
     *
     * @return mixed
     */
    function getCurrencyPosition()
    {
        return config('settings.currency_position');
    }
}

if (!function_exists('getEcommerceEmailTemplates')) {
    /**
     * will return all amin email templates
     *
     * @return mixed
     */
    function getEcommerceEmailTemplates()
    {
        $templates = DB::table('tl_email_templates')
            ->join('tl_email_template_properties', 'tl_email_template_properties.email_type', '=', 'tl_email_templates.id')
            ->select([
                'tl_email_templates.module_name',
                'tl_email_templates.id as template_id',
                'tl_email_templates.name',
                'tl_email_templates.details',
                'tl_email_template_properties.subject',
                'tl_email_template_properties.body',
            ])->get();

        $structured_templates = [];

        for ($i = 0; $i < sizeof($templates); $i++) {
            if (!array_key_exists($templates[$i]->module_name, $structured_templates)) {
                $structured_templates[$templates[$i]->module_name] = [];
            }
            array_push($structured_templates[$templates[$i]->module_name], [
                'template_id' => $templates[$i]->template_id,
                'name' => $templates[$i]->name,
                'details' => $templates[$i]->details,
                'subject' => $templates[$i]->subject,
                'body' => $templates[$i]->body
            ]);
        }

        return $structured_templates;
    }
}

if (!function_exists('getTemplateBody')) {
    /**
     * will return all template body
     *
     * @return mixed
     */
    function getTemplateBody($template_id)
    {
        $body = DB::table('tl_email_template_properties')
            ->where('tl_email_template_properties.id', '=', $template_id)
            ->select([
                'body',
            ])->first();
        if ($body != null) {
            return $body;
        } else {
            return '';
        }
    }
}


if (!function_exists('getEmailTemplateOf')) {
    /**
     * will return all specific email template
     *
     * @return mixed
     */

    function getEmailTemplateOf($template_id, $data, $keywords)
    {
        $template = DB::table('tl_email_template_properties')
            ->where('email_type', $template_id)
            ->select([
                'body'
            ])->first();

        $body = $template->body;

        if ($body != null) {
            for ($i = 0; $i < sizeof($keywords); $i++) {
                $body = str_replace($keywords[$i], $data[$keywords[$i]], $body);
            }
        }

        if (!array_key_exists('_system_logo_url_', $data)) {
            $system_logo = asset(getFilePath(getGeneralSetting('admin_logo')));
            $body = str_replace('_system_logo_url_', $system_logo, $body);
        }
        if (!array_key_exists('_site_link_', $data)) {
            $body = str_replace('_site_link_', URL::to('/'), $body);
        }
        if (!array_key_exists('_footer_text_', $data)) {
            $copyright_text = getGeneralSetting('copyright_text');
            $body = str_replace('_footer_text_', $copyright_text, $body);
        }

        return $body;
    }
}

if (!function_exists('getGeneralSettingsDetails')) {
    /**
     * will return logo details
     *
     * @return mixed
     */

    function getGeneralSettingsDetails()
    {

        $data = [
            'tl_general_settings.name',
            'tl_general_settings_has_values.settings_id',
            'tl_general_settings_has_values.value',
            'tl_uploaded_files.path',
            'tl_uploaded_files.alt',
            'tl_uploaded_files.id as file_id'
        ];

        $media_settings_value = Cache::rememberForever('general-settings', function () use ($data) {
            $settings = new SettingsRepository();
            return $settings->getSettingsData($data);
        });

        $data = [];

        for ($i = 0; $i < sizeof($media_settings_value); $i++) {
            if ($media_settings_value[$i]->name == 'black_background_logo') {
                $data['black_background_logo'] = $media_settings_value[$i]->path;
                $data['black_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['black_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'white_background_logo') {
                $data['white_background_logo'] = $media_settings_value[$i]->path;
                $data['white_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['white_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'black_mobile_background_logo') {
                $data['black_mobile_background_logo'] = $media_settings_value[$i]->path;
                $data['black_mobile_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['black_mobile_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'white_mobile_background_logo') {
                $data['white_mobile_background_logo'] = $media_settings_value[$i]->path;
                $data['white_mobile_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['white_mobile_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'favicon') {
                $data['favicon'] = $media_settings_value[$i]->path;
                $data['favicon_alt'] = $media_settings_value[$i]->alt;
                $data['favicon_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'sticky_black_background_logo') {
                $data['sticky_black_background_logo'] = $media_settings_value[$i]->path;
                $data['sticky_black_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['sticky_black_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'sticky_black_mobile_background_logo') {
                $data['sticky_black_mobile_background_logo'] = $media_settings_value[$i]->path;
                $data['sticky_black_mobile_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['sticky_black_mobile_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'sticky_background_logo') {
                $data['sticky_background_logo'] = $media_settings_value[$i]->path;
                $data['sticky_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['sticky_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'sticky_mobile_background_logo') {
                $data['sticky_mobile_background_logo'] = $media_settings_value[$i]->path;
                $data['sticky_mobile_background_logo_alt'] = $media_settings_value[$i]->alt;
                $data['sticky_mobile_background_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'admin_logo') {
                $data['admin_logo'] = $media_settings_value[$i]->path;
                $data['admin_logo_alt'] = $media_settings_value[$i]->alt;
                $data['admin_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'admin_mobile_logo') {
                $data['admin_mobile_logo'] = $media_settings_value[$i]->path;
                $data['admin_mobile_logo_alt'] = $media_settings_value[$i]->alt;
                $data['admin_mobile_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'admin_dark_logo') {
                $data['admin_dark_logo'] = $media_settings_value[$i]->path;
                $data['admin_dark_logo_alt'] = $media_settings_value[$i]->alt;
                $data['admin_dark_logo_id'] = $media_settings_value[$i]->file_id;
            } elseif ($media_settings_value[$i]->name == 'admin_dark_mobile_logo') {
                $data['admin_dark_mobile_logo'] = $media_settings_value[$i]->path;
                $data['admin_dark_mobile_logo_alt'] = $media_settings_value[$i]->alt;
                $data['admin_dark_mobile_logo_id'] = $media_settings_value[$i]->file_id;
            } else {
                $data[$media_settings_value[$i]->name] = $media_settings_value[$i]->value;
            }
        }

        return $data;
    }
}

if (!function_exists('getPlaceHolderImage')) {
    /**
     * will return placeholder image
     *
     * @return mixed
     */

    function getPlaceHolderImage()
    {
        $default = new StdClass;
        $default->placeholder_image = null;
        $default->placeholder_image_alt = null;

        $data = DB::table('tl_general_settings_has_values')
            ->leftJoin('tl_uploaded_files', 'tl_uploaded_files.id', '=', 'tl_general_settings_has_values.value')
            ->where('settings_id', '=', getGeneralSettingId('placeholder_image'))
            ->select(['tl_uploaded_files.path as placeholder_image', 'tl_uploaded_files.alt as placeholder_image_alt'])
            ->first();

        if ($data == null) {
            return $default;
        }

        return $data;
    }
}

if (!function_exists('getChunkSize')) {
    /**
     * will return chunk size
     *
     * @return mixed
     */

    function getChunkSize()
    {
        $data = DB::table('tl_general_settings_has_values')
            ->where('settings_id', '=', getGeneralSettingId('maximum_chunk_size'))
            ->first('value');

        return $data;
    }
}

if (!function_exists('getFormatedDateTime')) {
    /**
     * will return formatted date time
     *
     * @return mixed
     */

    function getFormatedDateTime($date_time, $format)
    {
        return Carbon::parse($date_time)->format($format);
    }
}

if (!function_exists('getMonthsForUploadedFiles')) {
    /**
     * will return year-month list to filter uploaded files
     *
     * @return mixed
     */

    function getMonthsForUploadedFiles()
    {
        $startng_date = DB::table('tl_uploaded_files')
            ->select([
                'created_at as date'
            ])->first();

        $ending_date = DB::table('tl_uploaded_files')
            ->orderBy('id', 'desc')
            ->select([
                'created_at as date'
            ])->first();


        $data = [];

        if ($startng_date != null && $ending_date != null) {
            $result = CarbonPeriod::create($startng_date->date, '1 month', $ending_date->date);
            foreach ($result as $dt) {
                $data[$dt->format("m-Y")] = $dt->format("F-Y");
            }

            $todayDate = Carbon::now();
            $data[$todayDate->format("m-Y")] = $todayDate->format("F-Y");
        }
        return $data;
    }
}

if (!function_exists('getLocale')) {
    /**
     * return current language
     *
     * @return String
     */

    function getLocale()
    {
        $locale = 'en';
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        }
        return $locale;
    }
}

if (!function_exists('getDefaultLang')) {
    /**
     * return default language
     *
     * @return String
     */

    function getDefaultLang()
    {
        $lang = Cache::remember('default-lang', 3600, function () {
            return Language::where('id', getGeneralSetting('default_language'))->select(['id', 'code'])->first();
        });
        $local = $lang != null ? $lang->code : 'en';
        return $local;
    }
}

if (!function_exists('getFileDetails')) {
    /**
     * return uploaded file details
     *
     * @param Int $id
     * @return Collection
     */

    function getFileDetails($id)
    {
        return UploadedFile::find($id);
    }
}

if (!function_exists('getPlaceHolderImagePath')) {


    function getPlaceHolderImagePath()
    {
        $placeholder_info = getPlaceHolderImage();
        $placeholder_image = '';
        if ($placeholder_info != null) {
            $placeholder_image = $placeholder_info->placeholder_image;
            return fileStoragePath() . '/' . $placeholder_image;
        }
        return '/';
    }
}

if (!function_exists('getFilePath')) {
    /**
     * return uploaded file path
     *
     * @param bool $placeholder
     * @param Int $id
     * @return String
     */

    function getFilePath($id, $placeholder = true)
    {

        if (!$placeholder) {
            $file_path = Cache::rememberForever('file-path' . $id . '-' . $placeholder, function () use ($id) {
                $file_info = UploadedFile::select('path')->find($id);
                return $file_info != null ? fileStoragePath() . '/' . $file_info->path : null;
            });
        }

        if ($placeholder) {
            $file_path = Cache::rememberForever('file-path' . $id . '-' . $placeholder, function () use ($id) {
                $file_info = UploadedFile::select('path')->find($id);
                return $file_info != null ? fileStoragePath() . '/' . $file_info->path : getPlaceHolderImagePath();
            });
        }

        return $file_path;
    }
}

if (!function_exists('fileStoragePath')) {
    /**
     * return file storage base url
     *
     * 
     * @return String
     */

    function fileStoragePath()
    {
        return '/public';
    }
}

if (!function_exists('getAllMenuGroups')) {
    /**
     * return uploaded file path
     *
     * @param Int $id
     * @return String
     */

    function getAllMenuGroups()
    {
        return DB::table('tl_menu_groups')
            ->select([
                'id',
                'name'
            ])->get();
    }
}

if (!function_exists('getAllMenuItems')) {
    /**
     * return menu items
     */
    function getAllMenuItems()
    {
        return DB::table('tl_menu_items')
            ->join('tl_plugins', 'tl_plugins.location', '=', 'tl_menu_items.plugin_location')
            ->where('tl_plugins.is_activated', '=', config('settings.general_status.active'))
            ->select([
                'tl_menu_items.id',
                'tl_menu_items.template'
            ])->get();
    }
}

if (!function_exists('getAllMenuPositions')) {
    /**
     * return all menu positions
     *
     * @param Int $id
     * @return String
     */

    function getAllMenuPositions()
    {
        return DB::table('tl_themes')
            ->join('tl_menu_positions', 'tl_menu_positions.theme_id', 'tl_themes.id')
            ->where('tl_themes.is_activated', '=', 1)
            ->select([
                'tl_menu_positions.id',
                'tl_menu_positions.position'
            ])->get();
    }
}

if (!function_exists('getAllCategories')) {
    /**
     * return all categories
     *
     * @return String
     */
    function getAllCategories()
    {
        $all_cat = TlBlogCategory::where('is_publish', '=', '1')
            ->orderBy('id', 'desc')
            ->select([
                'id',
                'name',
                'permalink',
            ])->get();
        for ($i = 0; $i < sizeof($all_cat); $i++) {
            $permalink = $all_cat[$i]->permalink;
            $all_cat[$i]->permalink = "/blog/category/" . $permalink;
            $all_cat[$i]->preview_url = URL::to('/') . '/blog/category/' . $permalink;
        }
        return $all_cat;
    }
}

if (!function_exists('getAllRecentCategories')) {
    /**
     * return all categories
     * @return String
     */
    function getAllRecentCategories()
    {
        $all_recent_cat = TlBlogCategory::where('is_publish', '=', '1')
            ->orderBy('id', 'desc')
            ->select([
                'id',
                'name',
                'permalink',
            ])->take(3)->get();

        for ($i = 0; $i < sizeof($all_recent_cat); $i++) {
            $permalink = $all_recent_cat[$i]->permalink;
            $all_recent_cat[$i]->permalink = "/blog/category/" . $permalink;
            $all_recent_cat[$i]->preview_url = URL::to('/') . '/blog/category/' . $permalink;
        }
        return $all_recent_cat;
    }
}

if (!function_exists('getAllPosts')) {
    /**
     * Get ALl posts
     */
    function getAllPosts()
    {
        $all_blogs = TlBlog::where([
            ['publish_at', '<', currentDateTime()],
            ['is_publish', '=', config('settings.blog_status.publish')],
            ['visibility', '!=', 'private'],
        ])
            ->orderByDesc('id')
            ->select([
                'id',
                'name',
                'permalink'
            ])->get();

        for ($i = 0; $i < sizeof($all_blogs); $i++) {
            $permalink = $all_blogs[$i]->permalink;
            $all_blogs[$i]->permalink = "/blog/" . $permalink;
            $all_blogs[$i]->preview_url = URL::to('/') . "/blog/" . $permalink;
        }

        return $all_blogs;
    }
}

if (!function_exists('getAllRecentPosts')) {
    /**
     * Get all recent post
     */
    function getAllRecentPosts()
    {
        $all_recent_blogs = TlBlog::where([
            ['publish_at', '<', currentDateTime()],
            ['is_publish', '=', config('settings.blog_status.publish')],
            ['visibility', '!=', 'private'],
        ])
            ->orderByDesc('id')
            ->select([
                'id',
                'name',
                'permalink'
            ])->take(3)->get();

        for ($i = 0; $i < sizeof($all_recent_blogs); $i++) {
            $permalink = $all_recent_blogs[$i]->permalink;
            $all_recent_blogs[$i]->permalink = "/blog/" . $permalink;
            $all_recent_blogs[$i]->preview_url = URL::to('/') . "/blog/" . $permalink;
        }
        return $all_recent_blogs;
    }
}

if (!function_exists('getAllPages')) {
    /**
     * Get All pages
     */
    function getAllPages()
    {
        $all_page = TlPage::where([
            ['publish_at', '<', currentDateTime()],
            ['visibility', '!=', 'private'],
            ['publish_status', '=',  config('settings.page_status.publish')],
        ])
            ->orderByDesc('id')
            ->select([
                'id',
                'title as name',
                'permalink'
            ])->get();

        for ($i = 0; $i < sizeof($all_page); $i++) {

            $singlePage = TlPage::where('id', $all_page[$i]->id)->first();
            $parentUrl = getParentUrl($singlePage);

            $permalink = $all_page[$i]->permalink;
            $all_page[$i]->permalink = '/page/' . $parentUrl . $permalink;
            $all_page[$i]->preview_url = URL::to('/page/' . $parentUrl . $permalink);
        }

        return $all_page;
    }
}

if (!function_exists('getAllRecentPages')) {
    /**
     * Get all recent pages
     */
    function getAllRecentPages()
    {
        $all_recent_page = TlPage::where([
            ['publish_at', '<', currentDateTime()],
            ['visibility', '!=', 'private'],
            ['publish_status', '=',  config('settings.page_status.publish')],
        ])
            ->orderByDesc('id')
            ->select([
                'id',
                'title as name',
                'permalink'
            ])
            ->take(3)->get();

        for ($i = 0; $i < sizeof($all_recent_page); $i++) {
            //getting the parent url
            $singlePage = TlPage::where('id', $all_recent_page[$i]->id)->first();
            $parentUrl = getParentUrl($singlePage);

            $permalink = $all_recent_page[$i]->permalink;
            $all_recent_page[$i]->permalink = '/page/' . $parentUrl . $permalink;
            $all_recent_page[$i]->preview_url = URL::to('/page/' . $parentUrl . $permalink);
        }
        return $all_recent_page;
    }
}

if (!function_exists('getAllTags')) {
    /**
     * Get All tags
     */
    function getAllTags()
    {
        $all_tags = TlBlogTag::where([
            ['is_publish', '=', '1']
        ])
            ->orderByDesc('id')
            ->select([
                'id',
                'name',
                'permalink',
            ])->get();

        for ($i = 0; $i < sizeof($all_tags); $i++) {
            $permalink = $all_tags[$i]->permalink;
            $all_tags[$i]->permalink = "/blog/tag/" . $permalink;
            $all_tags[$i]->preview_url = URL::to('/') . "/blog/tag/" . $permalink;
        }

        return $all_tags;
    }
}

if (!function_exists('getAllRecentTags')) {
    /**
     * Get all recent tags
     */
    function getAllRecentTags()
    {
        $all_recent_tags = TlBlogTag::where([
            ['is_publish', '=', '1']
        ])
            ->orderByDesc('id')
            ->select([
                'id',
                'name',
                'permalink',
            ])->take(3)->get();

        for ($i = 0; $i < sizeof($all_recent_tags); $i++) {
            $permalink = $all_recent_tags[$i]->permalink;
            $all_recent_tags[$i]->permalink = "/blog/tag/" . $permalink;
            $all_recent_tags[$i]->preview_url = URL::to('/') . "/blog/tag/" . $permalink;
        }

        return $all_recent_tags;
    }
}

if (!function_exists('getMenuGroupOnThisPosition')) {
    /**
     * return all menu positions
     *
     * @param Int $id
     * @return String
     */

    function getMenuGroupOnThisPosition($position_id)
    {
        return DB::table('tl_menu_groups')
            ->join('tl_menu_group_has_positon', 'tl_menu_group_has_positon.menu_group_id', 'tl_menu_groups.id')
            ->where('tl_menu_group_has_positon.menu_position_id', '=', $position_id)
            ->select([
                'tl_menu_groups.id',
                'tl_menu_groups.name'
            ])->first();
    }
}

if (!function_exists('setActivityLog')) {
    /**
     * will update activity log
     *
     * @param  mixed $position_id
     * @param  mixed $log_message
     */
    function setActivityLog($performed_on, $log_message)
    {
        activity()
            ->causedBy(Auth::user())
            ->performedOn($performed_on)
            ->log($log_message);

        $user_ip_address = getUserIpAddr();
        $os = get_operating_system();
        $browser = get_browser_name();
        $url = request()->url();

        $last_insertable_activity_log_id = DB::table('activity_log')->orderBy('id', 'desc')->select(['id'])->first();

        $log = ActivityLog::find((int)$last_insertable_activity_log_id->id);
        $log->ip = $user_ip_address;
        $log->os = $os;
        $log->browser = $browser;
        $log->url = $url;
        $log->update();

        return $log;
    }
}

if (!function_exists('get_browser_name')) {
    /**
     * will return currently used browser name
     */
    function get_browser_name()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)
            return 'Internet explorer';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)
            return 'Internet explorer';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
            return 'Mozilla Firefox';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
            return 'Google Chrome';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false)
            return "Opera Mini";
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== false)
            return "Opera";
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
            return "Safari";
        else
            return 'Other';
    }
}

if (!function_exists('get_operating_system')) {
    /**
     * will return  operating system name
     */
    function get_operating_system()
    {
        $u_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $operating_system = 'Unknown Operating System';

        if ($u_agent) {
            if (preg_match('/linux/i', $u_agent)) {
                $operating_system = 'Linux';
            } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
                $operating_system = 'Mac';
            } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
                $operating_system = 'Windows';
            } elseif (preg_match('/ubuntu/i', $u_agent)) {
                $operating_system = 'Ubuntu';
            } elseif (preg_match('/iphone/i', $u_agent)) {
                $operating_system = 'IPhone';
            } elseif (preg_match('/ipod/i', $u_agent)) {
                $operating_system = 'IPod';
            } elseif (preg_match('/ipad/i', $u_agent)) {
                $operating_system = 'IPad';
            } elseif (preg_match('/android/i', $u_agent)) {
                $operating_system = 'Android';
            } elseif (preg_match('/blackberry/i', $u_agent)) {
                $operating_system = 'Blackberry';
            } elseif (preg_match('/webos/i', $u_agent)) {
                $operating_system = 'Mobile';
            }
        } else {
            $operating_system = php_uname('s');
        }
        return $operating_system;
    }
}

if (!function_exists('getUserIpAddr')) {
    /**
     * get user ip address
     */
    function getUserIpAddr()
    {
        //Check if visitor is from shared network 
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $vIP = $_SERVER['HTTP_CLIENT_IP'];
        }
        //Check if visitor is using a proxy 
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $vIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //check for the remote address of visitor.  
        else {
            $vIP = $_SERVER['REMOTE_ADDR'];
        }
        return $vIP;
    }
}

if (!function_exists('getTranslatedMenuTitleByLangId')) {
    /**
     * return translated menu title 
     * 
     * @return String
     */

    function getTranslatedMenuTitleByLangId($menu_id, $lang_id, $translated_title)
    {
        $lang = Language::find($lang_id);
        if ($lang != null) {
            $menu = DB::table('tl_menu_translations')
                ->where('menu_id', '=', (int)$menu_id)
                ->where('lang', '=', $lang->code);

            if ($menu->exists()) {
                return $menu->first()->name;
            }
        }
        return $translated_title;
    }
}

if (!function_exists('getTranslatedMenuTitle')) {
    /**
     * return translated menu title 
     * 
     * @return String
     */

    function getTranslatedMenuTitle($menu_id, $lang_code, $translated_title)
    {
        if ($lang_code != null) {
            $menu = DB::table('tl_menu_translations')
                ->where('menu_id', '=', (int)$menu_id)
                ->where('lang', '=', $lang_code);


            if ($menu->exists()) {
                return $menu->first()->name;
            }
        }
        return $translated_title;
    }
}

if (!function_exists('project_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function project_asset($path, $secure = null)
    {
        return app('url')->asset("/public/" . $path, $secure);
    }
}

if (!function_exists('getGeneralSetting')) {
    /**
     * Get general settings value
     *
     * @param String $settings_name
     * @param bool $has_multiple
     * @return mixed
     */
    function getGeneralSetting($settings_name, $has_multiple = NULL)
    {
        $setting = GeneralSettings::firstOrCreate(['name' => $settings_name]);
        if ($has_multiple != NULL) {
            return GeneralSettingsHasValue::where('settings_id', $setting->id)->pluck('value');
        } else {
            $value = GeneralSettingsHasValue::where('settings_id', $setting->id)->first();
            if ($value != null) {
                return $value->value;
            } else {
                return null;
            }
        }
    }
}

if (!function_exists('getGeneralSettingId')) {
    /**
     * Get general settings id
     *
     * @param String $settings_name
     * @param bool $has_multiple
     * @return mixed
     */
    function getGeneralSettingId($settings_name)
    {
        $setting = GeneralSettings::firstOrCreate(['name' => $settings_name]);
        return $setting->id;
    }
}

if (!function_exists('getGeneralSettingIdAsArray')) {
    /**
     * Get general settings id
     *
     * @param String $settings_name
     * @param bool $has_multiple
     * @return mixed
     */
    function getGeneralSettingIdAsArray($settings_name)
    {
        $all_settings_name = config('settings.' . $settings_name);
        $ids = [];
        for ($i = 0; $i < sizeof($all_settings_name); $i++) {
            $ids[$i] = getGeneralSettingId($all_settings_name[$i]);
        }
        return $ids;
    }
}

if (!function_exists('getGeneralSettingNameAsArray')) {
    /**
     * Get general settings id
     *
     * @param String $settings_name
     * @param bool $has_multiple
     * @return mixed
     */
    function getGeneralSettingNameAsArray($settings_name)
    {
        $all_settings_name = config('settings.' . $settings_name);
        $names = [];
        $ids = [];
        for ($i = 0; $i < sizeof($all_settings_name); $i++) {
            $ids[$i] = getGeneralSettingId($all_settings_name[$i]);
            $names[$i] = $all_settings_name[$i];
        }
        return $names;
    }
}

if (!function_exists('getMenuPositionId')) {
    /**
     * Get menu position id
     *
     * @param String $position_name
     * @return mixed
     */
    function getMenuPositionId($position_name)
    {
        $menu_position = DB::table('tl_menu_positions')
            ->where('position', '=', $position_name);
        if (!$menu_position->exists()) {
            $active_theme = getActiveTheme();
            $position = new MenuPosition();
            $position->position = $position_name;
            $position->theme_id = $active_theme->id;
            $position->saveOrFail();
            return $position->id;
        }
        return $menu_position->first()->id;
    }
}

if (!function_exists('saveMenuPositionName')) {
    /**
     * save menu positions name a array
     *
     * @param String $position_names
     * @return mixed
     */
    function saveMenuPositionName($position_names)
    {
        $all_position_name = config('settings.' . $position_names);
        for ($i = 0; $i < sizeof($all_position_name); $i++) {
            getMenuPositionId($all_position_name[$i]);
        }
    }
}

if (!function_exists('xss_clean')) {
    /**
     * get the filtered text
     * @return mixed|string
     */
    function xss_clean($data)
    {
        // Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);
        // we are done...
        return $data;
    }
}


//---- Blog & Page ----//

if (!function_exists('getReadingTime')) {
    /**
     * Return Reading Time of the content
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function getReadingTime($content)
    {
        // estimating reading time for blog content
        Str::macro('readDuration', function (...$body) {
            $totalWords = str_word_count(implode(" ", $body));
            $minutesToRead = round($totalWords / 200);

            return (int)max(1, $minutesToRead);
        });

        return Str::readDuration($content) . ' ' . front_translate('min read');
    }
}

if (!function_exists('makeTitleTag')) {
    /**
     * making title tag
     * @param $tag Html Tag
     * @param $title title text
     * @param $class tag class
     * @return mixed|string
     */
    function makeTitleTag($tag = '', $title = '', $class = '')
    {
        if ($tag != '') {
            return "<" . $tag . " class='" . $class . "'>" . xss_clean($title) . "</" . $tag . ">";
        }
    }
}

if (!function_exists('setEnv')) {
    /**
     * update env value
     * @param $name KeyName
     * @param $value Key Value
     * @return void
     */
    function setEnv($name, $value)
    {
        $value = xss_clean(str_replace(' ', '', $value));
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name),
                $name . '=' . $value,
                file_get_contents($path)
            ));
        }
    }
}

if (!function_exists('getPage')) {

    /**
     * get page
     * @return mixed|array
     */
    function getPage($match_case = [], $search_key = '')
    {
        $pages = TlPage::join('tl_users', 'tl_users.id', '=', 'tl_pages.user_id')
            ->orderBy('tl_pages.id', 'desc')
            ->groupBy('tl_pages.id')
            ->where($match_case);

        $pages = $pages->where(function ($query) use ($search_key) {
            $query->where('tl_pages.title', 'like', '%' . $search_key . '%')
                ->orWhere('tl_pages.visibility', 'like', '%' . $search_key . '%')
                ->orWhere('tl_pages.content', 'like', '%' . $search_key . '%')
                ->orWhere('tl_users.name', 'like', '%' . $search_key . '%');
        });

        $pages = $pages->select(
            DB::raw('GROUP_CONCAT(distinct tl_pages.id) as id'),
            DB::raw('GROUP_CONCAT(distinct tl_pages.title) as title'),
            DB::raw('GROUP_CONCAT(distinct tl_pages.permalink) as permalink'),
            DB::raw('GROUP_CONCAT(distinct tl_pages.page_image) as page_image'),
        )->get();
        return $pages;
    }
}

if (!function_exists('getParentUrl')) {
    /**
     * making the parent url if there has any
     * @return mixed|array
     */
    function getParentUrl($page)
    {
        $pageUrl = '';
        $parent = $page->parentPage;
        return makeUrl($parent, $pageUrl);
    }
}

if (!function_exists('makeUrl')) {
    /**
     * making url function
     * @return mixed|array
     */
    function makeUrl($parent, $pageUrl)
    {
        if ($parent != null) {
            $pageUrl = $parent->permalink . '/' . $pageUrl;
            $grandParent = $parent->parentPage;
            return makeUrl($grandParent, $pageUrl);
        } else {
            return $pageUrl;
        }
    }
}

if (!function_exists('getBlogCategory')) {

    /**
     *Frontend Blog Categories
     * @return mixed|array
     */
    function getBlogCategory($id)
    {
        // initialize Blog Repository
        $blog_repository = new BlogRepository();
        $blog_category = $blog_repository->getBlogCategory($id);
        return $blog_category;
    }
}

if (!function_exists('getCommentCount')) {

    /**
     *comment count
     * @return integer
     */
    function getCommentCount($match_case = ['*'], $search_key = '')
    {
        $comments = DB::table('tl_blog_comments')
            ->leftJoin('tl_blogs', 'tl_blogs.id', '=', 'tl_blog_comments.blog_id')
            ->where($match_case);

        $comments = $comments->where(function ($query) use ($search_key) {
            $query->where('tl_blog_comments.user_name', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blog_comments.user_email', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blog_comments.user_website', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blog_comments.comment', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blogs.name', 'like', '%' . $search_key . '%');
        });

        $comments = $comments->get();

        return count($comments);
    }
}

if (!function_exists('getBlogCount')) {

    /**
     * blog count by specific condition and search key
     * @return mixed|array
     */
    function getBlogCount($match_case = [], $search_key = '')
    {
        $blogs = DB::table('tl_blogs')
            ->join('tl_users', 'tl_users.id', '=', 'tl_blogs.user_id')
            ->leftJoin('tl_blogs_categories', 'tl_blogs_categories.blog_id', '=', 'tl_blogs.id')
            ->leftJoin('tl_blog_categories', 'tl_blog_categories.id', '=', 'tl_blogs_categories.category_id')
            ->groupBy('tl_blogs.id')
            ->orderBy('tl_blogs.id', 'desc')
            ->where($match_case);

        $blogs = $blogs->where(function ($query) use ($search_key) {
            $query->where('tl_blogs.name', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blog_categories.name', 'like', '%' . $search_key . '%')
                ->orWhere('tl_blogs.content', 'like', '%' . $search_key . '%')
                ->orWhere('tl_users.name', 'like', '%' . $search_key . '%');
        });

        $blogs = $blogs->select([
            DB::raw('GROUP_CONCAT(distinct tl_blogs.id) as id'),
        ])->get();

        return count($blogs);
    }
}

if (!function_exists('currentDateTime')) {
    /**
     ** Current Time
     * @return DateTime
     */
    function currentDateTime()
    {
        return Carbon::now();
    }
}

if (!function_exists('getCategory')) {
    /**
     *Get Category
     * @return integer
     */
    function getCategory($match_case = [], $search_key = '')
    {

        $categories = TlBlogCategory::where($match_case)->where('tl_blog_categories.name', 'LIKE', '%' . $search_key . '%')
            ->leftJoin('tl_uploaded_files', 'tl_uploaded_files.id', '=', 'tl_blog_categories.icon')
            ->select(
                'tl_blog_categories.id',
                'tl_blog_categories.name',
                'tl_blog_categories.permalink',
                'tl_blog_categories.icon',
                'tl_uploaded_files.path',
                'tl_uploaded_files.alt',
            )
            ->orderBy('tl_blog_categories.id', 'desc')->get();
        return $categories;
    }
}

if (!function_exists('getTag')) {

    /**
     * Get Tag
     * @return integer
     */
    function getTag($match_case = [], $search_key = '')
    {
        $tags = TlBlogTag::where($match_case)->where('tl_blog_tags.name', 'LIKE', '%' . $search_key . '%')
            ->select(
                'tl_blog_tags.id',
                'tl_blog_tags.name',
                'tl_blog_tags.permalink',
            )
            ->orderBy('tl_blog_tags.id', 'desc')->get();

        return $tags;
    }
}

if (!function_exists('commentFormSettings')) {

    /**
     ** get all Comment Settings
     * @return array
     */
    function commentFormSettings()
    {

        $settings = Cache::rememberForever('comment-setting', function () {
            $data = [
                'tl_general_settings.name',
                'tl_general_settings_has_values.settings_id',
                'tl_general_settings_has_values.value',
            ];
            $settings_repository = new SettingsRepository;
            $setting_array = array_merge(getGeneralSettingNameAsArray('blog_comment_general_settings_name'), getGeneralSettingNameAsArray('blog_comment_other_settings_name'));
            $comment_settings_value = $settings_repository->getSettingsData($data);
            $data = [];

            for ($i = 0; $i < sizeof($comment_settings_value); $i++) {
                if (in_array($comment_settings_value[$i]->name, $setting_array)) {
                    $data[$comment_settings_value[$i]->name] = $comment_settings_value[$i]->value;
                } else {
                    $data[$comment_settings_value[$i]->name] = null;
                }
            }
            return $data;
        });

        return $settings;
    }
}

if (!function_exists('getMenuStructure')) {
    /**
     * get menu structure to show in frontend
     * @return mixed|array
     */
    function getMenuStructure($position_id)
    {
        $menu_repo = new MenuRepository();
        $menu_structure = $menu_repo->getMenuStructureForView($position_id);
        return $menu_structure;
    }
}

if (!function_exists('getEmailTemplateVariables')) {
    /**
     * get menu structure to show in frontend
     * @return mixed|array
     */
    function getEmailTemplateVariables($template_id, $only_name = false)
    {
        if (!$only_name) {
            return DB::table('tl_email_template_variable')
                ->where('template_id', '=', (int)$template_id)
                ->select([
                    'name',
                    'details'
                ])->get();
        } else {
            return DB::table('tl_email_template_variable')
                ->where('template_id', '=', (int)$template_id)
                ->pluck('name');
        }
    }
}

if (!function_exists('saveMenuPositionNameByTheme')) {
    /**
     * save menu positions name by theme
     * @param String $position_names
     * @return mixed
     */
    function saveMenuPositionNameByTheme($position_names)
    {
        $active_theme = getActiveTheme();
        $all_position_name = config($active_theme->location . '.' . $position_names);
        for ($i = 0; $i < sizeof($all_position_name); $i++) {
            getMenuPositionId($all_position_name[$i]);
        }
    }
}

if (!function_exists('createDefaultCategory')) {
    /**
     * save a default category
     * @return void
     */
    function createDefaultCategory()
    {
        $category = TlBlogCategory::where('permalink', 'uncategorized');
        if (!$category->exists()) {
            TlBlogCategory::create([
                'name' => 'Uncategorized',
                'permalink' => 'uncategorized',
                'is_publish' => 1
            ]);
        }
    }
}

if (!function_exists('getAllActiveLanguages')) {
    /**
     * will return all active languages
     *
     * @return mixed
     */
    function getAllActiveLanguages()
    {
        return DB::table('tl_languages')
            ->where(['status' => config('settings.general_status.active')])
            ->select([
                'id', 'code', 'native_name'
            ])->get();
    }
}

if (!function_exists('getImageVariation')) {
    /**
     * get all the variation for image
     * @param int $id
     * @param array
     */
    function getImageVariation($id, $type = 'small')
    {
        $media = Cache::rememberForever('variation-file-' . $id, function () use ($id) {
            return UploadedFile::find($id);
        });

        if ($media != null) {
            $data = json_decode($media->variant, true);
            $file_name = fileStoragePath() . '/' . $media->folder_name . '/' . $media->name;

            if ($type === 'small') {
                $file = $file_name . $data['small_size'][0] . 'x' . $data['small_size'][1] . '.' . $media->extension;
            } else if ($type === 'medium') {
                $file = $file_name . $data['medium_size'][0] . 'x' . $data['medium_size'][1] . '.' . $media->extension;
            } else if ($type === 'large') {
                $file = $file_name . $data['large_size'][0] . 'x' . $data['large_size'][1] . '.' . $media->extension;
            }
        } else {
            $file = getPlaceHolderImagePath();
        }

        $file = asset($file);
        return $file;
    }
}

if (!function_exists('getLanguageNameByCode')) {
    /**
     * get language name
     * @return mixed|array
     */
    function getLanguageNameByCode($code)
    {
        $lang = Language::where('code', $code)->select('name')->first();
        return $lang != null ? $lang->name : 'Invalid Language';
    }
}

if (!function_exists('fix_image_urls')) {
    /**
     * fixed content image url
     * @return mixed|string
     */
    function fix_image_urls($content, $domain = 'add')
    {
        $baseUrl = url('/');
        $baseUrl = rtrim($baseUrl, '/');
        if ($domain == 'add') {
            $content = preg_replace('/(src|href)="\/(?!\/)/', '$1="' . $baseUrl . '/$2', $content);
        } else {
            $content = preg_replace('/(src|href)="' . preg_quote($baseUrl, '/') . '\//', '$1="/', $content);
        }
        return $content;
    }
}
