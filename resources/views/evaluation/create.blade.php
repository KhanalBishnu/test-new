@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form id="evaluation-form" method="POST" action="{{ route('evaluations.store') }}">
        @csrf
        
        <!-- Section 1: Basic Information -->
        <div class="card form-section mb-4" id="section-1">
            <div class="card-header">
                <h5>Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="reviewer_id">Reviewer ID</label>
                    <input type="number" name="reviewer_id" class="form-control" id="reviewer_id" value="{{ old('reviewer_id') }}" required>
                    @if ($errors->has('reviewer_id'))
                        <div class="invalid-feedback">{{ $errors->first('reviewer_id') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="reviewer_data">Reviewer Data</label>
                    <textarea name="reviewer_data" class="form-control" id="reviewer_data" rows="3" required>{{ old('reviewer_data') }}</textarea>
                    @if ($errors->has('reviewer_data'))
                        <div class="invalid-feedback">{{ $errors->first('reviewer_data') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="review_of">Review Of (User ID)</label>
                    <input type="number" name="review_of" class="form-control" id="review_of" value="{{ old('review_of') }}" required>
                    @if ($errors->has('review_of'))
                        <div class="invalid-feedback">{{ $errors->first('review_of') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="review_year_month">Review Year Month</label>
                    <input type="month" name="review_year_month" class="form-control" id="review_year_month" value="{{ old('review_year_month') }}" required>
                    @if ($errors->has('review_year_month'))
                        <div class="invalid-feedback">{{ $errors->first('review_year_month') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" name="department" class="form-control" id="department" value="{{ old('department') }}" required>
                    @if ($errors->has('department'))
                        <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                    @endif
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Section 2: Additional Information -->
        <div class="card form-section mb-4" id="section-2" style="display: none;">
            <div class="card-header">
                <h5>Additional Information</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="current_goals_responsibilities">Current Goals and Responsibilities</label>
                    <textarea name="current_goals_responsibilities" class="form-control" id="current_goals_responsibilities" rows="3" required>{{ old('current_goals_responsibilities') }}</textarea>
                    @if ($errors->has('current_goals_responsibilities'))
                        <div class="invalid-feedback">{{ $errors->first('current_goals_responsibilities') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="completed_goals_responsibilities">Completed Goals and Responsibilities</label>
                    <textarea name="completed_goals_responsibilities" class="form-control" id="completed_goals_responsibilities" rows="3" required>{{ old('completed_goals_responsibilities') }}</textarea>
                    @if ($errors->has('completed_goals_responsibilities'))
                        <div class="invalid-feedback">{{ $errors->first('completed_goals_responsibilities') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="strengths">Strengths</label>
                    <textarea name="strengths" class="form-control" id="strengths" rows="3" required>{{ old('strengths') }}</textarea>
                    @if ($errors->has('strengths'))
                        <div class="invalid-feedback">{{ $errors->first('strengths') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="area_of_improvement">Area of Improvement</label>
                    <textarea name="area_of_improvement" class="form-control" id="area_of_improvement" rows="3" required>{{ old('area_of_improvement') }}</textarea>
                    @if ($errors->has('area_of_improvement'))
                        <div class="invalid-feedback">{{ $errors->first('area_of_improvement') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" class="form-control" id="designation" value="{{ old('designation') }}" required>
                    @if ($errors->has('designation'))
                        <div class="invalid-feedback">{{ $errors->first('designation') }}</div>
                    @endif
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Section 3: Question Answers -->
        <div class="card form-section mb-4" id="section-3" style="display: none;">
            <div class="card-header">
                <h5>Question Answers</h5>
            </div>
            <div class="card-body" id="questions-container">
                <div class="question-group mb-4">
                    <div class="form-group">
                        <label for="question_1">Question 1</label>
                        <input type="text" name="question_answers[0][question]" class="form-control" id="question_1" required>
                    </div>

                    <div class="form-group">
                        <label for="answer_1">Answer 1</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[0][answer]" id="answer_1_1" value="1" required>
                            <label class="form-check-label" for="answer_1_1">1</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[0][answer]" id="answer_1_2" value="2" required>
                            <label class="form-check-label" for="answer_1_2">2</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[0][answer]" id="answer_1_3" value="3" required>
                            <label class="form-check-label" for="answer_1_3">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[0][answer]" id="answer_1_4" value="4" required>
                            <label class="form-check-label" for="answer_1_4">4</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[0][answer]" id="answer_1_5" value="5" required>
                            <label class="form-check-label" for="answer_1_5">5</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_answers[0][answer]" id="answer_1_na" value="NA" required>
                            <label class="form-check-label" for="answer_1_na">NA</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger remove-question">Remove</button>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary" id="add-question">Add Question</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Section 4: Comments and Scores -->
        <div class="card form-section mb-4" id="section-4" style="display: none;">
            <div class="card-header">
                <h5>Comments and Scores</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="reviews_comments">Review Comments</label>
                    <textarea name="reviews_comments" class="form-control" id="reviews_comments" rows="3" required>{{ old('reviews_comments') }}</textarea>
                    @if ($errors->has('reviews_comments'))
                        <div class="invalid-feedback">{{ $errors->first('reviews_comments') }}</div>
                    @endif
                </div>
    
                <div class="form-group">
                    <label for="score_related_data">Score Related Data</label>
                    <textarea name="score_related_data" class="form-control" id="score_related_data" rows="3" required>{{ old('score_related_data') }}</textarea>
                    @if ($errors->has('score_related_data'))
                        <div class="invalid-feedback">{{ $errors->first('score_related_data') }}</div>
                    @endif
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentSection = 0;
        var sections = document.querySelectorAll('.form-section');
        var nextButtons = document.querySelectorAll('.next-btn');
        var prevButtons = document.querySelectorAll('.prev-btn');
        var form = document.getElementById('evaluation-form');
    
        function showSection(index) {
            sections.forEach((section, idx) => {
                section.style.display = (idx === index) ? 'block' : 'none';
            });
        }
    
        function validateSection(sectionIndex) {
            var valid = true;
            var inputs = sections[sectionIndex].querySelectorAll('input, textarea, select');
    
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
            });
    
            return valid;
        }
    
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (validateSection(currentSection)) {
                    if (currentSection < sections.length - 1) {
                        currentSection++;
                        showSection(currentSection);
                    }
                }
            });
        });
    
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (currentSection > 0) {
                    currentSection--;
                    showSection(currentSection);
                }
            });
        });
    
        showSection(currentSection);
    
        // Add Question Button Logic
        document.getElementById('add-question').addEventListener('click', function() {
            var questionsContainer = document.getElementById('questions-container');
            var newIndex = questionsContainer.getElementsByClassName('question-group').length;
            var newQuestionGroup = document.createElement('div');
            newQuestionGroup.classList.add('question-group');
    
            newQuestionGroup.innerHTML = `
                <div class="form-group">
                    <label for="question_${newIndex + 1}">Question ${newIndex + 1}</label>
                    <input type="text" name="question_answers[${newIndex}][question]" class="form-control" id="question_${newIndex + 1}" required>
                </div>
                <div class="form-group">
                    <label for="answer_${newIndex + 1}">Answer ${newIndex + 1}</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_1" value="1" required>
                        <label class="form-check-label" for="answer_${newIndex + 1}_1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_2" value="2" required>
                        <label class="form-check-label" for="answer_${newIndex + 1}_2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_3" value="3" required>
                        <label class="form-check-label" for="answer_${newIndex + 1}_3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_4" value="4" required>
                        <label class="form-check-label" for="answer_${newIndex + 1}_4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_5" value="5" required>
                        <label class="form-check-label" for="answer_${newIndex + 1}_5">5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_answers[${newIndex}][answer]" id="answer_${newIndex + 1}_na" value="NA" required>
                        <label class="form-check-label" for="answer_${newIndex + 1}_na">NA</label>
                    </div>
                </div>
                <button type="button" class="btn btn-danger remove-question">Remove</button>
            `;
    
            questionsContainer.appendChild(newQuestionGroup);
    
            var removeButtons = questionsContainer.getElementsByClassName('remove-question');
            Array.from(removeButtons).forEach(function(button) {
                button.addEventListener('click', function() {
                    this.parentNode.remove();
                });
            });
        });
    
        // Initialize remove button event listeners
        var removeButtons = document.getElementsByClassName('remove-question');
        Array.from(removeButtons).forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentNode.remove();
            });
        });
    
        // Final submission validation
        form.addEventListener('submit', function(event) {
            if (!validateSection(currentSection)) {
                event.preventDefault();
            }
        });
    });
    </script>
    
@endsection
