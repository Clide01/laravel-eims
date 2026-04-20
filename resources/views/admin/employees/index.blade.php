@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-3 mt-3">
        <div class="col-md-6">
            <h2>Employee Directory</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Register New Employee
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">EMP ID</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email (Login)</th>
                            <th class="px-4 py-3">Department</th>
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td class="px-4 align-middle fw-bold text-secondary">{{ $employee->employee_id }}</td>
                                <td class="px-4 align-middle">
                                    {{ $employee->last_name }}, {{ $employee->first_name }}
                                </td>
                                <td class="px-4 align-middle text-muted">{{ $employee->user->email ?? 'No Account' }}</td>
                                <td class="px-4 align-middle">
                                    <span class="badge bg-info text-dark">{{ $employee->department->department_name }}</span>
                                </td>
                                <td class="px-4 align-middle">{{ $employee->position->position_name }}</td>
                                <td class="px-4 align-middle">
                                    <span class="badge bg-{{ $employee->employment_status === 'Regular' ? 'success' : 'warning' }}">
                                        {{ $employee->employment_status }}
                                    </span>
                                </td>
                                <td class="px-4 text-end align-middle">
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    No employees found. <a href="{{ route('employees.create') }}">Register one now.</a>
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