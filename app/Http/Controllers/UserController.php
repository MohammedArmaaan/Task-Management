<?php

namespace App\Http\Controllers;

use App\Models\TasksInfo;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function viewEmployees()
    {
        $employees = UserInfo::where('user_role', 'employee')->get();
        return view('Employee.employee_list', compact('employees'));
    }

    public function viewAssignedTasks()
    {
        $user = Auth::guard('user')->user();
        $tasks = TasksInfo::where('task_assigned_to', $user->id)->get();

        return view('Employee.view_assigned_task', compact('tasks'));
    }

    public function updateTaskStatus(Request $request, $id)
    {
        $request->validate([
            'task_status' => 'required|in:pending,process,completed',
        ]);

        $task = TasksInfo::where('id', $id)
            ->where('task_assigned_to', Auth::guard('user')->id())
            ->firstOrFail();

        $task->task_status = $request->task_status;
        $task->save();

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }
}
