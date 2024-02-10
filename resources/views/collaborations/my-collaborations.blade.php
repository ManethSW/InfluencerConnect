@extends('layouts.collaborations')

@section('collaborations-content')
    @foreach($collaborations as $collaboration)
        <div class="offer-body">
            <div class="incoming-offer-container">
                <div class="glass-effect">
                    <div class="offer-title-date">
                        <h3>{{ $collaboration->title }}</h3>
                        <h3 id="offer-deadline">{{ $collaboration->deadline }}</h3>
                    </div>
                    <h4 class="offer-description">{{ $collaboration->description }}</h4>
                    <div class="collaboration-type-tasks-number">
                        <h3>{{ \App\Enums\CollaborationType::asSelectArray()[$collaboration->collaboration_type] }}</h3>
                        <h3>{{ $collaboration->tasks->count() }} Tasks</h3>
                    </div>
                    <div class="offer-actions">
                        <div class="main">
                            <button class="decline">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button class="edit" data-bs-toggle="modal"
                                    data-bs-target="#editCollaboration-{{ $collaboration->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </div>
                        <div class="other">
                            <button class="message">
                                <h3>Proposals</h3>
                            </button>
                            <button class="view" data-bs-toggle="modal"
                                    data-bs-target="#viewCollaboration-{{ $collaboration->id }}">
                                <h3>View</h3>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
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
                                    {{--                <img src="" alt="Avatar">--}}
                                    <i class="fa-solid fa-user"></i>
                                    {{--                                    Get the bussiness_id and find the users name--}}
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
                                            <h4>
                                                {{ $task->description }}
                                            </h4>
                                            <div
                                                class="offer-task-priority {{ $task->priority == 0 ? 'low-priority' : ($task->priority == 1 ? 'medium-priority' : 'high-priority') }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editCollaboration-{{ $collaboration->id }}" tabindex="-1"
             aria-labelledby="editCollaborationLabel"
             aria-hidden="false">
            <div class="modal-dialog custom-modal-width">
                <div class="modal-container-1 modal-content">
                    <div class="custom-modal-header modal-header">
                        <h5 class="modal-title" id="addCollaborationModalLabel">Edit your collaboration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="custom-modal-body modal-body">
                        <form method="post" action="{{ route('collaborations.updateByBusiness', ['collaboration' => $collaboration->id]) }}">
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
                                        <select id="collaboration_type" name="collaboration_type" class="form-control"
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
                                <div id="col input-item tasks-container">
                                    <label for="tasks">Tasks</label>
                                    <div id="tasks_body" class="tasks-body">
                                        <!-- Show the tasks associated with the collaboration in input format so user can edit like the other inputs -->
                                        @foreach($collaboration->tasks as $task)
                                            <div class="task-body">
                                                <input type="text" class="task-text" name="tasks[{{ $task->id }}][description]"
                                                       value="{{ $task->description }}" required>
                                                <select class="task-selector" name="tasks[{{ $task->id }}][priority]"
                                                        required>
                                                    <option value="0" {{ $task->priority == 0 ? 'selected' : '' }}>Low</option>
                                                    <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>Medium</option>
                                                    <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Critical
                                                    </option>
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <input class="hidden-input" type="hidden" name="request_type" value="0">
                                <div class="custom-button-container">
                                    <button type="button" id="add_task_button" class="btn btn-primary">+ Add A Task
                                    </button>
                                    <button type="submit" class="btn btn-primary">save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let taskId = 0;
        const taskContainer = document.getElementById('tasks_body');
        document.getElementById('add_task_button').addEventListener('click', function () {
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
