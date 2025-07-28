<?php
namespace App\Http\Controllers;

use App\Models\AttendanceInfo;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function markPresent(Request $request)
    {
        $user = Auth::guard('user')->user();
        $today = Carbon::now('Asia/Kolkata')->toDateString();
        $alreadyMarked = AttendanceInfo::where('user_id', $user->id)
            ->where('date', $today)
            ->first();
        if ($alreadyMarked) {
            return back()->with('error', 'Already marked present today.');
        }
        AttendanceInfo::create([
            'user_id' => $user->id,
            'date' => $today,
            'present_time' => Carbon::now('Asia/Kolkata'),
        ]);
        return back()->with('success', 'You are marked present successfully.');
    }
    public function checkIn()
    {
        session(['is_check_in' => true, 'is_break' => false]);
        return back()->with('success', 'Checked In!');
    }
    public function checkOut()
    {
        session(['is_check_in' => false, 'is_break' => true]);
        return back()->with('success', 'Checked Out for Break!');
    }
    public function goingHome(Request $request)
    {
        $user = Auth::guard('user')->user();
        $today = now('Asia/Kolkata')->format('Y-m-d');
        $record = AttendanceInfo::firstOrCreate([
            'user_id' => $user->id,
            'date' => $today,
        ]);
        $record->update([
            'going_time' => now('Asia/Kolkata'),
            'total_work_seconds' => intval($request->input('work_seconds', 0)),
            'total_break_seconds' => intval($request->input('break_seconds', 0)),
        ]);
        session()->forget(['check_in_seconds', 'break_seconds', 'is_check_in', 'is_break']);
        session([
            'total_working_time' => gmdate('H:i:s', intval($request->input('work_seconds', 0)))
        ]);
        return back()->with('success', 'Day ended. Times stored!');
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
        $users = UserInfo::where('user_role', 'employee')->get();
        return view('Admin.admin', compact('attendances', 'users'));
    }
}