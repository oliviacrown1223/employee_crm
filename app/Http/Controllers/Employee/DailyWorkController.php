<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\DailyWork;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DailyWorkController extends Controller
{
    public function index()
    {
        $works = DailyWork::where('assigned_user_id', auth()->id())
            ->orWhere('user_id', auth()->id())
            ->latest()
            ->get();

        return view('employee.daily_work.index', compact('works'));
    }


    public function submit($id)
    {
        $work = DailyWork::findOrFail($id);

        $work->update([
            'status' => 'pending',
            'submitted_at' => now('Asia/Kolkata'),
        ]);

        return back()->with('success', 'Work submitted successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required',
            'task_description' => 'required',
            'hours_worked' => 'required|numeric',
            'work_date' => 'required|date',
        ]);

        DailyWork::create([
            'user_id' => Auth::id(),
            'task_title' => $request->task_title,
            'task_description' => $request->task_description,
            'hours_worked' => $request->hours_worked,
            'status' => 'draft',
        ]);

        return redirect()->route('employee.daily-work.index')
            ->with('success', 'Work created');
    }


}
