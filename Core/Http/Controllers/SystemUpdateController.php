<?php

namespace Core\Http\Controllers;

use Core\Models\User;
use Core\Models\Themes;
use Core\Models\Plugins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SystemUpdateController extends Controller
{
    public $latest_version = '1.2.0';

    public function __construct()
    {
        if (auth()->user() != null && !auth()->user()->hasRole('Super Admin')) {
            abort(403);
        }
    }

    /**
     * Will redirect to update list
     */
    public function updateList(Request $request)
    {
        $update_available = false;
        $current_version = getGeneralSetting('system_version');

        if ($current_version != null) {
            if ($current_version != $this->latest_version) {
                $update_available = true;
            }
        }
        if ($current_version == null) {
            $current_version = '1.1.0';
            $update_available = true;
        }
        return view('core::base.update_system.check_update', ['update_available' => $update_available, 'current_version' => $current_version, 'latest_version' => $this->latest_version]);
    }

    /**
     * Will update cmslooks database
     */
    public function updateCMSLooks()
    {
        try {
            //Store database
            DB::beginTransaction();
            $this->updateSystemVersion($this->latest_version);
            $this->updateThemeVersion($this->latest_version);
            
            //Import Database
            $db = base_path('updates/update.sql');
            if (file_exists($db)) {
                DB::unprepared(file_get_contents($db));
            }

            toastNotification('success', 'Successfully Updated');
            DB::commit();
            return to_route('core.check.update');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', 'Update unsuccessful');
            return to_route('core.check.update');
        } catch (\Error $e) {
            DB::rollBack();
            toastNotification('error', 'Update unsuccessful');
            return to_route('core.check.update');
        }
    }

    /**
     * Will updated theme versions
     */
    public function updateThemeVersion($updated_version)
    {

            Themes::query()->update(
                [
                    'version' => $updated_version
                ]
            );
    }

    /**
     * Will updated system version
     * 
     * @param String $updated version
     */
    public function updateSystemVersion($version)
    {
            $version_setting_id = getGeneralSettingId('system_version');
            $version_data = [
                'settings_id' => $version_setting_id,
                'value' => $version
            ];
            //Delete Exiting value
            DB::table('tl_general_settings_has_values')
                ->where('settings_id', $version_setting_id)
                ->delete();

            //Store new value
            DB::table('tl_general_settings_has_values')
                ->where('settings_id', $version_setting_id)
                ->insert($version_data);
            DB::commit();

    }
}
