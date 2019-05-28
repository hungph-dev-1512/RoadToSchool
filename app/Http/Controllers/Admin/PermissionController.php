<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use App\Http\Requests\CreateAdminPermissionRequest;

class PermissionController extends Controller
{
    protected $modelPermission;
    protected $modelUser;
    protected $modelPermissionUser;

    public function __construct(Permission $permission, User $user, PermissionUser $permissionUser)
    {
        $this->modelPermission = $permission;
        $this->modelUser = $user;
        $this->modelPermissionUser = $permissionUser;
    }

    public function index(Request $request)
    {
        $userGroupList = Permission::$user_group;
        $permissionGroupList = Permission::$permission_group;
        // Group Permission
        for ($i = 0; $i < 3; $i++) {
            $commonPermission[$i] = $this->modelPermission->where('group_permission', $i)->get();
        }
        $adminList = $this->modelUser->where('is_admin', 1)->get();
        $instructorList = $this->modelUser->where('is_admin', 0)->where('role', 1)->get();
        $studentList = $this->modelUser->where('is_admin', 0)->where('role', 2)->get();
        $dataParamList = $request->all();

        $emailUserList = $this->modelUser->pluck('email', 'id');
        $editPermission = 0;

        return view('admin.permissions.index', compact(
            'userGroupList',
            'permissionGroupList',
            'commonPermission',
            'adminList',
            'instructorList',
            'studentList',
            'emailUserList',
            'editPermission',
            'dataParamList'
        ));
    }

    public function getPermission(Request $request, $userId)
    {
        $permissionList = $this->modelPermissionUser->where('user_id', $userId)->pluck('permission_id');
        $selectedUser = User::findOrFail($userId);

        // Check update permission
        if ($this->modelPermissionUser->where('permission_id', 19)->where('user_id', \Auth::user()->id)->first()) {
            $responseData['allowUpdate'] = 1;
        } else {
            $responseData['allowUpdate'] = 0;
        }

        $responseData['permissionList'] = $permissionList;
        $responseData['selectedUser'] = $selectedUser;

        return json_encode($responseData);
    }

    public function updatePermission(Request $request, $userId)
    {
        $data = $request->all();
        if (!array_key_exists('checkedPermissionList', $data)) {
            $this->modelPermissionUser->where('user_id', $userId)->delete();

            return 200;
        } else {
            $checkedPermissionList = $data['checkedPermissionList'];
            $this->modelPermissionUser->where('user_id', $userId)->delete();
            for ($x = 0; $x < count($checkedPermissionList); $x++) {
                $checkPermissionExist = $this->modelPermissionUser->where('permission_id', $checkedPermissionList[$x])
                    ->where('user_id', $userId)
                    ->first();
                if (!$checkPermissionExist) {
                    $this->modelPermissionUser->create([
                        'permission_id' => $checkedPermissionList[$x],
                        'user_id' => $userId
                    ]);
                }
            }

            return json_encode($checkedPermissionList);
        }
    }

    public function create()
    {
        $permissionGroupList = Permission::$permission_group;
        // Group Permission
        for ($i = 0; $i < 3; $i++) {
            $commonPermission[$i] = $this->modelPermission->where('group_permission', $i)->get();
        }

        return view('admin.permissions.create', compact(
            'permissionGroupList',
            'commonPermission'
        ));
    }

    public function store(CreateAdminPermissionRequest $request)
    {
        $data = $request->all();

        $result = $this->modelPermission->create($data);
        if ($result) {
            flash(__('messages.create_permission_successfully'))->success();
        } else {
            flash(__('messages.create_permission_failed'))->error();
        }

        return redirect()->back();
    }
}
