@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-success"><i class="fas fa-star"></i> Employee Evaluation</h4>
                    <a href="{{ route('hr.dashboard') }}" class="btn btn-sm btn-outline-secondary">Back to Dashboard</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('performance.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Select Employee</label>
                            <select name="employee_id" class="form-select" required>
                                <option value="" disabled selected>Choose an employee...</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->last_name }}, {{ $emp->first_name }} ({{ $emp->employee_id }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Overall Rating</label>
                            
                            <div class="btn-group w-100 shadow-sm" role="group" aria-label="Performance Rating">
                                <input type="radio" class="btn-check" name="rating" id="rating1" value="1" required>
                                <label class="btn btn-outline-danger py-3 fw-bold" for="rating1">1<br><small class="fw-normal">Needs Improvement</small></label>

                                <input type="radio" class="btn-check" name="rating" id="rating2" value="2">
                                <label class="btn btn-outline-warning py-3 fw-bold" for="rating2">2<br><small class="fw-normal">Below Average</small></label>

                                <input type="radio" class="btn-check" name="rating" id="rating3" value="3">
                                <label class="btn btn-outline-secondary py-3 fw-bold" for="rating3">3<br><small class="fw-normal">Meets Expectations</small></label>

                                <input type="radio" class="btn-check" name="rating" id="rating4" value="4">
                                <label class="btn btn-outline-primary py-3 fw-bold" for="rating4">4<br><small class="fw-normal">Very Good</small></label>

                                <input type="radio" class="btn-check" name="rating" id="rating5" value="5">
                                <label class="btn btn-outline-success py-3 fw-bold" for="rating5">5<br><small class="fw-normal">Outstanding</small></label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Evaluation Remarks</label>
                            <textarea name="remarks" class="form-control" rows="4" required placeholder="Detail the employee's performance, achievements, and areas for improvement..."></textarea>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-5 shadow-sm">Submit Evaluation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection