<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Wrong password');
        }

        Auth::login($user);
        $request->session()->regenerate();

        /**
         * SUPER ADMIN ALWAYS SEPARATE SYSTEM
         */
        if ($user->role === 'super_admin') {
            Auth::logout();
            return redirect('/admin/login')
                ->with('error', 'Use Admin Login Page');
        }

        /**
         * NORMAL USERS LOGIN
         */
        session()->flash('success', 'Login Successful');

        if ($user->role === 'hr') {
            return redirect()->route('hr.dashboard');
        }

        if ($user->role === 'manager') {
            return redirect()->route('manager.dashboard');
        }

        if ($user->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        return back()->with('error', 'Unauthorized access');
    }

    public function updatePassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'current_password' => ['Current password is incorrect']
                ]
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully'
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user(); // logout karta pela user lai lo

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flush();

        /**
         * SUPER ADMIN → admin login
         */
        if ($user && $user->hasRole('super-admin')) {
            return redirect('/admin/login');
        } else {
            return redirect('/login');
        }

        /**
         * OTHER USERS → normal login
         */

    }

    public function profile()
    {
        return view('SuperAdmin.profile.index');
    }

    public function showEmployeeRegister()
    {
        return view('auth.employee_register');
    }




    public function employeeRegister(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'mobile'   => 'required|digits:10',
        ]);

        /**
         * CREATE USER
         */
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /**
         * CREATE EMPLOYEE
         */
        Employee::create([

            // 🔥 MOST IMPORTANT
            'user_id' => $user->id,

            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'mobile'       => $request->mobile,

            'department'   => null,
            'designation'  => null,
            'salary'       => null,
            'joining_date' => null,
            'address'      => null,
            'photo'        => null,
            'status'       => null,
        ]);

        return redirect('/login')
            ->with('success', 'Employee registered successfully!');
    }
}
