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
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Nepali Month</title>
</head>
<body>
    <label for="nepali-month">Select Nepali Month:</label>
    <select id="nepali-month" name="nepali-month">
        <option value="baishakh">बैशाख</option>
        <option value="jestha">जेठ</option>
        <option value="ashadh">आषाढ</option>
        <option value="shrawan">श्रावण</option>
        <option value="bhadau">भदौ</option>
        <option value="ashwin">आश्वयुज</option>
        <option value="kartik">कातिक</option>
        <option value="magh">माघ</option>
        <option value="falgun">फाल्गुन</option>
        <option value="chait">चैत</option>
        <option value="gauri">गौरी</option>
    </select>

    <script>
        document.getElementById('nepali-month').addEventListener('change', function() {
            const selectedMonth = this.value;
            console.log('Selected Nepali Month:', selectedMonth);
            // You can use the selected month value for further processing
        });
    </script>
</body>
</html> --}}
