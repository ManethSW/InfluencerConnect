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
                            <td>{{ Str::limit($collaboration->title, 35) }}</td>
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
                                        data-bs-target="#viewCollaboration-{{ $collaboration->id }}">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    View
                                </button>
                                @if ($collaboration->status == 0)
                                    <button class="btn action-btn edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editCollaboration-{{ $collaboration->id }}">
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
                                            <form action="{{ route('collaborations.destroy', $collaboration->id) }}"
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
                        <div class="modal fade" id="editCollaboration-{{ $collaboration->id }}" tabindex="-1"
                             aria-labelledby="editCollaborationLabel"
                             aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered custom-modal-width">
                                <div class="modal-container-1 modal-content">
                                    <div class="custom-modal-header modal-header">
                                        <h5 class="modal-title" id="addCollaborationModalLabel">
                                            Edit collaboration
                                            {{$collaboration->id}}
                                            by
                                            {{ \App\Models\User::find($collaboration->business_id)->name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="custom-modal-body modal-body">
                                        <form method="post"
                                              action="{{ route('collaborations.update', ['collaboration' => $collaboration->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-container">
                                                <div class="col input-item">
                                                    <label for="title">Collaboration Title</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                           value="{{ $collaboration->title }}" required>
                                                </div>
                                                <div class="form-row-container">
                                                    <div class="col input-item">
                                                        <label for="budget">Collaboration Budget</label>
                                                        <input type="text" class="form-control" id="budget" name="budget"
                                                               value={{ $collaboration->budget }} required>
                                                    </div>
                                                    <div class="col input-item">
                                                        <label for="collaboration_type">Collaboration Type</label>
                                                        <select id="collaboration_type" name="collaboration_type"
                                                                class="form-control"
                                                                required>
                                                            @foreach (\App\Enums\CollaborationType::asSelectArray() as $value => $label)
                                                                <option
                                                                    value="{{ $value }}" {{ $value == $collaboration->collaboration_type ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col input-item">
                                                        <label for="deadline">Deadline</label>
                                                        <input type="date" class="form-control" id="deadline" name="deadline"
                                                               value="{{ $collaboration->deadline }}"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col input-item">
                                                    <label for="description">Collaboration Description</label>
                                                    <input type="text" class="form-control" id="description" name="description"
                                                           value="{{ $collaboration->description }}"
                                                           required>
                                                </div>
                                                <div id="col input-item tasks-container-{{ $collaboration->id }}">
                                                    <label for="tasks">Tasks</label>
                                                    <div id="tasks_body-{{ $collaboration->id }}" class="tasks-body">
                                                        <!-- Show the tasks associated with the collaboration in input format so user can edit like the other inputs -->
                                                        @foreach($collaboration->tasks as $task)
                                                            <div class="task-body">
                                                                <input type="text" class="task-text"
                                                                       name="tasks[{{ $task->id }}][description]"
                                                                       value="{{ $task->description }}" required>
                                                                <select class="task-selector"
                                                                        name="tasks[{{ $task->id }}][priority]"
                                                                        required>
                                                                    <option value="0" {{ $task->priority == 0 ? 'selected' : '' }}>
                                                                        Low
                                                                    </option>
                                                                    <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>
                                                                        Medium
                                                                    </option>
                                                                    <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>
                                                                        Critical
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <input class="hidden-input" type="hidden" name="request_type" value="0">
                                                <div class="custom-button-container">
                                                    <button type="button" id="add_task_button-{{ $collaboration->id }}" class="btn btn-primary">+ Add A Task
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="viewCollaboration-{{ $collaboration->id }}" tabindex="-1"
                             aria-labelledby="viewCollaborationLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered custom-modal-width">
                                <div class="modal-content">
                                    <div class="incoming-offer-container">
                                        <div class="glass-effect">
                                            <div class="offer-header">
                                                <div class="offer-user">
                                                    <i class="fa-solid fa-user"></i>
                                                    <h2>{{ $collaboration->business->name }}</h2>
                                                </div>
                                                <div class="modal-close-section">
                                                    <h2 class="offer-budget">
                                                        LKR {{ $collaboration->budget }}
                                                    </h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                            </div>
                                            <div class="offer-title-date">
                                                <h3>
                                                    {{ $collaboration->title }}
                                                </h3>
                                                <h3 id="offer-deadline">
                                                    {{ $collaboration->deadline }}
                                                </h3>
                                            </div>
                                            <h4 class="offer-description">
                                                {{ $collaboration->description }}
                                            </h4>
                                            <div class="offer-task-section">
                                                <div class="offer-title-date">
                                                    <h3>What you are required to do</h3>
                                                    <div class="showcase-priority">
                                                        <div>
                                                            <h4>Low</h4>
                                                            <div class="offer-task-priority low-priority"></div>
                                                        </div>
                                                        <div>
                                                            <h4>Medium</h4>
                                                            <div class="offer-task-priority medium-priority"></div>
                                                        </div>
                                                        <div>
                                                            <h4>Critical</h4>
                                                            <div class="offer-task-priority high-priority"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="offer-task-list">
                                                    @foreach($collaboration->tasks as $task)
                                                        <div class="offer-task">
                                                            <div
                                                                class="offer-task-priority {{ $task->priority == 0 ? 'low-priority' : ($task->priority == 1 ? 'medium-priority' : 'high-priority') }}"></div>
                                                            <h4>
                                                                {{ $task->description }}
                                                            </h4>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
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
        <div class="modal-dialog modal-dialog-centered custom-modal-width">
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
                                <input placeholder="Enter a title" type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-row-container">
                                <div class="col input-item">
                                    <label for="budget">Budget</label>
                                    <input placeholder="Enter a budget" type="text" class="form-control" id="budget" name="budget" required>
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
                                <input placeholder="Enter a collaboration" type="text" class="form-control" id="description" name="description" required>
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


        let taskIdEdit = 0;

        // Get all the "Add A Task" buttons
        const addTaskButtons = document.querySelectorAll('[id^="add_task_button-"]');

        // Loop over each button
        addTaskButtons.forEach((button) => {
            const collaborationId = button.id.split('-')[1];

            const taskContainerEdit = document.getElementById('tasks_body-' + collaborationId);

            button.addEventListener('click', function () {
                const taskBody = document.createElement('div');
                taskBody.className = 'task-body';

                const descriptionField = document.createElement('input');
                descriptionField.type = 'text';
                descriptionField.className = 'task-text';
                descriptionField.name = `tasks[${taskIdEdit}][description]`;
                descriptionField.placeholder = 'Task Description';
                descriptionField.required = true;

                const priorityField = document.createElement('select');
                priorityField.className = 'task-selector';
                priorityField.name = `tasks[${taskIdEdit}][priority]`;
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

                taskBody.appendChild(descriptionField);
                taskBody.appendChild(priorityField);

                taskContainerEdit.appendChild(taskBody);

                taskIdEdit++;
            });
        });
    });
</script>
