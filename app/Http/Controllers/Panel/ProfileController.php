<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('panel.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'password');
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'Current password is incorrect'
                ])
                ->withInput()
                ->with('active_tab', 'password');
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Password updated successfully')
            ->with('active_tab', 'profile');
    }
}
