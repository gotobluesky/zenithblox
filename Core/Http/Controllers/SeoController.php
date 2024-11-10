<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Core\Models\GeneralSettings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Core\Models\GeneralSettingsHasValue;

class SeoController extends Controller
{
    /**
     * Will redirect seo settings page
     * 
     */
    public function seoSettings()
    {
        return view('core::base.seo.site_seo');
    }
    /**
     * Will update seo settings
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function updateSeoSettings(Request $request)
    {
        try {
            DB::beginTransaction();
            $settings = [
                'site_title' => $request['site_title'],
                'site_meta_title' => $request['site_meta_title'],
                'site_meta_description' => $request['site_meta_description'],
                'site_meta_keywords' => $request['site_meta_keywords'],
                'site_meta_image' => $request['site_meta_image'],
            ];
            $settings_keys = array_keys($settings);
            foreach ($settings_keys as $key) {
                $config = GeneralSettings::firstOrCreate(['name' => $key]);
                $value = GeneralSettingsHasValue::where('settings_id', $config->id)->first();
                if ($value != null) {
                    $value->value = xss_clean($settings[$key]);
                    $value->save();
                } else {
                    $new_value = new GeneralSettingsHasValue;
                    $new_value->settings_id = $config->id;
                    $new_value->value = xss_clean($settings[$key]);
                    $new_value->save();
                }
            }
            DB::commit();
            Cache::forget('general-settings');
            toastNotification('success', translate('Seo update successfully'));
            return to_route('core.seo.settings');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Seo update failed'));
            return redirect()->back();
        }
    }
}
