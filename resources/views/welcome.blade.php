@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-5">
                    <h1 class="display-4 text-primary fw-bold mb-3">EIMS</h1>
                    <h2 class="h4 text-muted mb-4">Employee Information Management System</h2>
                    <hr class="my-4">
                    
                    <p class="lead mb-4">
                        Securely manage employee records, track attendance, and handle performance evaluations.
                    </p>

                    @guest
                        <a class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm" href="{{ route('login') }}" role="button">
                            Log In to System
                        </a>
                    @else
                        {{-- If they are already logged in, show a button to go back to their dashboard --}}
                        <a class="btn btn-success btn-lg px-5 rounded-pill shadow-sm" href="{{ url('/home') }}" role="button">
                            Return to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection