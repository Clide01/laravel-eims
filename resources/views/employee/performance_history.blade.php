@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-success"><i class="fas fa-star"></i> Performance History</h2>
            <p class="text-muted">A complete record of your HR evaluations.</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3 text-center">Rating</th>
                            <th class="px-4 py-3">HR Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($evaluations as $eval)
                            <tr>
                                <td class="px-4 align-middle fw-bold text-secondary">
                                    {{ \Carbon\Carbon::parse($eval->evaluation_date)->format('F d, Y') }}
                                </td>
                                <td class="px-4 align-middle text-center">
                                    <div class="display-6 fw-bold text-success mb-0">
                                        {{ number_format($eval->rating, 1) }}
                                    </div>
                                    <small class="text-muted">/ 5.0</small>
                                </td>
                                <td class="px-4 align-middle w-50">
                                    <p class="mb-0 text-muted fst-italic">"{{ $eval->remarks }}"</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    No performance evaluations on record yet.
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