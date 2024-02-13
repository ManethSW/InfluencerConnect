<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Influencer Connect') }}</title>
    @vite(['resources/sass/app.scss', 'resources/sass/registerLogin.scss', 'resources/js/app.js'])
    <script defer src="https://kit.fontawesome.com/582a81fd83.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body id="body">
<div id="app">
    <div>
        @include('components.navbar')
    </div>
    <main class="py-4">
        <div class="collaborations-container">
            <div class="collaborations-header">
                <div class="header-content">
                    <h2>Collaborations</h2>
                </div>
                <div class="header-navigation">
                    @if (Auth::user()->role_id->value == 10)
                        <a href="{{ route('collaborations.my_proposals') }}" class="{{ Route::currentRouteNamed('collaborations.my_proposals') ? 'active' : '' }}">My Proposals</a>
                        <a href="{{ route('collaborations.active_influencer') }}" class="{{ Route::currentRouteNamed('collaborations.active_influencer') ? 'active' : '' }}">Active Collaborations</a>
                    @else
                        <a class="btn btn-sm {{ Route::currentRouteNamed('collaborations.store') ? 'active' : '' }}" data-bs-toggle="modal" data-bs-target="#addCollaborationModal">Add Collaboration</a>
                        <a href="{{ route('collaborations.my_collaborations') }}" class="{{ Route::currentRouteNamed('collaborations.my_collaborations') ? 'active' : '' }}">My Collaboration</a>
                        <a href="{{ route('collaborations.active_business') }}" class="{{ Route::currentRouteNamed('collaborations.active_business') ? 'active' : '' }}">Active Collaborations</a>
                    @endif
                </div>
            </div>
            <div class="section-header-divider"></div>
            <div class="collaborations-body">
                @yield('collaborations-content')
            </div>
        </div>
        <div class="modal fade" id="addCollaborationModal" tabindex="-1" aria-labelledby="addCollaborationModalLabel"
             aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered custom-modal-width">
                <div class="modal-container-1 modal-content">
                    <div class="custom-modal-header modal-header">
                        <h5 class="modal-title" id="addCollaborationModalLabel">Create a new collaboration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="custom-modal-body modal-body">
                        <form method="post" action="{{ route('collaborations.store') }}">
                            @csrf
                            <div class="form-container">
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
                                    <input type="text" class="form-control" id="description" name="description"
                                           required>
                                </div>
                                <div id="col input-item tasks-container">
                                    <label for="tasks">Tasks</label>
                                    <div id="tasks_body" class="tasks-body">
                                        <h4 class="default-message">Click on + Add Task to add a task with a title and
                                            priority</h4>
                                        <!-- Task fields will be added here -->
                                    </div>
                                </div>
                                <input class="hidden-input" type="hidden" name="request_type" value="0">
                                <div class="custom-button-container">
                                    <button type="button" id="add_task_button" class="btn btn-primary">+ Add A Task
                                    </button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div>
        @yield('footer')
    </div>
</div>
</body>

</html>

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
