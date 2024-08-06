<!-- resources/views/questions/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Question</h1>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <textarea name="question" class="form-control" id="question" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" id="status" required>
        </div>
        <div class="form-group">
            <label for="sections">Sections</label>
            <select name="sections[]" id="sections" class="form-control" multiple>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
