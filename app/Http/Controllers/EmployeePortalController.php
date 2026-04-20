<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon; // Laravel's built-in date/time helper

class EmployeePortalController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $employee = $user->employee()->with(['department', 'position'])->first();

        if (!$employee) {
            return redirect('/login')->with('error', 'No employee profile linked to this account.');
        }

        // Check if the employee has an attendance record for TODAY
        $todayAttendance = Attendance::where('employee_id', $employee->id)
                                     ->where('date', Carbon::today()->toDateString())
                                     ->first();

        // Fetch their most recent performance evaluation
        $latestEvaluation = $employee->performances()->orderBy('evaluation_date', 'desc')->first();

        // Add 'latestEvaluation' to the compact list!
        return view('employee.dashboard', compact('user', 'employee', 'todayAttendance', 'latestEvaluation'));
    }

    public function timeIn(Request $request)
    {
        $employee = Auth::user()->employee;

        Attendance::create([
            'employee_id' => $employee->id,
            'date' => Carbon::today()->toDateString(),
            'time_in' => Carbon::now()->toTimeString(),
            'status' => 'Present',
        ]);

        return redirect()->back()->with('success', 'Successfully timed in!');
    }

    public function timeOut(Request $request)
    {
        $employee = Auth::user()->employee;

        $attendance = Attendance::where('employee_id', $employee->id)
                                ->where('date', Carbon::today()->toDateString())
                                ->first();

        if ($attendance && !$attendance->time_out) {
            $attendance->update([
                'time_out' => Carbon::now()->toTimeString()
            ]);
        }

        return redirect()->back()->with('success', 'Successfully timed out!');
    }
    public function performanceHistory()
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect('/login')->with('error', 'No employee profile linked to this account.');
        }

        // Fetch all evaluations, newest first
        $evaluations = $employee->performances()->orderBy('evaluation_date', 'desc')->get();

        return view('employee.performance_history', compact('evaluations'));
    }
}