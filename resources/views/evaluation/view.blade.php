@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Evaluation Details</h1>
    <div class="card">
        <div class="card-header">
            Evaluation ID: {{ $evaluation->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Reviewer: {{ $evaluation->reviewer->name }}</h5>
            <p>Review Of: {{ $evaluation->reviewedUser->name }}</p>
            <p>Review Year/Month: {{ $evaluation->review_year_month }}</p>
            <p>Department: {{ $evaluation->department }}</p>
            <p>Current Goals and Responsibilities: {{ $evaluation->current_goals_responsibilities }}</p>
            <p>Completed Goals and Responsibilities: {{ $evaluation->completed_goals_responsibilities }}</p>
            <p>Strengths: {{ $evaluation->strengths }}</p>
            <p>Area of Improvement: {{ $evaluation->area_of_improvement }}</p>
            <p>Designation: {{ $evaluation->designation }}</p>
            <p>Question Answers:</p>
            <ul>
                @foreach(json_decode($evaluation->question_answers, true) as $question)
                    <li>{{ $question['question'] }} - {{ $question['answer'] }}</li>
                @endforeach
            </ul>
            <p>Reviews Comments: {{ $evaluation->reviews_comments }}</p>
            <p>Score Related Data: {{ $evaluation->score_related_data }}</p>
            <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
