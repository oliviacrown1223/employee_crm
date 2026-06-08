<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;;

use App\Models\SuperAdmin\Leave;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalEmployees = Employee::count();

        $presentToday = Attendance::whereDate('attendance_date', Carbon::today())
            ->count();

        $totalUsers = User::count();

        $pendingLeaves = Leave::where('approval_status', 'Pending')
            ->count();

        $myProfile = Employee::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();

        $latestEmployees = Employee::latest()
            ->take(5)
            ->get();

        return view('panel.dashboard.index', compact(
            'user',
            'totalEmployees',
            'presentToday',
            'totalUsers',
            'pendingLeaves',
            'myProfile',
            'latestEmployees'
        ));
    }
}
