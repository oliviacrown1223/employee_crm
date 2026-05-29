<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\DailyWork;

class TaskController extends Controller
{
    // ALL TASKS
    public function index()
    {

        $tasks = DailyWork::with('employee')
            ->latest()
            ->paginate(10);

        return view(
            'manager.tasks.index',
            compact('tasks')
        );
    }


    // APPROVE TASK
    public function approve($id)
    {
        $task = DailyWork::findOrFail($id);

        $task->status = 'Approved';

        $task->save();

        return redirect()
            ->back()
            ->with('success',
                'Task Approved Successfully');
    }


    // REJECT TASK
    public function reject($id)
    {
        $task = DailyWork::findOrFail($id);

        $task->status = 'Rejected';

        $task->save();

        return redirect()
            ->back()
            ->with('success',
                'Task Rejected Successfully');
    }
}
