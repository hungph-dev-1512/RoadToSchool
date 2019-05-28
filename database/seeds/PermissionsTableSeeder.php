<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        // Permission for common student
        $studentPermissionList = [
            'Access page',
            'Show profile',
            'Update self profile',
            'Show instructor information',
            'Show all courses',
            'Show a course',
            'Show a lecture',
            'Add to cart',
            'Checkout cart',
            'Checkout and create bill',
            'Comment',
        ];

        foreach ($studentPermissionList as $permission) {
            Permission::create([
                'content' => $permission,
                'group_permission' => Permission::STUDENT_GROUP_PERMISSION,
            ]);
        }
        // Permission for common instructor
        $instructorPermissionList = [
            'Access instructor dashboard',
            'Show instructor\'s course',
            'Create Course',
            'Show all self student',
            'Show a instructor\'s course',
            'Update a course',
            'Update a lecture',
            'Create a lecture in course',
            'Create a course'
        ];

        foreach ($instructorPermissionList as $permission) {
            Permission::create([
                'content' => $permission,
                'group_permission' => Permission::INSTRUCTOR_GROUP_PERMISSION,
            ]);
        }
        // Permission for common admin
        $adminPermissionList = [
            'Access admin dashboard',
            'Show all bill',
            'Show a bill',
            'Update a bill status',
            'Delete a bill',
            'Show all course',
            'Show user permission',
            'Update user permission',
            'Add new permission',
            'View all course information',
            'View all categories',
            'View all lecture requests',
            'Accept a lecture request',
            'View all users',
            'View instructor ranking',
            'Create new instructor',
            'Check and reply all conversation waiting'
        ];

        foreach ($adminPermissionList as $permission) {
            Permission::create([
                'content' => $permission,
                'group_permission' => Permission::ADMIN_GROUP_PERMISSION,
            ]);
        }

        // Permission User Table generator
        Schema::disableForeignKeyConstraints();
        DB::table('permission_user')->truncate();
        Schema::enableForeignKeyConstraints();
        // For super_admin id 1
        foreach (Permission::all() as $permission) {
            PermissionUser::create(
                [
                    'permission_id' => $permission->id,
                    'user_id' => 1
                ]
            );
        }
        // All instructor permission
        $adminList = User::where('is_admin', 1)->get();
        foreach ($adminList as $admin) {
            $instructorPermissionList = Permission::where('group_permission', Permission::ADMIN_GROUP_PERMISSION)->get();
            foreach ($instructorPermissionList as $permission) {
                PermissionUser::create([
                    'permission_id' => $permission->id,
                    'user_id' => $admin->id
                ]);
            }
        }

        // All instructor permission
        $instructorList = User::where('role', 1)->get();
        foreach ($instructorList as $instructor) {
            $instructorPermissionList = Permission::where('group_permission', Permission::INSTRUCTOR_GROUP_PERMISSION)->get();
            foreach ($instructorPermissionList as $permission) {
                PermissionUser::create([
                    'permission_id' => $permission->id,
                    'user_id' => $instructor->id
                ]);
            }
        }
    }
}
