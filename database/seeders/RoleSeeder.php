<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::findOrCreate('Admin', 'web');
        $teacherRole = Role::findOrCreate('Teacher', 'web');
        $studentRole = Role::findOrCreate('Student', 'web');

        Permission::findOrCreate('admin.categories', 'web')->assignRole($adminRole);
        Permission::findOrCreate('admin.leves', 'web')->assignRole($adminRole);
        Permission::findOrCreate('admin.prices', 'web')->assignRole($adminRole);
        Permission::findOrCreate('admin.courses', 'web')->assignRole($adminRole);
        
        Permission::findOrCreate('instructor.courses', 'web')->syncRoles([$adminRole, $teacherRole]);
        Permission::findOrCreate('instructor.courses.curriculum', 'web')->syncRoles([$adminRole, $teacherRole]);
        Permission::findOrCreate('instructor.courses.goals', 'web')->syncRoles([$adminRole, $teacherRole]);
        Permission::findOrCreate('instructor.courses.students', 'web')->syncRoles([$adminRole, $teacherRole]);
        Permission::findOrCreate('instructor.courses.observation', 'web')->syncRoles([$adminRole, $teacherRole]);

        $adminUser = User::find(1); 
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }

        $secondaryAdminUser = User::find(2); 
        if ($secondaryAdminUser) {
            $secondaryAdminUser->assignRole($adminRole);
        }
    }
}
