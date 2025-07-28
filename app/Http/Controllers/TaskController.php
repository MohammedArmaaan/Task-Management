<?php

namespace App\Http\Controllers;

use App\Models\TasksInfo;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = TasksInfo::with(['assignee', 'creator'])->latest()->get();
        return view('Admin.task_list', compact('tasks'));
    }

    public function create()
    {
        $user = Auth::guard('user')->user();
        $users = UserInfo::all();
        return view('Admin.add_task', compact('users'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('user')->user();
        $isAdmin = $user->user_role === 'admin';
        $rules = [
            'task_title' => 'required|string|max:255',
            'task_description' => 'required|string',
            'task_due_date' => 'required|date',
            'task_priority' => 'required|in:low,medium,high',
        ];
        if ($isAdmin) {
            $rules['task_assigned_to'] = 'required|exists:user_infos,id';
        }
        $validated = $request->validate($rules);
        $task = new TasksInfo($validated);
        $task->task_status = 'pending';
        $task->task_created_by = $user->id;
        if (!$isAdmin) {
            $task->task_assigned_to = $user->id;
        }
        $task->save();
        if ($isAdmin) {
            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } 
        else {
            return redirect()->route('tasks.assigned')->with('success', 'Task created successfully.');
        }
    }

    public function show($id)
    {
        $task = TasksInfo::with(['assignee', 'creator'])->findOrFail($id);
        return view('Admin.show_task', compact('task'));
    }

    public function edit($id)
    {
        $task = TasksInfo::findOrFail($id);
        $users = UserInfo::all();
        return view('Admin.edit_task', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'task_title' => 'required|string|max:255',
            'task_description' => 'required|string',
            'task_due_date' => 'required|date',
            'task_priority' => 'required|in:low,medium,high',
            // 'task_status' => 'required|in:pending,process,completed',
            'task_assigned_to' => 'required|exists:user_infos,id',
        ]);
        $task = TasksInfo::findOrFail($id);
        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = TasksInfo::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}