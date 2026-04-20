<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Show the Edit Form
    public function edit(Attendance $attendance)
    {
        // Load the associated employee data so we can display their name
        $attendance->load('employee');
        return view('hr.attendance.edit', compact('attendance'));
    }

    // Save the Changes
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'time_in' => 'required',
            'time_out' => 'nullable', // Nullable because they might not have timed out yet
            'status' => 'required|string',
        ]);

        $attendance->update([
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
            'status' => $request->status,
        ]);

        // Send them back to the HR Dashboard after updating
        return redirect()->route('hr.dashboard')->with('success', 'Attendance record updated successfully!');
    }
}