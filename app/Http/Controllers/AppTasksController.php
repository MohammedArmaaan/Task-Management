<?php

namespace App\Http\Controllers;

use App\Models\TasksInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppTasksController extends SNMResponse
{
    public function index()
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user || $user->user_role !== 'admin') {
            return $this->errorResponse('Only admin can access this resource', 403);
        }

        $tasks = TasksInfo::with(['assignee', 'creator'])->latest()->get();
        return $this->successResponse(['tasks' => $tasks], 'Task list fetched');
    }


    public function store(Request $request)
    {
        $user = Auth::guard('sanctum')->user(); // Or your custom guard
        if (!$user) return $this->errorResponse('Unauthorized', 401);

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

        return $this->successResponse(['task' => $task], 'Task created successfully', 201);
    }

    public function show($id)
    {
        // $id here is the user ID (employee)
        $tasks = TasksInfo::with(['assignee', 'creator'])
            ->where('task_assigned_to', $id)
            ->latest()
            ->get();

        if ($tasks->isEmpty()) {
            return $this->errorResponse('No tasks found for this user', 404);
        }

        return $this->successResponse(['tasks' => $tasks], 'Tasks fetched for user');
    }


    public function update(Request $request, $id)
    {
        $user = Auth::guard('sanctum')->user();

        // Check if user is authenticated and is admin
        if (!$user || $user->user_role !== 'admin') {
            return $this->errorResponse('Only admin can update tasks', 403);
        }

        $task = TasksInfo::find($id);
        if (!$task) {
            return $this->errorResponse('Task not found', 404);
        }

        $validated = $request->validate([
            'task_title' => 'required|string|max:255',
            'task_description' => 'required|string',
            'task_due_date' => 'required|date',
            'task_priority' => 'required|in:low,medium,high',
            'task_assigned_to' => 'required|exists:user_infos,id',
        ]);

        $task->update($validated);

        return $this->successResponse(['task' => $task], 'Task updated successfully');
    }


    public function destroy($id)
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user || $user->user_role !== 'admin') {
            return $this->errorResponse('Only admin can delete tasks', 403);
        }

        $task = TasksInfo::find($id);
        if (!$task) {
            return $this->errorResponse('Task not found', 404);
        }

        $task->delete();

        return $this->successResponse([], 'Task deleted successfully');
    }
}
