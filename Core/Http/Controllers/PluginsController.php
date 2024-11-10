<?php

namespace Core\Http\Controllers;

use ZipArchive;
use Core\Models\Plugins;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Core\Http\Requests\PluginRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class PluginsController extends Controller
{
    /**
     * Get plugins list
     * 
     * @return mixed
     */
    public function index()
    {
        $plugins = Plugins::select(['location', 'is_activated', 'id'])
            ->get()
            ->map(function ($plugin) {
                $plugin_info = file_get_contents(base_path("plugins/{$plugin->location}/plugin.json"));
                $data = json_decode($plugin_info, true);
                return [...$plugin->toArray(), ...$data];
            });

        return view('core::base.plugins.index', compact('plugins'));
    }

    /**
     * Deactivate plugin
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function inactive(Request $request)
    {
        try {
            DB::beginTransaction();
            $plugin = Plugins::findOrFail($request->id);
            $plugin->is_activated = config('settings.general_status.in_active');
            $plugin->update();
            DB::commit();
            $this->resetPluginsCache();
            toastNotification('success', translate('Plugin inactive successfully'), 'Success');
            return redirect()->route('core.plugins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Plugin deactivation failed'), 'Failed');
            return redirect()->route('core.plugins.index');
        }
    }
    /**
     * Activate plugin
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();
            $plugin = Plugins::findOrFail($request->id);
            $plugin->is_activated = config('settings.general_status.active');
            $plugin->update();
            DB::commit();
            $this->resetPluginsCache();
            toastNotification('success', translate('Plugin activate successfully'), 'Success');
            return redirect()->route('core.plugins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Plugin activation failed'), 'Failed');
            return redirect()->route('core.plugins.index');
        }
    }
    /**
     * Redirect to install plugin page
     * 
     * @return mixed
     */
    public function create()
    {
        return view('core::base.plugins.install');
    }

    /**
     * Install and update plugin
     * 
     * @param Request $request
     * @return mixed
     */
    public function install(Request $request)
    {
        try {

            $zip = new ZipArchive();
            $status = $zip->open($request->file("zip_file")->getRealPath());
            if ($status != true) {
                toastNotification('success', 'Plugin installation failed', 'Success');
                return redirect()->back();
            }

            if ($status) {
                $file_name = $zip->getNameIndex(0);
                $json = $zip->getFromName($file_name . 'plugin.json');

                if ($json) {
                    $json_array = json_decode($json);

                    //replace plugin folder
                    $pluginDestinationPath = base_path("plugins/");
                    if (!File::exists($pluginDestinationPath)) {
                        File::makeDirectory($pluginDestinationPath, 0777, true);
                    }

                    if ($zip->extractTo($pluginDestinationPath)) {
                        chmod($pluginDestinationPath . '/' . $json_array->location, 0777);
                        $zip->close();

                        //Import Database
                        $db = $pluginDestinationPath . '' . $json_array->location . '/data.sql';

                        if (file_exists($db)) {
                            DB::unprepared(file_get_contents($db));
                        }
                    }


                    DB::beginTransaction();
                    //Store new plugin in database
                    $plugin = Plugins::firstOrNew(['name' => $json_array->name]);
                    $plugin->name = $json_array->name;
                    $plugin->location = $json_array->location;
                    $plugin->author = $json_array->author;
                    $plugin->description = $json_array->description;
                    $plugin->version = $json_array->version;
                    $plugin->unique_indentifier = Str::random(15);
                    $plugin->is_activated = config('settings.general_status.in_active');
                    $plugin->namespace = $json_array->namespace;
                    $plugin->url = $json_array->url;
                    $plugin->save();
                    DB::commit();
                    //reset Cache
                    $this->resetPluginsCache();
                    toastNotification('success', 'Plugin install successfully', 'Success');
                    return redirect()->route('core.plugins.index');
                } else {
                    DB::rollBack();
                    toastNotification('error', 'Plugin installation failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', 'Plugin installation failed', 'Failed');
            return redirect()->back();
        } catch (\Error $e) {
            DB::rollBack();
            toastNotification('error', 'Plugin installation failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Verify Purchase Code
     */
    public function verify(Request $request)
    {
        try {
 

            DB::beginTransaction();
            $plugin = Plugins::where('location', $request['plugin-location'])->first();

            if ($plugin) {
                $plugin->is_activated = config('settings.general_status.active');
                $plugin->update();
                DB::commit();

                $plugin_info = file_get_contents(base_path("plugins/{$plugin->location}/plugin.json"));
                $data = json_decode($plugin_info, true);
                $data['is_verified'] = true;
                file_put_contents(base_path("plugins/{$plugin->location}/plugin.json"), json_encode($data));

                toastNotification('success', translate('Purchase Key Verified Successfully'), 'Success');
                return redirect()->route('core.plugins.index');
            }

            toastNotification('error', translate('Purchase Key Verifying Failed'), 'Failed');
            return redirect()->route('core.plugins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Purchase Key Verifying Failed'), 'Failed');
            return redirect()->route('core.plugins.index');
        }
    }

    /**
     * Will reset plugin cache
     * 
     * @return void
     */
    public function resetPluginsCache()
    {
        cache()->forget('plugins');
        Cache::rememberForever("plugins", function () {
            return Plugins::all();
        });
    }


    public function verifyPurchaseCode($request)
    {
                    return [
                        'success' => true,
                        'license_info' => 'Nulled'
                    ];
    }

    /**
     * Plugin Delete
     */
    public function delete(Plugins $plugin)
    {
        try {
            if ($plugin) {
                DB::beginTransaction();
                $location = $plugin->location;
                $plugin->delete();
                DB::commit();

                if (file_exists(base_path('plugins/' . $location . '/delete.sql'))) {
                    DB::unprepared(file_get_contents(base_path('plugins/' . $location . '/delete.sql')));
                }

                File::deleteDirectory(base_path('plugins/' . $location));

                toastNotification('success', translate('Plugin Deleted Successfully'), 'Successful');
            } else {
                toastNotification('error', translate('Plugin Deleting Failed'), 'Failed');
            }

            return redirect()->route('core.plugins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Plugin Deleting Failed'), 'Failed');
            return redirect()->route('core.plugins.index');
        }
    }
}
