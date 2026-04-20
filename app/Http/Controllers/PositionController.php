<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
public function index()
    {
        $positions = \App\Models\Position::all();
        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'position_name' => 'required|string|max:255|unique:positions',
        ]);

        \App\Models\Position::create($request->all());

        return redirect()->route('positions.index')->with('success', 'Position created successfully!');
    }

    public function edit(\App\Models\Position $position)
    {
        return view('admin.positions.edit', compact('position'));
    }

    public function update(Request $request, \App\Models\Position $position)
    {
        $request->validate([
            'position_name' => 'required|string|max:255|unique:positions,position_name,' . $position->id,
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')->with('success', 'Position updated successfully!');
    }

    public function destroy(\App\Models\Position $position)
    {
        // HR Safeguard
        if ($position->employees()->count() > 0) {
            return redirect()->route('positions.index')
                             ->with('error', 'Cannot delete: Employees currently hold this position.');
        }

        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Position deleted successfully!');
    }
}
