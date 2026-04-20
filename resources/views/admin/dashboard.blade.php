@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold">Admin Dashboard</h2>
            <p class="text-muted">Welcome back, {{ Auth::user()->name }}! Here is your system overview.</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2 class="display-6 fw-bold">{{ $stats['total_users'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Departments</h5>
                    <h2 class="display-6 fw-bold">{{ $stats['total_departments'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Job Positions</h5>
                    <h2 class="display-6 fw-bold">{{ $stats['total_positions'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Employees</h5>
                    <h2 class="display-6 fw-bold">{{ $stats['total_employees'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">Departments</h4>
                    <p class="card-text text-muted">Manage company departments and structural units.</p>
                    <a href="{{ route('departments.index') }}" class="btn btn-outline-primary">Manage Departments</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">Positions</h4>
                    <p class="card-text text-muted">Define job titles and organizational roles.</p>
                    <a href="{{ route('positions.index') }}" class="btn btn-outline-primary">Manage Positions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">System Users</h4>
                    <p class="card-text text-muted">Manage HR and Admin login credentials.</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-primary">Manage Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection