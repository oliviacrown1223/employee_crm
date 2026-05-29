<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{

    public function index()
    {
        return view('SuperAdmin.profile.index');
    }

    // UPDATE PROFILE
    public function updateProfile(Request $request)
    {

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        $user = Auth::user();

        $user->name  = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'Profile Updated Successfully');

    }

    // UPDATE PASSWORD
    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'current_password' => 'required',

            'new_password' => 'required|min:6|confirmed',

        ]);

        // VALIDATION ERROR
        if ($validator->fails()) {

            return response()->json([

                'errors' => $validator->errors()

            ], 422);

        }

        $user = Auth::user();

        // WRONG CURRENT PASSWORD
        if (!Hash::check($request->current_password, $user->password)) {

            return response()->json([

                'errors' => [

                    'current_password' => ['Current password is incorrect']

                ]

            ], 422);

        }

        // UPDATE PASSWORD
        $user->password = Hash::make($request->new_password);

        $user->save();

        return response()->json([

            'message' => 'Password Updated Successfully'

        ]);

    }

}
