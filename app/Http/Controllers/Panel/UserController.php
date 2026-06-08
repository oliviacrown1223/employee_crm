<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('panel.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', [
            'hr',
            'manager',
            'employee',
        ])->get();

        return view('panel.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        if (in_array($request->role, ['employee'])) {
            Employee::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'mobile' => '',
                    'department' => null,
                    'designation' => ucfirst($request->role),
                    'salary' => null,
                    'joining_date' => null,
                    'address' => null,
                    'photo' => null,
                    'status' => 'active',
                ]
            );
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', [
            'hr',
            'manager',
            'employee',
        ])->get();

        return view('panel.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->hasRole('super-admin')) {
            return back()->with('error', 'Super Admin user cannot be edited from here.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $user->syncRoles([$request->role]);

        Employee::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'designation' => ucfirst($request->role),
                'status' => 'active',
            ]
        );

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('super-admin')) {
            return back()->with('error', 'Super Admin user cannot be deleted.');
        }

        Employee::where('user_id', $user->id)->delete();

        $user->delete();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return back()->with('success', 'User deleted successfully.');
    }
}
