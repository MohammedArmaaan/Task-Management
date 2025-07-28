<?php

namespace App\Http\Controllers;

use App\Models\AttendanceInfo;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppAttendanceController extends SNMResponse
{
    public function markPresent(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return $this->errorResponse('Unauthenticated', 401);
        }
        $today = Carbon::now('Asia/Kolkata')->toDateString();
        $alreadyMarked = AttendanceInfo::where('user_id', $user->id)
            ->where('date', $today)
            ->exists();
        if ($alreadyMarked) {
            return $this->errorResponse('Already marked present today.', 409);
        }
        $attendance = AttendanceInfo::create([
            'user_id'      => $user->id,
            'date'         => $today,
            'present_time' => Carbon::now('Asia/Kolkata'),
        ]);
        return $this->successResponse($attendance, 'Marked present successfully');
    }

    public function checkIn(Request $request)
    {
        session([
            'is_check_in' => true,
            'is_break'    => false,
            'check_in_at' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
        ]);
        return $this->successResponse([
            'check_in_at' => session('check_in_at'),
        ], 'Checked In!', 200);
    }

    public function checkOut(Request $request)
    {
        session([
            'is_check_in' => false,
            'is_break'    => true,
            'break_at'    => Carbon::now('Asia/Kolkata')->toDateTimeString(),
        ]);
        return $this->successResponse([
            'break_at'    => session('break_at'),
        ], 'Checked Out for Break!', 200);
    }

    public function goingHome(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_seconds'  => 'required|integer|min:0',
            'break_seconds' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse(
                $validator->errors()->first(),
                422
            );
        }
        $user = $request->user();
        $today = Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $attendance = AttendanceInfo::firstOrCreate([
            'user_id' => $user->id,
            'date'    => $today,
        ]);
        $attendance->update([
            'going_time'          => Carbon::now('Asia/Kolkata'),
            'total_work_seconds'  => (int) $request->work_seconds,
            'total_break_seconds' => (int) $request->break_seconds,
        ]);
        return $this->successResponse(
            [
                'date'                => $today,
                'going_time'          => $attendance->going_time->format('H:i:s'),
                'total_work_seconds'  => $attendance->total_work_seconds,
                'total_break_seconds' => $attendance->total_break_seconds,
                'total_working_time'  => gmdate('H:i:s', $attendance->total_work_seconds),
                'total_break_time'    => gmdate('H:i:s', $attendance->total_break_seconds),
            ],
            'Day ended. Times stored!',
            200
        );
    }

    public function adminAttendanceList(Request $request)
    {
        $query = AttendanceInfo::with('user');
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('month')) {
            $month = Carbon::parse($request->month);
            $query->whereMonth('date', $month->month)
                ->whereYear('date', $month->year);
        }
        $attendances = $query->orderBy('date', 'desc')->get();
        $users = UserInfo::where('user_role', 'employee')->get(['id', 'user_name']);
        return $this->successResponse(
            [
                'attendances' => $attendances,
                'users' => $users,
            ],
            'Attendance list retrieved successfully',
            200
        );
    }
}