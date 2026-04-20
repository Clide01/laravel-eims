@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-primary">Edit Attendance Record</h4>
                    <a href="{{ route('hr.dashboard') }}" class="btn btn-sm btn-outline-secondary">Back to Dashboard</a>
                </div>
                <div class="card-body">
                    
                    <div class="alert alert-info border-0 shadow-sm mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted d-block">Employee</small>
                                <strong>{{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}</strong>
                                <span class="badge bg-secondary ms-2">{{ $attendance->employee->employee_id }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Record Date</small>
                                <strong>{{ \Carbon\Carbon::parse($attendance->date)->format('l, F d, Y') }}</strong>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Time In</label>
                                <input type="time" class="form-control" name="time_in" value="{{ $attendance->time_in }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Time Out</label>
                                <input type="time" class="form-control" name="time_out" value="{{ $attendance->time_out }}">
                                <small class="text-muted">Leave blank if shift is active.</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Daily Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                                    <option value="Late" {{ $attendance->status == 'Late' ? 'selected' : '' }}>Late</option>
                                    <option value="Half-Day" {{ $attendance->status == 'Half-Day' ? 'selected' : '' }}>Half-Day</option>
                                    <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-2">
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Update Timesheet</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection