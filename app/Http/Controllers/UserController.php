<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. List all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // 2. View a specific user's details
    public function show(User $user)
    {
        // If they have an employee record, load it so we can show it!
        $user->load('employee.department', 'employee.position');
        return view('admin.users.show', compact('user'));
    }

    // 3. Show the edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 4. Save the updates
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,hr,employee',
            'status' => 'required|in:active,inactive',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'User account updated successfully!');
    }
}