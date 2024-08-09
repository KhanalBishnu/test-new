@extends('layouts.app')

@section('content')
    <style>
        /* Base styles for the custom radio buttons */
        .custom-radio .form-check-input {
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            border: 2px solid black;
            background-color: white;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            position: relative;
            cursor: pointer;
        }

        /* Styles for when the radio button is checked */
        .custom-radio .form-check-input:checked {
            background-color: green;
            border-color: green;
        }

        /* The dot inside the checked radio button */
        .custom-radio .form-check-input:checked::before {
            content: '';
            width: 0.75rem;
            height: 0.75rem;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Button Styles */
        .next-btn,
        .prev-btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 30px;
            border: none;
            background: linear-gradient(to right, #4CAF50, #8BC34A);
            /* Gradient background */
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background 0.3s ease, transform 0.3s ease;
            outline: none;
        }

        /* Hover Effect */
        .next-btn:hover,
        .prev-btn:hover {
            background: linear-gradient(to right, #388E3C, #4CAF50);
            transform: translateY(-3px);
        }

        /* Active Effect */
        .next-btn:active,
        .prev-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Disable button when not allowed to move forward/backward */
        .next-btn:disabled,
        .prev-btn:disabled {
            background: #9E9E9E;
            cursor: not-allowed;
        }

        /* Alignment */
        .next-btn {
            margin-left: auto;
        }

        .prev-btn {
            margin-right: 10px;
            background: linear-gradient(to right, #FFC107, #FF9800);
            /* Gradient for Previous button */
        }

        .prev-btn:hover {
            background: linear-gradient(to right, #FF9800, #FFC107);
        }

        /* Make sure the buttons are in the correct place */
        .card-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 20px 0;
        }
    </style>
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
                        <input type="number" name="reviewer_id" class="form-control" id="reviewer_id"
                            value="{{ old('reviewer_id') }}" required>
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
                        <input type="number" name="review_of" class="form-control" id="review_of"
                            value="{{ old('review_of') }}" required>
                        @if ($errors->has('review_of'))
                            <div class="invalid-feedback">{{ $errors->first('review_of') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="review_of">Review Of Year</label>
                        <input type="number"  name="year" class="form-control" id="year_default_check" value="2081" disabled>

                    </div>

                    <div class="form-group">
                        <label for="review_year_month">Review Year Month</label>
                        <select id="nepali-months" class="month-select form-control" required>
                            <option value="Baishakh">Baishakh</option>
                            <option value="Jestha">Jestha</option>
                            <option value="Ashadh">Ashadh</option>
                            <option value="Shrawan">Shrawan</option>
                            <option value="Bhadra">Bhadra</option>
                            <option value="Ashwin">Ashwin</option>
                            <option value="Kartik">Kartik</option>
                            <option value="Mangsir">Mangsir</option>
                            <option value="Poush">Poush</option>
                            <option value="Magh">Magh</option>
                            <option value="Falgun">Falgun</option>
                            <option value="Chaitra">Chaitra</option>
                        </select>
                        @if ($errors->has('review_year_month'))
                            <div class="invalid-feedback">{{ $errors->first('review_year_month') }}</div>
                        @endif
                    </div>

                    {{-- <div class="form-group">
                        <label for="department">date</label>
                        <input type="text" value="" name="date" class="date-picker form-control" />

                    </div> --}}
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" name="department" class="form-control" id="department"
                            value="{{ old('department') }}" required>
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
                        <textarea name="current_goals_responsibilities" class="form-control" id="current_goals_responsibilities" rows="3"
                            required>{{ old('current_goals_responsibilities') }}</textarea>
                        @if ($errors->has('current_goals_responsibilities'))
                            <div class="invalid-feedback">{{ $errors->first('current_goals_responsibilities') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="completed_goals_responsibilities">Completed Goals and Responsibilities</label>
                        <textarea name="completed_goals_responsibilities" class="form-control" id="completed_goals_responsibilities"
                            rows="3" required>{{ old('completed_goals_responsibilities') }}</textarea>
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
                        <input type="text" name="designation" class="form-control" id="designation"
                            value="{{ old('designation') }}" required>
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
                    <div class="question-group mb-4  custom-radio">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="question_1">Question 1</label>
                                    <input type="hidden" name="question_answers[0][question]" class="form-control"
                                        id="question_1" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group d-flex justify-content-between">
                                    <label for="answer_1">Answer 1</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[0][answer]"
                                            id="answer_1_1" value="1" required>
                                        <label class="form-check-label" for="answer_1_1">1</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[0][answer]"
                                            id="answer_1_2" value="2" required>
                                        <label class="form-check-label" for="answer_1_2">2</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[0][answer]"
                                            id="answer_1_3" value="3" required>
                                        <label class="form-check-label" for="answer_1_3">3</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[0][answer]"
                                            id="answer_1_4" value="4" required>
                                        <label class="form-check-label" for="answer_1_4">4</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[0][answer]"
                                            id="answer_1_5" value="5" required>
                                        <label class="form-check-label" for="answer_1_5">5</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[0][answer]"
                                            id="answer_1_na" value="NA" required>
                                        <label class="form-check-label" for="answer_1_na">NA</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="question-group mb-4 custom-radio">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="question_1">Question 1</label>
                                    <input type="hidden" name="question_answers[1][question]" class="form-control"
                                        id="question_1" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group d-flex justify-content-between">
                                    <label for="answer_1">Answer 1</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[1][answer]"
                                            id="answer_1_1" value="1" required>
                                        <label class="form-check-label" for="answer_1_1">1</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[1][answer]"
                                            id="answer_1_2" value="2" required>
                                        <label class="form-check-label" for="answer_1_2">2</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[1][answer]"
                                            id="answer_1_3" value="3" required>
                                        <label class="form-check-label" for="answer_1_3">3</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[1][answer]"
                                            id="answer_1_4" value="4" required>
                                        <label class="form-check-label" for="answer_1_4">4</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[1][answer]"
                                            id="answer_1_5" value="5" required>
                                        <label class="form-check-label" for="answer_1_5">5</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_answers[1][answer]"
                                            id="answer_1_na" value="NA" required>
                                        <label class="form-check-label" for="answer_1_na">NA</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentSection = 0;
            var sections = document.querySelectorAll('.form-section');
            var nextButtons = document.querySelectorAll('.next-btn');
            var prevButtons = document.querySelectorAll('.prev-btn');
            var form = document.getElementById('evaluation-form');

            function showSection(index, direction) {
                sections.forEach((section, idx) => {
                    section.classList.remove('active', 'entering-from-right', 'entering-from-left',
                        'exiting-to-left', 'exiting-to-right');
                    if (idx === index) {
                        section.classList.add('active');
                        section.style.display = 'block';
                    } else if (idx < index && direction === 'next') {
                        section.classList.add('exiting-to-left');
                        setTimeout(() => section.style.display = 'none', 100);
                    } else if (idx > index && direction === 'prev') {
                        section.classList.add('exiting-to-right');
                        setTimeout(() => section.style.display = 'none', 100);
                    } else if (idx === index - 1 && direction === 'next') {
                        section.classList.add('entering-from-right');
                        section.style.display = 'block';
                    } else if (idx === index + 1 && direction === 'prev') {
                        section.classList.add('entering-from-left');
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
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
                            showSection(currentSection, 'next');
                        }
                    }
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (currentSection > 0) {
                        currentSection--;
                        showSection(currentSection, 'prev');
                    }
                });
            });

            showSection(currentSection, 'next');

            form.addEventListener('submit', function(event) {
                if (!validateSection(currentSection)) {
                    event.preventDefault();
                }
            });
        });
        $(document).ready(function() {
            $('input[type="radio"]').change(function() {
                const name = $(this).attr('name');
                $('input[name="' + name + '"]').removeClass('is-invalid');
            });
            // $('.date-picker').nepaliDatePicker({
            //     dateFormat: '%D, %M %d, %y',
            //     closeOnDateSelect: true,
            //     minDate: 'सोम, जेठ १०, २०७३',
            //     //   maxDate: 'मंगल, जेठ ३२, २०७३'
            // });
        });
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize NepaliDate object
            const nd = new NepaliDate();
            debugger
            const monthNames = [
                'Baishakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra',
                'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'
            ];
            // Get the current Nepali month name
            const currentNepaliMonth = nd.getMonth();

            // Set the default selected month
            const monthSelect = document.getElementById('nepali-months');
            monthSelect.value = monthNames[currentNepaliMonth];
            document.getElementById('year_default_check').innerHTML(nd.getYear())
        });
    </script>
@endsection
