<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PerformanceController extends Controller
{
    // Show the evaluation form
    public function create()
    {
        // Get all active employees to populate the dropdown
        $employees = Employee::where('employment_status', '!=', 'Inactive')->orderBy('last_name')->get();
        return view('hr.performance.create', compact('employees'));
    }

    // Save the evaluation
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'rating' => 'required|numeric|min:1|max:5',
            'remarks' => 'required|string',
        ]);

        Performance::create([
            'employee_id' => $request->employee_id,
            'rating' => $request->rating,
            'remarks' => $request->remarks,
            'evaluation_date' => Carbon::today()->toDateString(), // Automatically sets to today
        ]);

        return redirect()->route('hr.dashboard')->with('success', 'Performance evaluation submitted successfully!');
    }
}