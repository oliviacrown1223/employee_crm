<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * CLEAR CACHE
         */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();



        $permissions = [

            // EMPLOYEE
            'employee.view.self',
            'employee.view.team',
            'employee.view.all',

            'employee.create.all',
            'employee.edit.all',

            // ATTENDANCE
            'attendance.view.self',
            'attendance.view.team',
            'attendance.view.all',

            'attendance.mark.self',
            'attendance.approve.team',
            'attendance.approve.all',

            // SALARY
            'salary.view.self',
            'salary.view.team',
            'salary.view.all',

            'salary.manage.all',

            // DAILY WORK
            'daily_work.view.self',
            'daily_work.view.team',

            'daily_work.submit.self',
            'daily_work.approve.team',

            // LEAVE
            'leave.view.self',
            'leave.view.team',
            'leave.view.all',

            'leave.apply.self',
            'leave.approve.team',
            'leave.approve.all',

            // PERFORMANCE
            'performance.view.self',
            'performance.view.team',
            'performance.view.all',

            'performance.rate.self',
            'performance.rate.team',
            'performance.manage.all',

            // ROLE
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            'permission.assign',
        ];



        /**
         * CREATE PERMISSIONS
         */
        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }



        /**
         * ROLES
         */
        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin'
        ]);

        $hr = Role::firstOrCreate([
            'name' => 'hr'
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'manager'
        ]);

        $employee = Role::firstOrCreate([
            'name' => 'employee'
        ]);



        /**
         * SUPER ADMIN
         */
        $superAdmin->syncPermissions(Permission::all());



        /**
         * HR
         */
        $hr->syncPermissions([

            'employee.view.all',
            'employee.create.all',
            'employee.edit.all',

            'attendance.view.all',
            'attendance.approve.all',

            'salary.manage.all',

            'leave.view.all',
            'leave.approve.all',

            'performance.view.all',
            'performance.manage.all',

            'role.view',
        ]);



        /**
         * MANAGER
         */
        $manager->syncPermissions([

            'employee.view.team',

            'attendance.view.team',
            'attendance.approve.team',

            'daily_work.view.team',
            'daily_work.approve.team',

            'leave.view.team',
            'leave.approve.team',

            'performance.view.team',
            'performance.rate.team',
        ]);



        /**
         * EMPLOYEE
         */
        $employee->syncPermissions([

            'employee.view.self',

            'attendance.view.self',
            'attendance.mark.self',

            'salary.view.self',

            'daily_work.view.self',
            'daily_work.submit.self',

            'leave.view.self',
            'leave.apply.self',

            'performance.view.self',
            'performance.rate.self',
        ]);

        /**
         * CLEAR CACHE AGAIN
         */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
