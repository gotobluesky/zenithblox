<?php

namespace Theme\Default\Http\Controllers\Backend;

use JsonException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Theme\Default\Models\TlThemeOptionSettings;
use Theme\Default\Repositories\ThemeOptionRepository;

class ThemeOptionController extends Controller
{

    protected $themeOption_repository;

    public function __construct(ThemeOptionRepository $themeOption_repository)
    {
        $this->themeOption_repository = $themeOption_repository;
    }

    /**
     ** Theme Options Page
     * @return View
     */
    public function themeOptions()
    {
        try {
            return view('theme/default::backend.theme.options');
        } catch (\Exception $e) {
            toastNotification('error', translate('Theme Option Page Failed'));
            return redirect()->back();
        }
    }

    /**
     ** Get Theme Option Form
     * @param object $request
     * @return Response
     */
    public function getOptionForm(Request $request)
    {
        try {
            $active_theme = getActiveTheme();
            $option_name = $request->id;
            $option_settings = getThemeOption($option_name, $active_theme->id);
            $form = view('theme/default::backend.theme.option-form.' . $option_name, compact('option_settings'))->render();
            return response()->json(['form' => $form]);
        } catch (\Exception $e) {
            return response()->json(['error' => translate('Theme Option Getting Failed')]);
        }
    }


    /**
     ** Save Theme Option Form
     * @param object $request
     * @return Response
     */
    public function saveOptionForm(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->option_name !== 'import_export') {
                if ($request->submitType == 'reset_all' || $request->submitType == 'reset_section') {
                    $this->themeOption_repository->resetThemeOption($request);
                } else {
                    switch ($request->option_name) {
                        case 'social':
                            $this->themeOption_repository->saveSocialLink($request);
                            break;
                        case 'google_adsense':
                            $this->themeOption_repository->saveAdsense($request);
                            break;
                        case 'custom_fonts':
                            $this->themeOption_repository->saveCustomFont($request);
                            break;
                        default:
                            $this->themeOption_repository->saveThemeOption($request);
                            break;
                    }
                }
            }
            DB::commit();

            toastNotification('success', translate('Theme Option Saved'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Theme Option Saving Failed'));
            return redirect()->back();
        }
    }


    /**
     * import theme option
     * @param Request $request
     */
    public function importThemeOption(Request $request)
    {

        try {
            DB::beginTransaction();
            $jsonInputData = '';
            if (trim($request->import_text) !== '') {
                $import_text = xss_clean($request->import_text);
                $jsonInputData = json_decode($import_text, true, 512, JSON_THROW_ON_ERROR);
            }
            $jsonFile = null;
            if ($request->theme_options_file) {
                $jsonFile = $request->file('theme_options_file');
                $jsonFileData = json_decode(file_get_contents($jsonFile), true);
            }

            $active_theme = getActiveTheme();
            if ($jsonInputData !== '') {
                TlThemeOptionSettings::where('theme_id', $active_theme->id)->delete();
                TlThemeOptionSettings::insert($jsonInputData);
                // cache clear for theme option
                Cache::forget('theme-option-settings');
                toastNotification('success', translate('Theme Option Import Success'));
            } elseif (isset($jsonFileData)) {
                TlThemeOptionSettings::where('theme_id', $active_theme->id)->delete();
                TlThemeOptionSettings::insert($jsonFileData);
                // cache clear for theme option
                Cache::forget('theme-option-settings');
                toastNotification('success', translate('Theme Option Import Success'));
            } else {
                toastNotification('error', translate('Import File or Clipboard Text is Required'));
            }
            DB::commit();
        } catch (JsonException $e) {
            DB::rollBack();
            toastNotification('error', translate('Invalid JSON data'));
        } catch (\Exception $e) {
            toastNotification('success', translate('Theme Option Import Success'));
            toastNotification('error', translate('Theme Option Importing Failed'));
        };

        return redirect()->back();
    }

    /**
     ** Download Theme Option
     * @return JSON
     */
    public function downloadThemeOption()
    {
        return getJsonThemeOption(true);
    }
}
