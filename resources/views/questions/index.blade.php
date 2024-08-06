@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <ul class="nav nav-tabs" id="managementTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="questions-tab" data-toggle="tab" data-target="#questions"
                        type="button" role="tab" aria-controls="questions" aria-selected="true">Questions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sections-tab" data-toggle="tab" data-target="#sections" type="button"
                        role="tab" aria-controls="sections" aria-selected="false">Sections</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="designations-tab" data-toggle="tab" data-target="#designations"
                        type="button" role="tab" aria-controls="designations"
                        aria-selected="false">Designations</button>
                </li>
            </ul>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="tab-content mt-3" id="managementTabsContent">
            <!-- Questions Tab -->
            <div class="tab-pane fade show active" id="questions" role="tabpanel" aria-labelledby="questions-tab">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">Questions</div>
                    <div class="card-body">
                        <!-- Create Question Form -->
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <input type="text" name="question" id="question" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Question</button>
                        </form>

                        <hr>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ $question->status == 0 ? 'Disabled' : 'Enabled' }}</td>
                                        <td>
                                            <!-- Enable/Disable Button -->
                                            <a class=" btn {{ $question->status == 1 ? 'btn-danger' : 'btn-success' }}"
                                                href="{{ route('questions.toggleStatus', $question->id) }}">
                                                {{ $question->status == 1 ? 'Disabled' : 'Enabled' }}

                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Sections Tab -->
            {{-- <div class="tab-pane fade" id="sections" role="tabpanel" aria-labelledby="sections-tab">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">Sections</div>
                    <div class="card-body">
                        <!-- Create Section Form -->
                        <form action="{{ route('sections.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Section</button>
                        </form>

                        <hr>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Questions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section->name }}</td>
                                        <td>{{ $section->description }}</td>
                                        <td>
                                            @foreach ($section->questions as $question)
                                                {{ $question->question }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('sections.edit', $section->id) }}"
                                                class="btn btn-sm btn-info">Edit</a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('sections.destroy', $section->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <!-- Add Question Button -->
                                            <button class="btn btn-primary mb-3" data-toggle="modal"
                                                data-target="#addQuestionModal" onclick="addQuestionForSection({{$section->id}})">Add Question</button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            <!-- Sections Tab -->
            <div class="tab-pane fade" id="sections" role="tabpanel" aria-labelledby="sections-tab">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">Sections</div>
                    <div class="card-body">
                        <!-- Create Section Button -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#createSectionModal">
                            Create Section
                        </button>

                        <!-- Create Section Modal -->
                        <div class="modal fade" id="createSectionModal" tabindex="-1"
                            aria-labelledby="createSectionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createSectionModalLabel">Create Section</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="createSectionForm">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" id="createSectionName"
                                                    class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" id="createSectionDescription" class="form-control" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create Section</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Questions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                    <tr id="section-{{ $section->id }}">
                                        <td>{{ $section->name }}</td>
                                        <td>{{ $section->description }}</td>
                                        <td>
                                            @foreach ($section->questions as $question)
                                                {{ $question->question }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-sm btn-info"
                                                onclick="editSection({{ $section->id }})">Edit</button>
                                            <!-- Delete Button -->
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteSection({{ $section->id }})">Delete</button>
                                            <!-- Add Question Button -->
                                            <button class="btn btn-primary mb-3" data-toggle="modal"
                                                data-target="#addQuestionModal"
                                                onclick="addQuestionForSection({{ $section->id }})">Add Question</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Edit Section Modal -->
            <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editSectionForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="editSectionId">
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Name</label>
                                    <input type="text" name="name" id="editSectionName" class="form-control"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="editDescription" class="form-label">Description</label>
                                    <textarea name="description" id="editSectionDescription" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Section</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Question Modal -->
            <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addQuestionModalLabel">Add Questions</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addQuestionForm">
                                @csrf
                                <input type="hidden" id="sectionId">
                                <div class="mb-3">
                                    <label for="question_ids" class="form-label">Select Questions</label>
                                    <select name="question_ids[]" id="question_ids" class="form-control" multiple
                                        required>
                                        @foreach ($questions as $question)
                                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Questions</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Designations Tab -->
            <div class="tab-pane fade" id="designations" role="tabpanel" aria-labelledby="designations-tab">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">Designations</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Department ID</th>
                                    <th>Company ID</th>
                                    <th>Name</th>
                                    <th>Sections</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($designations as $designation)
                                    <tr>
                                        <td>{{ $designation->department_id }}</td>
                                        <td>{{ $designation->company_id }}</td>
                                        <td>{{ $designation->name }}</td>
                                        <td>
                                            @foreach ($designation->sections as $section)
                                                {{ $section->name }}<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Add Questions to Section</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form id="addQuestionForm">
                        @csrf
                        <div class="mb-3">
                            <label for="question_ids" class="form-label">Select Questions</label>
                            <select name="question_ids[]" id="question_ids" class="form-control" multiple required>
                                @foreach ($questions as $question)
                                    <option value="{{ $question->id }}">{{ $question->question }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Questions</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let sectionId = null;
        document.addEventListener('DOMContentLoaded', function() {
            var triggerTabList = [].slice.call(document.querySelectorAll('#managementTabs button'))
            triggerTabList.forEach(function(triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)
                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        });


        $(document).ready(function() {

            // Handle form submission with AJAX select to question
            $('#addQuestionForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('sections.storeQuestion', $section->id) }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle success (e.g., close modal, show success message)
                        $('#addQuestionModal').modal('hide');
                        alert('Questions added successfully!');
                        // Optionally, refresh the questions list
                    },
                    error: function(response) {
                        // Handle error
                        alert('An error occurred. Please try again.');
                    }
                });
            });

        });

        function addQuestionForSection(id) {
            sectionId = id;
            if (sectionId) {
                $.ajax({
                    url: "{{ url('sections/getSelectedQuestions') }}/" + sectionId,
                    success: function(response) {
                        var selectedQuestions = response.selected_questions;
                        $('#question_ids').val(selectedQuestions).trigger('change');
                    },
                    error: function(response) {
                        console.error('Error fetching selected questions:', response);
                    }
                });
            } else {
                $('#question_ids').val(null).trigger('change');
            }
        }



        // Create section form submission
        $('#createSectionForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('sections.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#createSectionModal').modal('hide');
                    // location.reload(); // Reload to see the new section
                },
                error: function(response) {
                    alert('An error occurred. Please try again.');
                }
            });
        });

        // Edit section form submission
        $('#editSectionForm').on('submit', function(e) {
            e.preventDefault();
            var sectionId = $('#editSectionId').val();
            $.ajax({
                url: "{{ url('sections') }}/" + sectionId,
                method: "PUT",
                data: $(this).serialize(),
                success: function(response) {
                    $('#editSectionModal').modal('hide');
                    location.reload(); // Reload to see the updated section
                },
                error: function(response) {
                    alert('An error occurred. Please try again.');
                }
            });
        });

 

        function editSection(id) {
            $.ajax({
                url: "{{ url('sections') }}/" + id + "/edit",
                method: "GET",
                success: function(response) {
                    $('#editSectionId').val(response.id);
                    $('#editSectionName').val(response.name);
                    $('#editSectionDescription').val(response.description);
                    $('#editSectionModal').modal('show');
                },
                error: function(response) {
                    alert('An error occurred. Please try again.');
                }
            });
        }

        function deleteSection(id) {
            if (confirm('Are you sure you want to delete this section?')) {
                $.ajax({
                    url: "{{ route('sections.delete', 'replace_with_id') }}".replace('replace_with_id', id),
                    success: function(response) {
                        $('#section-' + id).remove();
                    },
                    error: function(response) {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        }
    </script>
     {{-- data: {
        _token: "{{ csrf_token() }}"
    }, --}}
@endsection
