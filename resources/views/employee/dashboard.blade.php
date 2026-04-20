@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold">My Dashboard</h2>
            <p class="text-muted">Welcome back, {{ $employee->first_name }}!</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center pt-4">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                        {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                    </div>
                    <h5 class="fw-bold mb-1">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                    <p class="text-muted mb-3">{{ $employee->position->position_name }}</p>
                    
                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item px-0">
                            <strong>Employee ID:</strong> <span class="float-end">{{ $employee->employee_id }}</span>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Department:</strong> <span class="float-end badge bg-info text-dark">{{ $employee->department->department_name }}</span>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Status:</strong> <span class="float-end badge bg-success">{{ $employee->employment_status }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100 bg-light">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary"><i class="fas fa-clock"></i> Today's Attendance</h5>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show p-2 mb-2" role="alert">
                                    <small>{{ session('success') }}</small>
                                    <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(!$todayAttendance)
                                <p class="text-muted small">You haven't logged in for today.</p>
                                <h3 class="mt-3 mb-4 text-muted">-- : --</h3>
                                <form action="{{ route('employee.timeIn') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100 shadow-sm">Time In Now</button>
                                </form>

                            @elseif($todayAttendance && !$todayAttendance->time_out)
                                <p class="text-muted small">You are currently clocked in.</p>
                                <h3 class="mt-3 mb-4 text-success">
                                    {{ \Carbon\Carbon::parse($todayAttendance->time_in)->format('h:i A') }}
                                </h3>
                                <form action="{{ route('employee.timeOut') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning w-100 shadow-sm">Time Out</button>
                                </form>

                            @else
                                <p class="text-muted small">Shift completed for today.</p>
                                <div class="d-flex justify-content-between mt-3 mb-4">
                                    <div>
                                        <small class="text-muted d-block">Time In</small>
                                        <h5 class="text-success">{{ \Carbon\Carbon::parse($todayAttendance->time_in)->format('h:i A') }}</h5>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block">Time Out</small>
                                        <h5 class="text-danger">{{ \Carbon\Carbon::parse($todayAttendance->time_out)->format('h:i A') }}</h5>
                                    </div>
                                </div>
                                <button class="btn btn-secondary w-100 shadow-sm" disabled>Completed</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100 bg-light">
                        <div class="card-body">
                            <h5 class="fw-bold text-success"><i class="fas fa-chart-line"></i> Latest Evaluation</h5>
                            
                            @if($latestEvaluation)
                                <p class="text-muted small">
                                    Last reviewed on: {{ \Carbon\Carbon::parse($latestEvaluation->evaluation_date)->format('M d, Y') }}
                                </p>
                                <div class="display-6 fw-bold text-success mt-2 mb-3">
                                    {{ number_format($latestEvaluation->rating, 1) }} <span class="fs-4 text-muted">/ 5.0</span>
                                </div>
                                <p class="small text-muted fst-italic border-start border-success border-3 ps-2">
                                    "{{ Str::limit($latestEvaluation->remarks, 60) }}"
                                </p>
                            @else
                                <p class="text-muted small">Last reviewed on: N/A</p>
                                <div class="display-6 fw-bold text-muted mt-2 mb-3">-- / 5.0</div>
                                <p class="small text-muted">No evaluations have been recorded yet.</p>
                            @endif
                            
                            <a href="{{ route('employee.performance.history') }}" class="btn btn-outline-success w-100 mt-auto">View Full History</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white fw-bold">
                            Contact Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Email Address</small>
                                    <strong>{{ $user->email }}</strong>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Contact Number</small>
                                    <strong>{{ $employee->contact_number }}</strong>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <small class="text-muted d-block">Home Address</small>
                                    <strong>{{ $employee->address }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection