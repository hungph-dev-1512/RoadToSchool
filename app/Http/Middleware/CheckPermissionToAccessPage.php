<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;
use App\Models\PermissionUser;
use Route;

class CheckPermissionToAccessPage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permissionDefine = [
            'admin.dashboard' => 'Access admin dashboard',
            'admin.bills.index' => 'Show all bill',
            'admin.bills.show' => 'Show a bill',
            'admin.bills.updateStatus' => 'Update a bill status',
            'admin.permissions.updatePermission' => 'Update user permission',
            'admin.permissions.index' => 'Show user permission',
            'admin.permissions.getPermission' => 'Show user permission',
            'admin.permissions.create' => 'Add new permission',
            'admin.permissions.store' => 'Add new permission',
            'admin.courses.index' => 'View all course information',
            'admin.categories.index' => 'View all categories',
            'admin.lectures.requests.index' => 'View all lecture requests',
            'admin.lectures.requests.accept' => 'Accept a lecture request',
            'admin.users.index' => 'View all users',
            'admin.instructor_ranking' => 'View instructor ranking',
            'admin.users.create_instructor' => 'Create new instructor',
            'admin.conversations.waiting' => 'Check and reply all conversation waiting',
            'instructor.courses.index' => 'Show instructor\'s course',
            'instructor.dashboard' => 'Access instructor dashboard',
            'instructor.courses.show' => 'Show a instructor\'s course',
            'instructor.courses.lectures.create' => 'Create a lecture in course',
            'instructor.courses.lectures.store' => 'Create a lecture in course',
            'instructor.courses.create' => 'Create a course',
            'instructor.courses.store' => 'Create a course'
        ];

        foreach ($permissionDefine as $key => $value) {
            $permissionId = Permission::where('content', $value)->first()->id;
            $permissionDefine[$key] = $permissionId;
        }

        $routeName = Route::currentRouteName();
        $requestPermissionId = $permissionDefine[$routeName];
        $availablePermission = PermissionUser::where('user_id', $request->user()->id)->pluck('permission_id')->toArray();

        if (!in_array($requestPermissionId, $availablePermission)) {
            return abort(403, "Sorry ! No permissions here");
        }

        return $next($request);
    }
}
