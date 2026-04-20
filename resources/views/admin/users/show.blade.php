@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">User Details</h4>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">Back to Users</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Name</div>
                        <div class="col-sm-8 fw-bold">{{ $user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email</div>
                        <div class="col-sm-8">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">System Role</div>
                        <div class="col-sm-8 text-uppercase">{{ $user->role }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Account Status</div>
                        <div class="col-sm-8">
                            <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </div>
                    </div>
                    
                    @if($user->employee)
                        <hr>
                        <h5 class="text-primary mt-3">Linked Employee Profile</h5>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted">Employee ID</div>
                            <div class="col-sm-8">{{ $user->employee->employee_id }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted">Department / Position</div>
                            <div class="col-sm-8">
                                {{ $user->employee->department->department_name }} / {{ $user->employee->position->position_name }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-light text-end">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning px-4">Edit User</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection