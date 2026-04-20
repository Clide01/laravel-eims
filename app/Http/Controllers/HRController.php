<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class HRController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today()->toDateString();

        // 1. Calculate Quick Statistics
        $totalEmployees = Employee::count();
        $presentToday = Attendance::where('date', $today)->count();
        $absentToday = $totalEmployees - $presentToday; // Simple calculation for now

        // 2. Fetch Today's Live Attendance Records
        // We use 'with' to eagerly load the linked Employee, Department, and Position data
        $todaysRecords = Attendance::with(['employee.department', 'employee.position'])
                                   ->where('date', $today)
                                   ->orderBy('time_in', 'desc')
                                   ->get();

        return view('hr.dashboard', compact(
            'totalEmployees', 
            'presentToday', 
            'absentToday', 
            'todaysRecords'
        ));
    }
}