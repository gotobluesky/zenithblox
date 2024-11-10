<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Core\Models\User;
use App\Helpers\Install;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{
    public function __construct(public Install $install_helper)
    {
    }

    public function index()
    {
        return view('install.welcome');
    }

    public function requirements()
    {
        $phpSupportInfo = $this->install_helper->checkPHPversion(
            config('installer.core.minPhpVersion')
        );

        $requirements = $this->install_helper->checkServerRequirements(
            config('installer.requirements')
        );
        return view('install.requirement')->with(
            [
                'phpSupportInfo' => $phpSupportInfo,
                'requirements' => $requirements
            ]
        );
    }

    public function permissions()
    {
        $permissions = $this->install_helper->checkPermissions(
            config('installer.permissions')
        );
        return view('install.permissions')->with(
            [
                'permissions' => $permissions
            ]
        );
    }
    /**
     * Save and test database
     *
     *@param \Illuminate\Http\Request $request
     *@return mixed
     */
    public function saveDatabase(Request $request)
    {
        $validated = $request->validate([
            'host' => 'required',
            'database_name' => 'required',
            'database_user_name' => 'required',
            'port' => 'required',
            'password' => 'nullable',
        ]);
        try {
            setEnv('DB_HOST', $validated['host']);
            setEnv('DB_PORT', $validated['port']);
            setEnv('DB_DATABASE', $validated['database_name']);
            setEnv('DB_USERNAME', $validated['database_user_name']);
            setEnv('DB_PASSWORD', $validated['password']);
            setEnv('APP_URL', $request->getSchemeAndHttpHost());
            Artisan::call('cache:clear');
            $connection = $this->check_database_connection($request['host'], $request['database_name'], $request['database_user_name'], $request['password'], $request['port']);
            if ($connection) {
                return to_route('install.database.import');
            } else {
                return redirect()->route('install.database', ['check' => 'failed'])->with('message', 'Database connection failed');
            }
        } catch (\Exception $e) {
            info($e);
            return redirect()->back()->with('message', 'Database connection failed');
        } catch (\Error $e) {
            info($e);
            return redirect()->back()->with('message', 'Database connection failed');
        }
    }

    /**
     * Will check database connection
     */
    function check_database_connection($db_host = "", $db_name = "", $db_user = "", $db_pass = "", $db_port)
    {
        if (@mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Will import sql
     */
    public function importDatabase(Request $request)
    {
        try {
            set_time_limit(300);
            $this->flash_database();
            $sql_path = base_path('database/data.sql');
            DB::unprepared(file_get_contents($sql_path));
            return to_route('install.user.registration');
        } catch (\Exception $e) {
            info($e);
            $current_max_allowed_packet_size = sizeof(DB::select('SHOW VARIABLES LIKE "max_allowed_packet"')) > 0 ?  DB::select('SHOW VARIABLES LIKE "max_allowed_packet"')[0]->Value : 0;
            $current_max_allowed_packet_size_in_m = $current_max_allowed_packet_size / 1048576;
            if ($current_max_allowed_packet_size_in_m < 5) {
                return redirect()->route('install.database.import', ['check' => 'failed'])->with('message', "Please increase 'max_allowed_packet' size in MySQL. Required size 5M");
            }
            return redirect()->route('install.database.import', ['check' => 'failed'])->with('message', 'Failed SQL import. Please try again');
        } catch (\Error $e) {
            info($e);
            $current_max_allowed_packet_size = sizeof(DB::select('SHOW VARIABLES LIKE "max_allowed_packet"')) > 0 ?  DB::select('SHOW VARIABLES LIKE "max_allowed_packet"')[0]->Value : 0;
            $current_max_allowed_packet_size_in_m = $current_max_allowed_packet_size / 1048576;
            if ($current_max_allowed_packet_size_in_m < 5) {
                return redirect()->route('install.database.import', ['check' => 'failed'])->with('message', "Please increase 'max_allowed_packet' size in MySQL. Required size 5M");
            }
            return redirect()->route('install.database.import', ['check' => 'failed'])->with('message', 'Failed SQL import. Please try again');
        }
    }

    /**
     * Flash database
     */
    public function flash_database()
    {
        try {
            DB::statement("SET FOREIGN_KEY_CHECKS = 0");
            $tables = DB::select('SHOW TABLES');
            $databaseName = \DB::connection()->getDatabaseName();
            $table_name = 'Tables_in_' . '' . $databaseName;
            foreach ($tables as $table) {
                Schema::drop($table->$table_name);
            }
            DB::statement("SET FOREIGN_KEY_CHECKS = 1");
            return true;
        } catch (\Exception $e) {
            info($e);
            return false;
        } catch (\Error $e) {
            info($e);
            return false;
        }
    }

    /**
     * Store admin info
     */
    public function saveUser(Request $request)
    {
        $validated = $request->validate([
            'system_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);
        try {
            //Store super admin
            $date = Carbon::now();
            $user_id = $date->format('y') . $date->format('m') . $date->format('d');
            DB::beginTransaction();
            $user = User::first();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->status = config('settings.user_status.active');
            $user->saveOrFail();

            $user->uid = "SUPER-ADMIN-" . $user->id . $user_id;
            $user->update();

            $user->assignRole('Super Admin');

            //Set system name
            $data = [
                'settings_id' => getGeneralSettingId('system_name'),
                'value' => $request['system_name']
            ];

            DB::table('tl_general_settings_has_values')->where('settings_id', getGeneralSettingId('system_name'))->delete();
            DB::table('tl_general_settings_has_values')->insert($data);

            setEnv('IS_USER_REGISTERED', "1");
            Artisan::call('storage:link');
            DB::commit();
            return redirect('/admin/login');
        } catch (\Exception $e) {
            info($e);
            DB::rollBack();
            return redirect()->back()->with('message', 'User Registration failed');
        } catch (\Error $e) {
            info($e);
            DB::rollBack();
            return redirect()->back()->with('message', 'User Registration failed');
        }
    }
}
