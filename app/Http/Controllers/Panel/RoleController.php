<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('panel.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()
            ->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });

        return view('panel.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($request->permissions ?? []);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $rolePermissions = $this->defaultPermissionsForRole($role->name);

        $permissions = Permission::whereIn('name', $rolePermissions)
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });

        return view('panel.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->permissions()->detach();

        $role->syncPermissions($request->permissions ?? []);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'super-admin') {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Super Admin role cannot be deleted.');
        }

        $role->syncPermissions([]);

        $role->delete();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
    private function defaultPermissionsForRole($roleName)
    {
        if ($roleName == 'super-admin') {
            return Permission::pluck('name')->toArray();
        }

        if ($roleName == 'hr') {
            return [


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


                'performance.view.all',
                'performance.manage.all',
                'performance.export.all',
                'performance.report.view.all',

                'report.view',
                'report.export.excel',
                'report.export.pdf',

                'role.view',
            ];
        }

        if ($roleName == 'manager') {
            return [


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
            ];
        }

        if ($roleName == 'employee') {
            return [

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
            ];
        }

        return [];
    }
}
