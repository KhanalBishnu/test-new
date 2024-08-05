@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form id="evaluation-form" method="POST" action="{{ route('evaluations.update', $evaluation->id) }}">
        @csrf
        @method('PUT')

        <!-- Section 1: Basic Information -->
        <div class="form-section" id="section-1">
            <h4>Basic Information</h4>
            <div class="form-group">
                <label for="reviewer_id">Reviewer ID</label>
                <input type="number" name="reviewer_id" class="form-control" id="reviewer_id" value="{{ old('reviewer_id', $evaluation->reviewer_id) }}" required>
            </div>
            <div class="form-group">
                <label for="reviewer_data">Reviewer Data</label>
                <textarea name="reviewer_data" class="form-control" id="reviewer_data" rows="3" required>{{ old('reviewer_data', $evaluation->reviewer_data) }}</textarea>
            </div>
            <div class="form-group">
                <label for="review_of">Review Of (User ID)</label>
                <input type="number" name="review_of" class="form-control" id="review_of" value="{{ old('review_of', $evaluation->review_of) }}" required>
            </div>
            <div class="form-group">
                <label for="review_year_month">Review Year Month</label>
                <input type="month" name="review_year_month" class="form-control" id="review_year_month" value="{{ old('review_year_month', $evaluation->review_year_month) }}" required>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" name="department" class="form-control" id="department" value="{{ old('department', $evaluation->department) }}" required>
            </div>
        </div>

        <!-- Section 2: Additional Information -->
        <div class="form-section d-none" id="section-2">
            <h4>Additional Information</h4>
            <div class="form-group">
                <label for="current_goals_responsibilities">Current Goals and Responsibilities</label>
                <textarea name="current_goals_responsibilities" class="form-control" id="current_goals_responsibilities" rows="3" required>{{ old('current_goals_responsibilities', $evaluation->current_goals_responsibilities) }}</textarea>
            </div>
            <div class="form-group">
                <label for="completed_goals_responsibilities">Completed Goals and Responsibilities</label>
                <textarea name="completed_goals_responsibilities" class="form-control" id="completed_goals_responsibilities" rows="3" required>{{ old('completed_goals_responsibilities', $evaluation->completed_goals_responsibilities) }}</textarea>
            </div>
            <div class="form-group">
                <label for="strengths">Strengths</label>
                <textarea name="strengths" class="form-control" id="strengths" rows="3" required>{{ old('strengths', $evaluation->strengths) }}</textarea>
            </div>
            <div class="form-group">
                <label for="area_of_improvement">Area of Improvement</label>
                <textarea name="area_of_improvement" class="form-control" id="area_of_improvement" rows="3" required>{{ old('area_of_improvement', $evaluation->area_of_improvement) }}</textarea>
            </div>
            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" name="designation" class="form-control" id="designation" value="{{ old('designation', $evaluation->designation) }}" required>
            </div>
        </div>

        <!-- Section 3: Question Answers -->
        <div class="form-section d-none" id="section-3">
            <h4>Question Answers</h4>
            <div id="questions-container">
                @foreach (json_decode($evaluation->question_answers) as $index => $question)
                <div class="question-group">
                    <div class="form-group">
                        <label for="question_{{ $index }}">Question {{ $index + 1 }}</label>
                        <input type="text" name="question_answers[{{ $index }}][question]" class="form-control" id="question_{{ $index }}" value="{{ $question->question }}" required>
                    </div>
                    <div class="form-group">
                        <label>Answer</label>
                        @foreach (range(1, 5) as $value)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[{{ $index }}][answer]" id="answer_{{ $index }}_{{ $value }}" value="{{ $value }}" {{ $question->answer == $value ? 'checked' : '' }} required>
                            <label class="form-check-label" for="answer_{{ $index }}_{{ $value }}">{{ $value }}</label>
                        </div>
                        @endforeach
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[{{ $index }}][answer]" id="answer_{{ $index }}_na" value="NA" {{ $question->answer == 'NA' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="answer_{{ $index }}_na">NA</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary" id="add-question">Add Question</button>
        </div>

        <!-- Section 4: Comments and Scores -->
        <div class="form-section d-none" id="section-4">
            <h4>Comments and Scores</h4>
            <div class="form-group">
                <label for="reviews_comments">Review Comments</label>
                <textarea name="reviews_comments" class="form-control" id="reviews_comments" rows="3" required>{{ old('reviews_comments', $evaluation->reviews_comments) }}</textarea>
            </div>
            <div class="form-group">
                <label for="score_related_data">Score Related Data</label>
                <textarea name="score_related_data" class="form-control" id="score_related_data" rows="3" required>{{ old('score_related_data', $evaluation->score_related_data) }}</textarea>
            </div>
        </div>

        <div class="card-footer text-right">
            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
            <button type="button" class="btn btn-primary next-btn">Next</button>
            <button type="submit" class="btn btn-primary" id="submit-btn" style="display: none;">Update Evaluation</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentSection = 0;
        var sections = document.querySelectorAll('.form-section');
        var nextButton = document.querySelector('.next-btn');
        var prevButton = document.querySelector('.prev-btn');
        var submitButton = document.getElementById('submit-btn');
        var questionsContainer = document.getElementById('questions-container');

        function showSection(index) {
            sections.forEach((section, idx) => {
                section.classList.toggle('d-none', idx !== index);
            });
            submitButton.style.display = (index === sections.length - 1) ? 'inline-block' : 'none';
        }

        function validateSection(sectionIndex) {
            var valid = true;
            var inputs = sections[sectionIndex].querySelectorAll('input, textarea');

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            return valid;
        }

        nextButton.addEventListener('click', function() {
            if (validateSection(currentSection)) {
                if (currentSection < sections.length - 1) {
                    currentSection++;
                    showSection(currentSection);
                }
            }
        });

        prevButton.addEventListener('click', function() {
            if (currentSection > 0) {
                currentSection--;
                showSection(currentSection);
            }
        });

        document.getElementById('add-question').addEventListener('click', function() {
            var newIndex = questionsContainer.getElementsByClassName('question-group').length;
            var newQuestionGroup = document.createElement('div');
            newQuestionGroup.classList.add('question-group');
            newQuestionGroup.innerHTML = `
                <div class="form-group">
                    <label for="question_${newIndex + 1}">Question ${newIndex + 1}</label>
                    <input type="text" name="question_answers[${newIndex}][question]" class="form-control" id="question_${newIndex + 1}" required>
                </div>
                <div class="form-group">
                    <label>Answer</label>
                    ${[1, 2, 3, 4, 5].map(value => `
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_${value}" value="${value}" required>
                            <label class="form-check-label" for="answer_${newIndex + 1}_${value}">${value}</label>
                        </div>
                    `).join('')}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_na" value="NA" required>
                        <label class="form-check-label" for="answer_${newIndex + 1}_na">NA</label>
                    </div>
                </div>
                <button type="button" class="btn btn-danger remove-question">Remove</button>
            `;
            questionsContainer.appendChild(newQuestionGroup);
        });

        questionsContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-question')) {
                event.target.parentNode.remove();
            }
        });

        showSection(currentSection);
    });
</script>
@endsection
