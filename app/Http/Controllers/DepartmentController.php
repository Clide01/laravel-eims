<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // 1. Show the list of departments
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    // 2. Show the form to add a new department
    public function create()
    {
        return view('admin.departments.create');
    }

    // 3. Save the new department to the database
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255|unique:departments',
        ]);

        Department::create([
            'department_name' => $request->department_name
        ]);

        return redirect()->route('departments.index')
                         ->with('success', 'Department created successfully!');
    }
    
    // 4. Show the form to edit an existing department
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    // 5. Save the updated department to the database
    public function update(Request $request, Department $department)
    {
        // Notice the validation rule ignores the current department's ID for the unique check
        $request->validate([
            'department_name' => 'required|string|max:255|unique:departments,department_name,' . $department->id,
        ]);

        $department->update([
            'department_name' => $request->department_name
        ]);

        return redirect()->route('departments.index')
                         ->with('success', 'Department updated successfully!');
    }

    // 6. Delete the department from the database
    public function destroy(Department $department)
    {
        // HR Safeguard: Check if employees belong to this department before deleting
        if ($department->employees()->count() > 0) {
            return redirect()->route('departments.index')
                             ->with('error', 'Cannot delete: There are employees assigned to this department.');
        }

        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Department deleted successfully!');
    }
}