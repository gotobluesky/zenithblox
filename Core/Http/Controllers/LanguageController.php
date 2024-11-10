<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Core\Models\ThemeTranslations;
use App\Http\Controllers\Controller;
use Core\Http\Requests\LanguageRequest;
use Core\Repositories\LanguageRepository;

class LanguageController extends Controller
{

    protected $language_repository;

    public function __construct(LanguageRepository $language_repository)
    {
        $this->language_repository = $language_repository;
    }

    /**
     * Return all languages
     * 
     * @return mixed
     */
    public function allLanguages()
    {
        return view('core::base.language.index')->with(
            [
                'languages' => $this->language_repository->allLanguages()
            ]
        );
    }
    /**
     * Chenge language
     * 
     * @return void
     */
    public function changeLanguage(Request $request)
    {
        cache_clear();
        $request->session()->put('locale', $request->lang);
    }
    /**
     * Change language rtl
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function changeLanguageRtl(Request $request)
    {
        $res = $this->language_repository->changeRtl($request->id);
        if ($res == true) {
            toastNotification('success', translate('RTL status updated successfully'));
        } else {
            toastNotification('error', translate('Action failed'), 'Failed');
        }
    }
    /**
     * Change language status
     * 
     * @return \Illuminate\Http\Request $request
     * @return mixed
     */
    public function changeLanguageStatus(Request $request)
    {
        return $this->language_repository->changeStatus($request->id);
    }
    /**
     * Load new language form
     * 
     * @return mixed
     */
    public function newLanguage()
    {

        return view('core::base.language.new_language');
    }
    /**
     * Store new language
     * 
     * @param 
     * @return mixed
     */
    public function storeNewLanguage(LanguageRequest $request)
    {
        $res = $this->language_repository->storeNewLanguage($request);
        if ($res == true) {
            toastNotification('success', translate('New language added successfully'), 'Success');
            return redirect()->route('core.languages');
        }
    }
    /**
     * Edit Language
     * 
     * @param Int $id
     * @return mixed
     */
    public function editLanguage($id)
    {

        $lang = $this->language_repository->languageDetails($id);
        return view('core::base.language.edit_language', compact('lang'));
    }
    /**
     * Update language
     * 
     * @param LanguageRequest
     * @return mixed
     */
    public function updateLanguage(LanguageRequest $request)
    {
        $res = $this->language_repository->updateLanguage($request);
        if ($res == true) {
            toastNotification('success', translate('Language updated successfully'), 'Success');
            return redirect()->route('core.languages');
        } else {
            toastNotification('error', translate('Update failed'), 'Failed');
            return redirect()->back();
        }
    }
    /**
     * Delete language
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function deleteLanguage(Request $request)
    {
        $this->language_repository->deleteLanguage($request->id);
        return redirect()->back();
    }
    /**
     * Get language key values
     * 
     * @param \Illuminate\Http\Request $request
     * @param Int $id
     * @return mixed
     */
    public function languageKeyValues(Request $request, $id)
    {
        $language = $this->language_repository->languageDetails($id);

        $lang_keys = $this->language_repository->languageTranslations($request);
        return view('core::base.language.lan_key_values')->with(
            [
                'language' => $language,
                'lang_keys' => $lang_keys,
            ]
        );
    }
    /**
     * Will return frontend translations
     * 
     * @param \Illuminate\Http\Request $request
     * @param Int $id
     * @return mixed
     */
    public function frontendTranslations(Request $request, $id)
    {
        $active_theme = getActiveTheme();
        if ($active_theme != null) {
            $language = $this->language_repository->languageDetails($id);
            $sort_search = null;
            if ($request->has('search')) {
                $sort_search = $request->search;
            }
            $lang_keys = $this->language_repository->frontendTranslations($request, $active_theme->location);
            return view('core::base.language.theme_translations')->with(
                [
                    'language' => $language,
                    'lang_keys' => $lang_keys,
                    'theme' => $active_theme->location
                ]
            );
        } else {

            return translate("No Theme activated yet. Please Active a theme");
        }
    }
    /**
     * Update language key values
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function updateLanguageKeyValues(Request $request)
    {
        $res = $this->language_repository->updateTranslation($request);
        if ($res == true) {
            toastNotification('success', translate('Translations updated successfully'), 'Success');
        } else {
            toastNotification('error', translate('Update failed'), 'Failed');
        }
        return redirect()->back();
    }

    /**
     * Will update frontend translations
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function updateFrontendTranslations(Request $request)
    {
        $res = $this->language_repository->updateFrontendTranslation($request);
        if ($res == true) {
            toastNotification('success', translate('Translations updated successfully'), 'Success');
        } else {
            toastNotification('error', translate('Update failed'), 'Failed');
        }
        return redirect()->back();
    }

    //theme translations

    public function themeTranslations()
    {
        $active_theme = getActiveTheme();
        if ($active_theme != null) {

            $lang_keys = ThemeTranslations::where('lang', 'en')->where('theme', $active_theme->location)->orderBy('id', 'DESC')->get();
            return view('core::base.language.tl_tranalations')->with(
                [
                    'lang_keys' => $lang_keys,
                    'theme' => $active_theme->location
                ]
            );
        } else {

            return translate("No Theme activated yet. Please Active a theme");
        }
    }

    public function storeThemeTranslations(Request $request)
    {
        try {
            $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($request['value'])));
            $active_theme = getActiveTheme();
            $translation_def = new ThemeTranslations;
            $translation_def->theme = $active_theme->location;
            $translation_def->lang = 'en';
            $translation_def->lang_key = xss_clean($request['value']);
            $translation_def->lang_value = xss_clean($request['value']);
            $translation_def->save();
            return redirect()->route('core.language.theme.translations');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
