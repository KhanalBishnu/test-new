@extends('layouts.app')

@section('content')
<style>
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container mt-4">
    <div class="row">
        <!-- Evaluation Card -->
        <div class="col-md-4 my-2">
            <div class="card card-hover">
                <div class="card-body text-center">
                    <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                    <h5 class="card-title">Own Evaluation</h5>
                    <p class="card-text">View Own Evaluation.</p>
                    <a href="{{ route('evaluations.index') }}" class="btn btn-primary">Go to Evaluations</a>
                </div>
            </div>
        </div>
    
        <!-- Employee Evaluation Card -->
        <div class="col-md-4 my-2">
            <div class="card card-hover">
                <div class="card-body text-center">
                    <i class="fas fa-user-check fa-3x mb-3"></i>
                    <h5 class="card-title">Employee Evaluation</h5>
                    <p class="card-text">Manage employee evaluations.</p>
                    <a href="{{ route('employee-evaluations.index') }}" class="btn btn-primary">Go to Employee Evaluations</a>
                </div>
            </div>
        </div>
    
        <!-- Question Management Card -->
        <div class="col-md-4 my-2">
            <div class="card card-hover">
                <div class="card-body text-center">
                    <i class="fas fa-question-circle fa-3x mb-3"></i>
                    <h5 class="card-title">Question Management</h5>
                    <p class="card-text">Manage questions for evaluations.</p>
                    <a href="{{ route('questions.index') }}" class="btn btn-primary">Go to Questions</a>
                </div>
            </div>
        </div>
    
        <!-- Section Management Card -->
        <div class="col-md-4 my-2">
            <div class="card card-hover">
                <div class="card-body text-center">
                    <i class="fas fa-th-list fa-3x mb-3"></i>
                    <h5 class="card-title">Section Management</h5>
                    <p class="card-text">Manage sections for evaluations.</p>
                    <a href="{{ route('sections.index') }}" class="btn btn-primary">Go to Sections</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
