<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Gather system overview statistics
        $stats = [
            'total_users' => User::count(),
            'total_departments' => Department::count(),
            'total_positions' => Position::count(),
            'total_employees' => Employee::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}