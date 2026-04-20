@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Add New Position</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('positions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="position_name" class="form-label">Position Name</label>
                            <input type="text" class="form-control @error('department_name') is-invalid @enderror" 
                                   id="position_name" name="position_name" value="{{ old('position_name') }}" required>
                            
                            @error('position_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save Position</button>
                        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection