<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Required for database transactions

class EmployeeController extends Controller
{
    public function index()
    {
        // 'with' uses Eloquent relationships to pull the department and position names efficiently
        $employees = Employee::with(['department', 'position', 'user'])->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        // We need to send departments and positions to the view for the dropdown menus!
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        // 1. Validate all inputs
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|in:male,female,other',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'contact_number' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'employment_status' => 'required|string',
        ]);

        // 2. Use a Database Transaction to ensure both records are created safely
        DB::transaction(function () use ($request) {
            
            // A. Create the Login Credentials (User)
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make('password123'), // Default password for new employees
                'role' => 'employee',
                'status' => 'active',
            ]);

            // B. Create the HR Record (Employee) and link to the User ID
            Employee::create([
                'user_id' => $user->id,
                'employee_id' => 'EMP-' . date('Y') . '-' . str_pad($user->id, 4, '0', STR_PAD_LEFT), // Generates e.g., EMP-2026-0005
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
                'employment_status' => $request->employment_status,
            ]);
        });

        return redirect()->route('employees.index')->with('success', 'Employee registered successfully. Default password is password123.');
    }

    // Show specific employee details
    public function show(Employee $employee)
    {
        $employee->load('department', 'position', 'user');
        return view('admin.employees.show', compact('employee'));
    }

    // Show the edit form
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.employees.edit', compact('employee', 'departments', 'positions'));
    }

    // Save the updated employee data
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'employment_status' => 'required|string',
        ]);

        $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'employment_status' => $request->employment_status,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee record updated successfully!');
    }
}