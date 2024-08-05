<!-- resources/views/evaluations/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Evaluations</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Reviewer</th>
                <th>Review Of</th>
                <th>Review Date</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->id }}</td>
                    <td>{{ $evaluation->reviewer->name }}</td>
                    <td>{{ $evaluation->reviewedUser->name }}</td>
                    <td>{{ $evaluation->review_year_month }}</td>
                    <td>{{ $evaluation->department }}</td>
                    <td>{{ $evaluation->designation }}</td>
                    <td>
                        <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
