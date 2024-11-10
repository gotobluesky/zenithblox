<?php

namespace Core\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Core\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Core\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Core\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * get all users
     *
     * @return mixed
     */
    public function users()
    {
        try {
            $data = [
                'tl_users.*',
                'tl_uploaded_files.path as pro_pic',
                'tl_uploaded_files.alt as alt'
            ];
            $users = $this->user_repository->getUserProfileInfo($data)->get();
            foreach ($users as $u) {
                $userModel = User::find($u->id);
                $u->roles = $userModel->getRoleNames()->toArray();
            }
            return view('core::base.users.users', compact('users'));
        } catch (Exception $e) {
            toastNotification('error', translate('Action failed'), 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Will redirect to user adding form
     *
     * @return mixed
     */
    public function addUser()
    {
        return view('core::base.users.add_user');
    }

    /**
     * store new user
     *
     * @param  UserRequest $request
     * @return mixed
     */
    public function storeUser(UserRequest $request)
    {
        try {
            $date = Carbon::now();
            $user_id = $date->format('y') . $date->format('m') . $date->format('d');

            DB::beginTransaction();
            $user = new User();
            $user->name = xss_clean($request['name']);
            $user->email = xss_clean($request['email']);
            $user->password = Hash::make($request['password']);
            if (isset($request['status'])) {
                $user->status = config('settings.user_status.active');
            } else {
                $user->status = config('settings.user_status.in_active');
            }
            $user->saveOrFail();

            $user->uid = "STUFF" . $user->id . $user_id;
            $user->image = $request['pro_pic'];
            $user->update();
            $user->assignRole($request['role']);

            DB::commit();

            toastNotification('success', translate('User created successfully'));
            return redirect()->route('core.add.user');
        } catch (Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('User create failed'));
            return redirect()->route('core.add.user');
        }
    }

    /**
     * Will update user status
     *
     * @param  mixed $request
     * @return mixed
     */
    public function updateUserStatus(Request $request)
    {
        try {
            $user = User::findOrFail($request['id']);
            $user->status = $request['status'];
            $user->update();
            return response()->json([
                'success' => true,
                'message' => translate('User status updated successfully')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => translate("Unable to update user status")
            ], 500);
        }
    }

    /**
     * will redirect to user editing form
     *
     * @param  mixed $id
     * @return mixed
     */
    public function editUser($id)
    {
        try {
            $match_case = [
                ['tl_users.id', '=', $id]
            ];
            $data = [
                'tl_users.*',
                'tl_uploaded_files.path as pro_pic',
                'tl_uploaded_files.alt as pro_pic_alt',
                'tl_uploaded_files.id as pro_pic_id'
            ];
            $user = $this->user_repository->getUserProfileInfo($data, $match_case)->first();
            return view('core::base.users.edit_user', compact('user'));
        } catch (\Throwable $th) {
            toastNotification('error', translate('Action failed'), 'Failed');
            return redirect()->back();
        }
    }


    /**
     * update user details
     *
     * @param  mixed $request
     * @return mixed
     */
    public function updateUser(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find($request['id']);
            $user->name = xss_clean($request['name']);
            $user->email = xss_clean($request['email']);
            if (isset($request['status'])) {
                $user->status = config('settings.user_status.active');
            } else {
                if (!$user->hasRole('Super Admin')) {
                    $user->status = config('settings.user_status.in_active');
                }
            }
            $user->update();

            $user->image = $request['pro_pic'];
            $user->update();
            if (!$user->hasRole('Super Admin')) {
                if(isset($request['role']) && $request['role']!=null){
                    $user->syncRoles($request['role']);
                }
            }
            DB::commit();

            toastNotification('success', translate('User updated successfully'));
            return redirect()->route('core.users');
        } catch (Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Unable to update user'));
            return redirect()->route('core.users');
        }
    }

    /**
     * delete user
     *
     * @param  mixed $request
     * @return mixed
     */
    public function deleteUser(Request $request)
    {
        try {
            $user = User::findOrFail($request['id']);
            $user->delete();
            toastNotification('success', translate('User deleted successfully'));
            return redirect()->route('core.users');
        } catch (Exception $e) {
            toastNotification('error', translate('Action failed'), 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Will redirect to profile page
     */
    public function profile()
    {
        try {
            $id = Auth::user()->id;
            $match_case = [
                ['tl_users.id', '=', $id]
            ];
            $data = [
                'tl_users.*',
                'tl_uploaded_files.path as pro_pic',
                'tl_uploaded_files.alt as pro_pic_alt',
                'tl_uploaded_files.id as pro_pic_id'
            ];
            $user = $this->user_repository->getUserProfileInfo($data, $match_case)->first();
            return view('core::base.users.user_profile', compact('user'));
        } catch (Exception $ex) {
            toastNotification('error', translate('Action failed'), 'Failed');
            return redirect()->back();
        }
    }

    /**
     * update user profile
     *
     * @param  UserRequest $request
     * @return mixed
     */
    public function updateProfile(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find($request['id']);
            if (request('old_password') != null) {
                if (!Hash::check($request['old_password'], $user->password)) {
                    return back()->withErrors([
                        'old_password' => 'Incorrect password'
                    ]);
                }
            }
            $user->name = xss_clean($request['name']);
            $user->email = xss_clean($request['email']);
            
            if (request('password') != null && request('password_confirmation') != null && request('old_password') != null) {
                $user->password = Hash::make($request['password']);
            }

            $user->update();
            $user->image = $request['pro_pic'];

            $user->update();
            $info = $user->info();
            if ($info->exists()) {
                $info->delete();
            }
            $info->create([
                'bio' => xss_clean($request['bio']),
                'custom_social' => $request['custom_author_social'],
                'social' => $request['custom_author_social'] != 0 ? $this->socialDataEncode($request) : null
            ]);
            if($request['bio'] != ''){
                storeFrontendTranslation(xss_clean($request['bio']));
            }
            DB::commit();
            toastNotification('success', translate('Profile updated successfully'));
            return redirect()->route('core.profile');
        } catch (Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Unable to update user profile'));
            return redirect()->route('core.profile');
        }
    }


    public function socialDataEncode($request)
    {
        $data = [];

        // icon title
        for ($i = 0; $i < sizeof($request->social_icon_title); $i++) {
            $data[$i]['social_icon_title'] = xss_clean($request->social_icon_title[$i]);
        }

        // icon
        for ($i = 0; $i < sizeof($request->social_icon); $i++) {
            $data[$i]['social_icon'] = xss_clean($request->social_icon[$i]);
        }

        // icon url
        for ($i = 0; $i < sizeof($request->social_icon_url); $i++) {
            $data[$i]['social_icon_url'] = xss_clean($request->social_icon_url[$i]);
        }

        //order
        foreach ($data as $key => $value) {
            $data[$key]['order'] = $key + 1;
        }

        return json_encode($data);
    }
}
