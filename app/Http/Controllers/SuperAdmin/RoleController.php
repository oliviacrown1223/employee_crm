<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('SuperAdmin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('SuperAdmin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index');
    }
    public function edit($id)
    {
        $role = Role::findById($id);

        // EMPLOYEE ROLE
        if ($role->name == 'employee') {

            $permissions = Permission::where('name', 'LIKE', '%.self')
                ->get()
                ->groupBy(function ($permission) {

                    return explode('.', $permission->name)[0];

                });

        }

        // MANAGER ROLE
        elseif ($role->name == 'manager') {

            $permissions = Permission::where('name', 'LIKE', '%.team')
                ->get()
                ->groupBy(function ($permission) {

                    return explode('.', $permission->name)[0];

                });

        }

        // HR ROLE
        elseif ($role->name == 'hr') {

            $permissions = Permission::where('name', 'LIKE', '%.all')
                ->get()
                ->groupBy(function ($permission) {

                    return explode('.', $permission->name)[0];

                });

        }

        // SUPER ADMIN
        else {

            $permissions = Permission::all()
                ->groupBy(function ($permission) {

                    return explode('.', $permission->name)[0];

                });

        }

        return view('SuperAdmin.roles.edit', compact(
            'role',
            'permissions'
        ));
    }
    public function update(Request $request, $id)
    {
        $role = Role::findById($id);

        $newPermissions = $request->permissions ?? [];



        /*
        |--------------------------------------------------------------------------
        | CURRENT ROLE PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $currentPermissions = $role->permissions
            ->pluck('name')
            ->toArray();



        /*
        |--------------------------------------------------------------------------
        | ADD NEW PERMISSIONS
        |--------------------------------------------------------------------------
        */

        foreach ($newPermissions as $permission) {

            if (!$role->hasPermissionTo($permission)) {

                $role->givePermissionTo($permission);

            }
        }



        /*
        |--------------------------------------------------------------------------
        | REMOVE UNCHECKED PERMISSIONS
        |--------------------------------------------------------------------------
        */

        foreach ($currentPermissions as $permission) {

            if (!in_array($permission, $newPermissions)) {

                $role->revokePermissionTo($permission);

            }
        }



        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN LIVE SYNC
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::findByName('super-admin');



        // IF CURRENT ROLE IS NOT SUPER ADMIN
        if ($role->name != 'super-admin') {

            /*
            |--------------------------------------------------------------------------
            | ADD CHECKED TO SUPER ADMIN
            |--------------------------------------------------------------------------
            */

            foreach ($newPermissions as $permission) {

                if (!$superAdmin->hasPermissionTo($permission)) {

                    $superAdmin->givePermissionTo($permission);

                }
            }



            /*
            |--------------------------------------------------------------------------
            | REMOVE UNCHECKED FROM SUPER ADMIN
            |--------------------------------------------------------------------------
            */

            foreach ($currentPermissions as $permission) {

                if (!in_array($permission, $newPermissions)) {

                    if ($superAdmin->hasPermissionTo($permission)) {

                        $superAdmin->revokePermissionTo($permission);

                    }
                }
            }
        }
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();


        return redirect()
            ->route('roles.index')
            ->with('success', 'Permissions Updated Successfully');
    }
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // REMOVE ALL PERMISSIONS FROM ROLE
        $role->syncPermissions([]);

        // DELETE ROLE
        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
