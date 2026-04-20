@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Register New Employee</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        
                        <h5 class="text-primary mb-3">Account Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Company Email (For Login)</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <h5 class="text-primary mb-3">Personal Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="birthdate" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <h5 class="text-primary mb-3">Employment Details</h5>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Department</label>
                                <select name="department_id" class="form-select" required>
                                    <option value="" disabled selected>Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Position</label>
                                <select name="position_id" class="form-select" required>
                                    <option value="" disabled selected>Select Position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->position_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Employment Status</label>
                                <select name="employment_status" class="form-select" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Probationary">Probationary</option>
                                    <option value="Contractual">Contractual</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Register Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection