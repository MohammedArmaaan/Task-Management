<?php
namespace App\Http\Controllers;

use App\Models\TasksInfo;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AppUserController extends SNMResponse
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string',
            'user_email' => 'required|email|unique:user_infos,user_email',
            'user_password' => 'required|string',
            'user_role' => 'required|in:admin,employee',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {
            $user = UserInfo::create([
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_password' => Hash::make($request->user_password),
                'user_role' => $request->user_role,
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse([
                'access_token' => $token,
                'user' => $user,
            ], 'User registered successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse([
                // 'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_email' => 'required|email',
            'user_password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        $user = UserInfo::where('user_email', $request->user_email)->first();

        if (!$user || !Hash::check($request->user_password, $user->user_password)) {
            return $this->errorResponse('Invalid email or password', 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->successResponse(
            ['user' => $user],
            'Login successful',
            200,
            ['access_token' => $token]
        );
    }
    // public function logout($id)
    // {
    //     $user = UserInfo::find($id);
    //     if (!$user) {
    //         return $this->errorResponse('User not found', 404);
    //     }
    //     $user->tokens()->delete();
    //     return $this->successResponse([], "User ID {$id} has been logged out", 200);
    // }
    // Use Authenticated User Instead of Passing $id
    // Route::post('/logout', [AppUserController::class, 'logout'])->middleware('auth:sanctum');
   
    
    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user(); 
        if (!$user) {
            return $this->errorResponse('User not authenticated', 401);
        }
        $user->tokens()->delete();
        return $this->successResponse([], "User ID {$user->id} has been logged out", 200);
    }
    public function viewEmployees()
    {
        $employees = UserInfo::where('user_role', 'employee')->get();
        return $this->successResponse(
            ['employees' => $employees],
            'Employees fetched successfully',
            200
        );
    }
    public function viewAssignedTasks(Request $request)
    {
        $user = $request->user();
        $tasks = TasksInfo::where('task_assigned_to', $user->id)->get();
        return $this->successResponse(
            ['tasks' => $tasks],
            'Assigned tasks fetched successfully'
        );
    }
    public function updateTaskStatus(Request $request, $id)
    {
        $request->validate([
            'task_status' => 'required|in:pending,process,completed'
        ]);
        $user = $request->user();
        $task = TasksInfo::where('id', $id)
            ->where('task_assigned_to', $user->id)
            ->first();
        if (!$task) {
            return $this->errorResponse('Task not found or not assigned to this user.', 404);
        }
        $task->task_status = $request->task_status;
        $task->save();
        return $this->successResponse(
            ['task' => $task],
            'Task status updated successfully'
        );
    }
}