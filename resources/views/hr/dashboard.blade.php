@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold">Human Resources Dashboard</h2>
            <p class="text-muted">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase fw-bold text-white-50">Total Employees</h6>
                    <h1 class="display-5 fw-bold mb-0">{{ $totalEmployees }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase fw-bold text-white-50">Present Today</h6>
                    <h1 class="display-5 fw-bold mb-0">{{ $presentToday }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase fw-bold text-white-50">Absent Today</h6>
                    <h1 class="display-5 fw-bold mb-0">{{ $absentToday }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-list-check"></i> Today's Attendance Logs</h5>
            <span class="badge bg-secondary">{{ \Carbon\Carbon::today()->format('F d, Y') }}</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Employee</th>
                            <th class="px-4 py-3">Department</th>
                            <th class="px-4 py-3">Time In</th>
                            <th class="px-4 py-3">Time Out</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($todaysRecords as $record)
                            <tr>
                                <td class="px-4 align-middle">
                                    <div class="fw-bold">{{ $record->employee->last_name }}, {{ $record->employee->first_name }}</div>
                                    <small class="text-muted">{{ $record->employee->position->position_name }}</small>
                                </td>
                                <td class="px-4 align-middle">
                                    <span class="badge bg-info text-dark">{{ $record->employee->department->department_name }}</span>
                                </td>
                                <td class="px-4 align-middle text-success fw-bold">
                                    {{ \Carbon\Carbon::parse($record->time_in)->format('h:i A') }}
                                </td>
                                <td class="px-4 align-middle text-danger fw-bold">
                                    {{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->format('h:i A') : '--:--' }}
                                </td>
                                <td class="px-4 align-middle">
                                    @if(!$record->time_out)
                                        <span class="badge bg-warning text-dark">Active Shift</span>
                                    @else
                                        <span class="badge bg-success">Completed</span>
                                    @endif
                                </td>
                                <td class="px-4 text-end align-middle">
                                    <a href="{{ route('attendance.edit', $record->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    No attendance records found for today.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection