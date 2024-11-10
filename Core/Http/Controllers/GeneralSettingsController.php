<?php

namespace Core\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Core\Repositories\SettingsRepository;
use Core\Http\Requests\GeneralSettingsRequest;

class GeneralSettingsController extends Controller
{
    protected $settings_repository;

    public function __construct(SettingsRepository $settings_repository)
    {
        $this->settings_repository = $settings_repository;
    }

    /**
     * Redirect to general settings page
     */
    public function generalSettings()
    {
        $data = [
            'tl_general_settings.name',
            'tl_general_settings_has_values.settings_id',
            'tl_general_settings_has_values.value',
            'tl_uploaded_files.path',
            'tl_uploaded_files.alt',
            'tl_uploaded_files.id as file_id'
        ];

        $media_settings_value = $this->settings_repository->getSettingsData($data);
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
        return view('core::base.general_settings.settings', compact('data'));
    }

    /**
     * store general settings
     *
     * @param  GeneralSettingsRequest $request
     * @return mixed
     */
    public function storeGeneralSettings(GeneralSettingsRequest $request)
    {
        try {
            $all_request = $request->all();
            $data = [];
            $settings_id = [];
            foreach ($all_request as $key => $value) {
                if ($key != '_token') {
                    array_push($data, [
                        'settings_id' => getGeneralSettingId($key),
                        'value' => xss_clean($value)
                    ]);
                    array_push($settings_id, getGeneralSettingId($key));
                }
            }

            if (isset($request['default_timezone'])) {
                setEnv('APP_TIMEZONE', str_replace(' ', '', $request['default_timezone']));
            }

            DB::table('tl_general_settings_has_values')->whereIn('settings_id', $settings_id)->delete();
            DB::table('tl_general_settings_has_values')->insert($data);
            Cache::forget('general-settings');
            Cache::forget('default-lang');
            session()->put('locale', getDefaultLang());

            toastNotification('success', translate('General settings updated successfully'));
            return redirect()->route('core.general.settings');
        } catch (\Exception $ex) {
            toastNotification('success', translate('Unable to update general settings'));
            return redirect()->route('core.general.settings');
        }
    }
}
