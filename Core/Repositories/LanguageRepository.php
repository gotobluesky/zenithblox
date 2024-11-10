<?php

namespace Core\Repositories;

use Core\Models\Language;
use Illuminate\Support\Str;
use Core\Models\Translations;
use Core\Models\ThemeTranslations;
use Illuminate\Support\Facades\DB;

class LanguageRepository
{
    /**
     * Get all language
     * 
     * @return Collection
     */
    public function allLanguages($status = null)
    {
        $status = $status == false ? [2, 1] : $status;
        return Language::whereIn('status', $status)->get();
    }
    /**
     * Change rtl
     * 
     * @param Int $id
     * @return boolean
     */
    public function changeRtl($id)
    {
        try {
            DB::beginTransaction();
            $language = Language::findOrFail($id);
            $status = 1;
            if ($language->is_rtl === 1) {
                $status = 2;
            }
            $language->is_rtl = $status;
            $language->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    /**
     * Change Status
     * 
     * @param Int $id
     * @return boolean
     */
    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $language = Language::findOrFail($id);
            if ($language->status == 1 && ($language->code == 'en' || $language->code == getDefaultLang()) ) {
                toastNotification('error', translate('You can not inactive this language'), 'Failed');
            } else {
                $status = $language->status === 1 ? 2 : 1;
                $language->status = $status;
                $language->save();
                toastNotification('success', translate('Language status updated successfully'), 'Success');
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', 'Action failed', 'Failed');
            return false;
        }
    }
    /**
     * Return language translate keys
     */
    public function languageTranslations($request)
    {
        $lang_keys = Translations::where('lang', 'en');
        if ($request->has('search_key') && $request['search_key'] != null) {
            $lang_keys = $lang_keys->where('lang_key', 'like', '%' . preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($request['search_key']))) . '%');
        }
        $lang_keys = $lang_keys->paginate(20);
        return $lang_keys;
    }
    /**
     * Return language frontend translate keys
     */
    public function frontendTranslations($request, $theme)
    {
        $lang_keys = ThemeTranslations::where('lang', 'en')->where('theme', $theme);
        if ($request->has('search_key') && $request['search_key'] != null) {
            $lang_keys = $lang_keys->where('lang_key', 'like', '%' . preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($request['search_key']))) . '%');
        }
        $lang_keys = $lang_keys->orderBy('id','desc')->paginate(20);
        return $lang_keys;
    }
    /**
     * Update language translations
     * 
     * @param  $request
     * @return void
     */
    public function updateTranslation($request)
    {
        try {
            DB::beginTransaction();
            $language = Language::findOrFail($request->id);
            foreach ($request->values as $key => $value) {
                $translate = Translations::where('lang_key', $key)->where('lang', $language->code)->latest()->first();
                if ($translate == null) {
                    $translate = new Translations;
                    $translate->lang = $language->code;
                    $translate->lang_key = xss_clean($key);
                    $translate->lang_value = xss_clean($value);
                    $translate->save();
                } else {
                    $translate->lang_value = xss_clean($value);
                    $translate->save();
                }
            }
            DB::commit();
            cache_clear();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return  false;
        }
    }
    /**
     * Update frontend language translations
     * 
     * @param  $request
     * @return void
     */
    public function updateFrontendTranslation($request)
    {
        try {
            DB::beginTransaction();
            $language = Language::findOrFail($request->id);
            foreach ($request->values as $key => $value) {
                $translate = ThemeTranslations::where('lang_key', $key)->where('theme', $request['theme'])->where('lang', $language->code)->latest()->first();
                if ($translate == null) {
                    $translate = new ThemeTranslations();
                    $translate->lang = $language->code;
                    $translate->lang_key = xss_clean($key);
                    $translate->lang_value = xss_clean($value);
                    $translate->theme = $request['theme'];
                    $translate->save();
                } else {
                    $translate->lang_value = xss_clean($value);
                    $translate->save();
                }
            }
            DB::commit();
            cache_clear();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return  false;
        }
    }
    /**
     * Store new language
     * 
     * @param Array $request
     * 
     * @return boolean
     */
    public function storeNewlanguage($request)
    {
        try {
            DB::beginTransaction();
            $lan = new Language;
            $lan->name = xss_clean($request['name']);
            $lan->code = xss_clean($request['code']);
            $lan->native_name = xss_clean($request['native_name']);
            $lan->status = 1;
            $lan->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return errorMessage('Failed', 'Unable to store new language', '#');
        }
    }
    /**
     * Get Language Details
     * 
     * @param Int $id
     * @return Object
     */
    public function languageDetails($id)
    {
        return Language::findOrFail($id);
    }
    /**
     * Update language
     * 
     * @param Array $request
     * 
     */
    public function updatelanguage($request)
    {
        try {
            DB::beginTransaction();
            Language::where('id', $request['id'])
                ->update([
                    'name' => xss_clean($request['name']),
                    'code' => xss_clean($request['code']),
                    'native_name' => xss_clean($request['native_name']),
                ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    /**
     * Delete Language
     * 
     * @param Int $id
     * @return void
     */
    public function deleteLanguage($id)
    {
        try {
            DB::beginTransaction();
            $code = Language::where('id', $id)->value('code');
            if ($code == 'en' || $code == getDefaultLang() ) {
                toastNotification('error', translate('Can not delete English and Default language'), 'Failed');
            } else {
                Language::where('id', $id)->delete();
                toastNotification('success', translate('Language deleted successfully'), 'Success');
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', 'Action Failed', 'Failed');
        }
    }
}
