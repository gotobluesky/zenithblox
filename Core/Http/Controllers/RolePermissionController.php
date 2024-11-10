<?php

namespace Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Core\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class RolePermissionController extends Controller
{
    /**
     * Fetch all roles from database
     */
    public function roles()
    {
        try {
            $roles = Role::all();
            return view('core::base.users.roles', compact('roles'));
        } catch (Exception $e) {
            toastNotification('error', 'Action failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Add new role
     *
     * @param  RoleRequest $request
     * @return mixed
     */
    public function addRole(RoleRequest $request)
    {
        try {
            $permissions = explode(',', $request['permissions']);
            $role = Role::create(['name' => xss_clean($request['role_name'])]);
            $role->syncPermissions($permissions);

            activity()->causedBy(Auth::user())->performedOn($role)->log('New role created');

            Toastr::success(translate('Role added successfully'));
            return redirect()->route('core.roles');
        } catch (Exception $th) {
            Toastr::error(translate('Unable to add new order'));
            return redirect()->route('core.roles');
        }
    }

    /**
     * Edit role
     * 
     * @param  Request $request
     * @return mixed
     */
    public function editRole(Request $request)
    {
        try {
            $role = Role::find($request['id']);
            $permissions = DB::table('role_has_permissions')
                ->where('role_id', '=', $request['id'])
                ->pluck('permission_id');

            $modules = DB::table('permission_module')->select([
                'id'
            ])->get();

            foreach ($modules as $module) {
                $hasAllPermissionsOfThisModule = hasAllModulePermission($module->id, $request['id']);
                if ($hasAllPermissionsOfThisModule) {
                    $module->hasAllPermission = 1;
                } else {
                    $module->hasAllPermission = 0;
                }
            }
            return response()->json([
                'success' => true,
                'role' => $role,
                'permissions' => $permissions,
                'modules' => $modules,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => translate('Unable to fetch role information')
            ]);
        }
    }

    /**
     * Delete role
     *
     * @param  Request $request
     * @return mixed
     */
    public function deleteRole(Request $request)
    {
        try {
            $role = Role::find($request['id']);
            $role->delete();
            return response()->json([
                'success' => true,
                'message' => translate('Role deleted successfully')
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => translate("Unable to delete role")
            ]);
        }
    }

    /**
     * update role
     *
     * @param  RoleRequest $request
     * @return mixed
     */
    public function updateRole(RoleRequest $request)
    {
        try {
            $role = Role::find($request['id']);
            $role->name = xss_clean($request['role_name']);
            $role->update();

            $permissions = explode(',', $request['permissions']);
            $role->syncPermissions($permissions);

            activity()->causedBy(Auth::user())->performedOn($role)->log('Role module updated');
            setActivityLog($role, 'Role module updated');
            return response()->json([
                'success' => true,
                'message' => translate("Role updated successful")
            ]);
        } catch (Exception $th) {
            return response()->json([
                'success' => false,
                'message' => translate("Unable to update role")
            ], 500);
        }
    }

    /**
     * Fetch all permissions from database
     */
    public function permissions()
    {
        try {
            $active_theme = getActiveTheme();
            $permissions = DB::table('permissions')
                ->join('permission_module', 'permission_module.id', '=', 'permissions.module_id')
                ->select([
                    'permissions.name as permission_name',
                    'permission_module.module_name as module_name',
                    'permissions.guard_name as guard_name',
                    'permission_module.module_type as module_type',
                    'permission_module.location as location',
                ])->get();

            $permissions =  array_filter($permissions->toArray(), function ($item) use ($active_theme) {
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

            return view('core::base.users.permissions', compact('permissions'));
        } catch (Exception $e) {
            toastNotification('error', translate('Action failed'), 'Failed');
            return redirect()->back();
        }
    }
}
