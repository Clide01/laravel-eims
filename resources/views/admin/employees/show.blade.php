@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Employee Profile</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Directory
            </a>
            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">
                Edit Profile
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-2 text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px; font-size: 40px;">
                        {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                    </div>
                </div>
                <div class="col-md-10 d-flex align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</h3>
                        <p class="text-muted fs-5 mb-1">{{ $employee->position->position_name }}</p>
                        <span class="badge bg-info text-dark">{{ $employee->department->department_name }}</span>
                        <span class="badge bg-{{ $employee->employment_status === 'Regular' ? 'success' : 'warning' }}">{{ $employee->employment_status }}</span>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5 class="text-primary mb-3">Personal Information</h5>
                    <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($employee->gender) }}</p>
                    <p><strong>Birthdate:</strong> {{ \Carbon\Carbon::parse($employee->birthdate)->format('F d, Y') }}</p>
                    <p><strong>Address:</strong> {{ $employee->address }}</p>
                    <p><strong>Contact:</strong> {{ $employee->contact_number }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-primary mb-3">Account Information</h5>
                    <p><strong>System Email:</strong> {{ $employee->user->email ?? 'No linked account' }}</p>
                    <p><strong>Date Hired:</strong> {{ $employee->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection