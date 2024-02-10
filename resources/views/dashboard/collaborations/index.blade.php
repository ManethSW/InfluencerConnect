@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Collaborations</h3>
                    <div class="search-add">
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addCollaborationModal">Add
                                Collaboration</a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="table-column-id">ID</th>
                        <th class="table-column-title">Title</th>
                        <th class="table-column-business">Business</th>
                        <th class="table-column-influencer">Influencer</th>
                        <th class="table-column-budget">Budget</th>
                        <th class="table-column-status">Status</th>
                        <th class="table-column-actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($collaborations as $collaboration)
                        <tr>
                            <td>{{ $collaboration->id }}</td>
                            <td>{{ $collaboration->title }}</td>
                            <td>{{ \App\Models\User::find($collaboration->business_id)->name }}</td>
                            <td>
                                @if ($collaboration->influencer_id)
                                    {{ \App\Models\User::find($collaboration->influencer_id)->name }}
                                @else
                                    <p class="awaiting">Awaiting</p>
                                @endif
                            </td>
                            <td>{{ $collaboration->budget }}</td>
                            <td>
                                @if ($collaboration->status == 0)
                                    <div class="status orange">
                                        <div class="status-badge"></div>
                                        <p>Awaiting Proposal</p>
                                    </div>
                                @elseif($collaboration->status == 1)
                                    <div class="status yellow">
                                        <div class="status-badge"></div>
                                        <p>In Progress</p>
                                    </div>
                                @elseif($collaboration->status == 2)
                                    <div class="status green">
                                        <div class="status-badge"></div>
                                        <p>Completed</p>
                                    </div>
                                @elseif($collaboration->status == 3)
                                    <div class="status red">
                                        <div class="status-badge"></div>
                                        <p>Rejected</p>
                                    </div>
                                @endif
                            </td>
                            <td class="action-btns">
                                <button type="button" class="btn action-btn edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#viewModal{{ $collaboration->id }}">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    View
                                </button>
                                @if ($collaboration->status == 0)
                                    <button
                                        type="button"
                                        class="btn action-btn edit-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editCollaborationModal{{ $collaboration->id }}"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                        Edit
                                    </button>
                                    <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $collaboration->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </button>
                                @endif
                            </td>
                        </tr>
                        {{--                        Edit modal --}}
                        <div class="modal fade"
                             id="editCollaborationModal{{ $collaboration->id }}"
                             tabindex="-1"
                             role="dialog"
                             aria-labelledby="editCollaborationModalLabel{{ $collaboration->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-add modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="editCollaborationModalLabel{{ $collaboration->id }}">
                                            Edit {{ $collaboration->name }}'s Profile</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="edit-fields">
                                            <form method="post" action="{{ route('users.update', $collaboration->id) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-row edit-form">
                                                    <div class="edit-buttons">
                                                        <button type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{ $collaboration->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="deleteModalLabel{{ $collaboration->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title custom-title"
                                            id="deleteModalLabel{{ $collaboration->id }}">
                                            Delete Collaboration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            Are you sure you want to delete this collaboration?
                                        </div>
                                        <div class="modal-button">
                                            <form action="{{ route('users.destroy', $collaboration->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn delete-btn">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCollaborationModal" tabindex="-1" aria-labelledby="addCollaborationModalLabel"
         aria-hidden="false">
        <div class="modal-dialog custom-modal-width">
            <div class="modal-container-1 modal-content">
                <div class="custom-modal-header modal-header">
                    <h5 class="modal-title" id="addCollaborationModalLabel">Add Collaboration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="custom-modal-body modal-body">
                    <form method="post" action="{{ route('collaborations.store') }}">
                        @csrf
                        <div class="form-container">
                            <div class="col input-item">
                                <label for="business_id">Pick an business to assign the collaboration to</label>
                                <select id="business_id" name="business_id" class="form-control">
                                    @foreach ($users as $user)
                                        @if ($user->role_id->value == 11)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col input-item">
                                <label for="title">Collaboration Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-row-container">
                                <div class="col input-item">
                                    <label for="budget">Budget</label>
                                    <input type="text" class="form-control" id="budget" name="budget" required>
                                </div>
                                <div class="col input-item">
                                    <label for="collaboration_type">Collaboration Type</label>
                                    <select id="collaboration_type" name="collaboration_type" class="form-control"
                                            required>
                                        @foreach (\App\Enums\CollaborationType::asSelectArray() as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col input-item">
                                    <label for="deadline">Deadline</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline" required>
                                </div>
                            </div>
                            <div class="col input-item">
                                <label for="description">Collaboration Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div id="col input-item tasks-container">
                                <label for="tasks">Tasks</label>
                                <div id="tasks_body" class="tasks-body">
                                    <h4 class="default-message">Click on + Add Task to add a task with a title and priority</h4>
                                    <!-- Task fields will be added here -->
                                </div>
                            </div>
                            <input class="hidden-input" type="hidden" name="request_type" value="0">
                            <div class="custom-button-container">
                                <button type="button" id="add_task_button" class="btn btn-primary">+ Add A Task</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let taskId = 0;
        const taskContainer = document.getElementById('tasks_body');
        const defaultMessage = document.querySelector('.default-message');
        document.getElementById('add_task_button').addEventListener('click', function () {
            // Remove the default message when a task is added
            if (defaultMessage) {
                defaultMessage.remove();
            }

            // Create a new div with class 'task-body'
            const taskBody = document.createElement('div');
            taskBody.className = 'task-body';

            // Create task description field
            const descriptionField = document.createElement('input');
            descriptionField.type = 'text';
            descriptionField.className = 'task-text'; // Add class 'task-text'
            descriptionField.name = `tasks[${taskId}][description]`; // Use array name to send multiple task descriptions
            descriptionField.placeholder = 'Task Description';
            descriptionField.required = true;

            // Create task priority field
            const priorityField = document.createElement('select');
            priorityField.className = 'task-selector'; // Add class 'task-selector'
            priorityField.name = `tasks[${taskId}][priority]`; // Use array name to send multiple task priorities
            priorityField.required = true;

            const lowOption = document.createElement('option');
            lowOption.value = '0';
            lowOption.text = 'Low';
            priorityField.add(lowOption);

            const mediumOption = document.createElement('option');
            mediumOption.value = '1';
            mediumOption.text = 'Medium';
            priorityField.add(mediumOption);

            const criticalOption = document.createElement('option');
            criticalOption.value = '2';
            criticalOption.text = 'Critical';
            priorityField.add(criticalOption);

            // Append the fields to the task body
            taskBody.appendChild(descriptionField);
            taskBody.appendChild(priorityField);

            // Append the task body to the task container
            taskContainer.appendChild(taskBody);

            taskId++;
        });
    });
</script>
