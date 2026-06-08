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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // DASHBOARD
            'dashboard.view',

            // EMPLOYEE
            'employee.view.self',
            'employee.view.team',
            'employee.view.all',

            'employee.create.all',
            'employee.edit.all',
            'employee.delete.all',
            'employee.export.all',
            'employee.profile.view.self',

            'password.change.self',

            // ATTENDANCE
            'attendance.view.self',
            'attendance.view.team',
            'attendance.view.all',
            'attendance.mark.team',

            'attendance.mark.self',
            'attendance.approve.team',
            'attendance.approve.all',

            'attendance.edit.all',
            'attendance.export.all',

            // SALARY
            'salary.view.self',
            'salary.view.team',
            'salary.view.all',

            'salary.manage.all',
            'salary.edit.all',
            'salary.generate.all',
            'salary.export.all',
            'salary.payslip.download.self',

            // DAILY WORK
            'daily_work.view.self',
            'daily_work.create.team',

            'daily_work.submit.self',
            'daily_work.approve.team',

            'daily_work.create.self',
            'daily_work.edit.self',
            'daily_work.reject.team',

            // LEAVE
            'leave.view.self',
            'leave.view.team',
            'leave.view.all',

            'leave.apply.self',
            'leave.edit.self',

            'leave.approve.team',
            'leave.approve.all',

            'leave.reject.team',
            'leave.reject.all',

            'leave.export.all',

            // PERFORMANCE
            'performance.view.self',
            'performance.view.team',
            'performance.view.all',

            'performance.create.team',
            'performance.edit.team',
            'performance.rate.self',
            'performance.rate.team',
            'performance.manage.all',

            'performance.export.all',
            'performance.report.view.all',

            // REPORTS
            'report.view',
            'report.export.excel',
            'report.export.pdf',
            'report.print',

            // ROLES
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // PERMISSIONS
            'permission.view',
            'permission.assign',
            'permission.edit',

            // SETTINGS
            'settings.view',
            'settings.edit',
        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web'
        ]);

        $hr = Role::firstOrCreate([
            'name' => 'hr',
            'guard_name' => 'web'
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'manager',
            'guard_name' => 'web'
        ]);

        $employee = Role::firstOrCreate([
            'name' => 'employee',
            'guard_name' => 'web'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        $superAdmin->syncPermissions(
            Permission::all()
        );

        /*
        |--------------------------------------------------------------------------
        | HR
        |--------------------------------------------------------------------------
        */

        $hr->syncPermissions([

            'dashboard.view',

            'employee.view.all',
            'employee.create.all',
            'employee.edit.all',
            'employee.delete.all',
            'employee.export.all',

            'attendance.view.all',
            'attendance.approve.all',
            'attendance.edit.all',
            'attendance.export.all',

            'salary.view.all',
            'salary.manage.all',
            'salary.edit.all',
            'salary.generate.all',
            'salary.export.all',

            'leave.view.all',
            'leave.approve.all',
            'leave.reject.all',
            'leave.export.all',

            'performance.view.all',
            'performance.manage.all',
            'performance.export.all',
            'performance.report.view.all',

            'report.view',
            'report.export.excel',
            'report.export.pdf',

            'role.view',
        ]);

        /*
        |--------------------------------------------------------------------------
        | MANAGER
        |--------------------------------------------------------------------------
        */

        $manager->syncPermissions([

            'dashboard.view',

            'employee.view.team',

            'attendance.mark.team',
            'attendance.approve.team',

            'daily_work.create.team',
            'daily_work.approve.team',
            'daily_work.reject.team',

            'performance.view.team',
            'performance.create.team',
            'performance.edit.team',

            'report.view',
        ]);

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE
        |--------------------------------------------------------------------------
        */

        $employee->syncPermissions([

            'dashboard.view',

            'employee.view.self',
            'employee.profile.view.self',

            'attendance.view.self',
            'attendance.mark.self',

            'daily_work.view.self',
            'daily_work.create.self',
            'daily_work.edit.self',
            'daily_work.submit.self',

            'leave.view.self',
            'leave.apply.self',
            'leave.edit.self',

            'salary.view.self',
            'salary.payslip.download.self',

            'performance.view.self',
            'performance.export.all',
            'performance.report.view.all',
            'password.change.self',
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
