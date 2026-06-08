<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Employee;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use App\Models\User;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Validation\Rules\Password;
//
//class AuthController extends Controller
//{
//    public function showLogin()
//    {
//        return view('auth.login');
//    }
//
//    public function showAdminLogin()
//    {
//        return view('auth.admin-login');
//    }
//
//    public function login(Request $request)
//    {
//        $request->validate([
//
//            'email' => 'required|email',
//            'password' => 'required|min:6',
//
//        ]);
//
//        // USER FIND
//        $user = User::where('email', $request->email)->first();
//
//        // EMAIL CHECK
//        if (!$user) {
//
//            return back()->with('error', 'Email not found');
//        }
//
//        // PASSWORD CHECK
//        if (!Hash::check($request->password, $user->password)) {
//
//            return back()->with('error', 'Wrong password');
//        }
//
//        /**
//         * ===================================
//         * SUPER ADMIN LOGIN
//         * ===================================
//         */
//        if (request()->is('admin/login')) {
//
//            // ONLY SUPER ADMIN
//            if (!$user->hasRole('super-admin')) {
//
//                return back()->with('error', 'Only Super Admin Can Login Here');
//            }
//
//            Auth::login($user);
//
//            $request->session()->regenerate();
//
//            return redirect()->route('dashboard')
//                ->with('success', 'Super Admin Login Successful');
//        }
//
//        /**
//         * ===================================
//         * NORMAL LOGIN
//         * ===================================
//         */
//
//        // SUPER ADMIN BLOCK IN NORMAL LOGIN
//        if ($user->hasRole('super-admin')) {
//
//            return back()->with('error', 'Use Admin Login Page');
//        }
//
//        // LOGIN
//        Auth::login($user);
//
//        $request->session()->regenerate();
//
//        // HR
//        if ($user->hasRole('hr')) {
//
//            return redirect()->route('hr.dashboard')
//                ->with('success', 'HR Login Successful');
//        }
//
//        // MANAGER
//        if ($user->hasRole('manager')) {
//
//            return redirect()->route('manager.dashboard')
//                ->with('success', 'Manager Login Successful');
//        }
//
//        // EMPLOYEE
//        if ($user->hasRole('employee')) {
//
//            return redirect()->route('employee.dashboard')
//                ->with('success', 'Employee Login Successful');
//        }
//
//        return back()->with('error', 'Unauthorized Access');
//    }
//
//    public function updatePassword(Request $request)
//    {
//        $validator = \Validator::make($request->all(), [
//            'current_password' => 'required',
//            'new_password' => 'required|min:6|confirmed',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => 'error',
//                'errors' => $validator->errors()
//            ]);
//        }
//
//        $user = Auth::user();
//
//        if (!Hash::check($request->current_password, $user->password)) {
//            return response()->json([
//                'status' => 'error',
//                'errors' => [
//                    'current_password' => ['Current password is incorrect']
//                ]
//            ]);
//        }
//
//        $user->password = Hash::make($request->new_password);
//        $user->save();
//
//        return response()->json([
//            'status' => 'success',
//            'message' => 'Password updated successfully'
//        ]);
//    }
//
//    public function logout(Request $request)
//    {
//        $user = Auth::user(); // logout karta pela user lai lo
//
//        Auth::logout();
//
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//
//        $request->session()->flush();
//
//        /**
//         * SUPER ADMIN → admin login
//         */
//        if ($user && $user->hasRole('super-admin')) {
//            return redirect('/admin/login');
//        } else {
//            return redirect('/login');
//        }
//
//        /**
//         * OTHER USERS → normal login
//         */
//
//    }
//
//    public function profile()
//    {
//        return view('SuperAdmin.profile.index');
//    }
//
//    public function showEmployeeRegister()
//    {
//        return view('auth.employee_register');
//    }
//
//
//
//
//    public function employeeRegister(Request $request)
//    {
//        $request->validate([
//
//            'name'     => 'required|string|max:255',
//            'email'    => 'required|email|unique:users,email',
//            'password' => 'required|min:6',
//            'mobile'   => 'required|digits:10',
//
//        ]);
//
//        /**
//         * CREATE USER
//         */
//        $user = User::create([
//
//            'name'     => $request->name,
//            'email'    => $request->email,
//            'password' => Hash::make($request->password),
//
//        ]);
//
//        /**
//         * ASSIGN EMPLOYEE ROLE
//         */
//        $user->assignRole('employee');
//
//        /**
//         * CREATE EMPLOYEE
//         */
//        Employee::create([
//
//            'user_id' => $user->id,
//
//            'name'         => $request->name,
//            'email'        => $request->email,
//            'password'     => Hash::make($request->password),
//            'mobile'       => $request->mobile,
//
//            'department'   => null,
//            'designation'  => null,
//            'salary'       => null,
//            'joining_date' => null,
//            'address'      => null,
//            'photo'        => null,
//            'status'       => null,
//
//        ]);
//
//        return redirect('/login')
//            ->with('success', 'Employee registered successfully!');
//    }
//}


namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found')->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Wrong password')->withInput();
        }

        if (
            !$user->hasRole('super-admin') &&
            !$user->hasRole('hr') &&
            !$user->hasRole('manager') &&
            !$user->hasRole('employee')
        ) {
            return back()->with('error', 'Unauthorized role');
        }

        Auth::login($user);

        $request->session()->regenerate();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Login Successful');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flush();

        return redirect()->route('login');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }

    public function showEmployeeRegister()
    {
        return view('auth.employee_register');
    }

    public function employeeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'mobile' => 'required|digits:10',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('employee');

        Employee::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'department' => null,
            'designation' => null,
            'salary' => null,
            'joining_date' => null,
            'address' => null,
            'photo' => null,
            'status' => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Employee registered successfully!');
    }
}
