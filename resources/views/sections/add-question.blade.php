@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">Add Questions to Section</div>
        <div class="card-body">
            <form action="{{ route('sections.storeQuestion', $section->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="question_ids" class="form-label">Select Questions</label>
                    <select name="question_ids[]" id="question_ids" class="form-control" multiple required>
                        @foreach($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Questions</button>
            </form>
        </div>
    </div>
</div>
@endsection
