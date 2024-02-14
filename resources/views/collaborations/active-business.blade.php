@extends('layouts.collaborations')

@section('collaborations-content')
    <div class="offer-body">
        @foreach($activeCollaborations as $activeCollaboration)
            <div class="incoming-offer-container">
                <div class="glass-effect">
                    <div class="offer-header">
                        <div class="offer-user">
                            <i class="fa-solid fa-user"></i>
                            <h2>
                                {{ $activeCollaboration->influencer->name }}
                            </h2>
                        </div>
                        <div class="active-collaboration-budegt-type">
                            <h2 class="offer-budget">
                                {{ \App\Enums\CollaborationType::asSelectArray()[$activeCollaboration->collaboration_type] }}
                            </h2>
                            <h2 class="offer-budget">
                                {{$activeCollaboration->budget}}LKR
                            </h2>
                        </div>
                    </div>
                    <div class="active-collaboration-title-deadline">
                        <h3>
                            {{ $activeCollaboration->title }}
                        </h3>
                        <h3>
                            {{ $activeCollaboration->deadline }}
                        </h3>
                    </div>
                    <div class="offer-description active-collaboration-description">
                        <p>
                            {{ $activeCollaboration->description }}
                        </p>
                    </div>
                    <div class="offer-actions">
                        <div class="main">
                            <div class="other">
                                <button class="message">
                                    <i class="fa-solid fa-message"></i>
                                    <h3>Chat</h3>
                                </button>
                            </div>
                        </div>
                        <div class="other">
                            <button class="view" data-bs-toggle="modal"
                                    data-bs-target="#viewCollaboration-{{ $activeCollaboration->id }}">
                                <h3>View</h3>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewCollaboration-{{$activeCollaboration->id}}" tabindex="-1"
                 aria-labelledby="viewCollaborationLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered custom-modal-width-active">
                    <div class="active-collaboration-modal modal-content">
                        <div class="active-collaboration-container-1 background-image">
                            <div class="glass-effect-active-collaborations">
                                <div class="offer-header">
                                    <div class="offer-user">
                                        {{--                <img src="" alt="Avatar">--}}
                                        <i class="fa-solid fa-user"></i>
                                        <h2>
                                            {{ $activeCollaboration->influencer->name}}
                                        </h2>
                                    </div>
                                    <div class="modal-close-section">
                                        <h2 class="offer-budget">
                                            {{ \App\Enums\CollaborationType::asSelectArray()[$activeCollaboration->collaboration_type] }}
                                        </h2>
                                        <h2 class="offer-budget">
                                            {{$activeCollaboration->budget}}LKR
                                        </h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="offer-title-date">
                                    <h3>{{$activeCollaboration->title}}</h3>
                                    <h3>{{$activeCollaboration->deadline}}</h3>
                                </div>
                                <h4 class="offer-description">
                                    {{$activeCollaboration->description}}
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
                                        @foreach($activeCollaboration->tasks as $task)
                                            <div class="task-information">
                                                <div class="offer-task">
                                                    <div class="task-information-priority-description">
                                                        <div
                                                            class="offer-task-priority {{ $task->priority == 0 ? 'low-priority' : ($task->priority == 1 ? 'medium-priority' : 'high-priority') }}"></div>
                                                        <h4>
                                                            {{ $task->description }}
                                                        </h4>
                                                    </div>
                                                    <div
                                                        class="task-status {{ $task->status == 0 ? 'task-pending' : ($task->status == 1 ? 'task-in-review' : 'task-completed')}}">
                                                        {{ $task->status == 0 ? 'Pending' : ($task->status == 1 ? 'In Review' : 'Completed')}}
                                                    </div>
                                                </div>
                                                <div class="task-actions">
                                                    @if($task->status == 0 || $task->status == 1)
                                                        <button class="view-task-button"
                                                                data-task-id="{{ $task->id }}"
                                                                data-active-collaboration-id="{{ $activeCollaboration->id }}">
                                                            <i class="fa-solid fa-arrow-right"></i>
                                                        </button>
                                                    @else
                                                        <button class="task-complete">
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 proposal-details" id="taskDetails{{$task->id}}">
                                                <div class="proposal-body">
                                                    <h3>{{ $task->description }}</h3>
                                                    <h3>{{ $task->priority }}</h3>
                                                    <h3>{{ $task->supporting_links }}</h3>
                                                    <h3>{{ $task->supporting_file_1 }}</h3>
                                                    <h3>{{ $task->supporting_file_2 }}</h3>
                                                    <h3>{{ $task->supporting_file_3 }}</h3>
                                                    <h3>{{ $task->supporting_file_4 }}</h3>
                                                    <h3>{{ $task->supporting_file_5 }}</h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="active-collaboration-container-2 background-image"
                             id="task-container-{{$activeCollaboration->id}}">
                            <div class="glass-effect">
                                <div class="select-proposal-prompt">
                                    <h3>Select a task to review</h3>
                                </div>
                                @csrf
                                <div class="proposal-content">
                                    <div class="offer-task single-task-content">
                                        <div class="offer-task-priority"></div>
                                        <h4 id="task_description"></h4>
                                    </div>
                                    <div class="proposal-buttons">
                                        <button id="view_links_button" class="active-button">
                                            Links
                                            <i class="fa-solid fa-link"></i>
                                        </button>
                                        <button id="view_uploads_button">
                                            Uploads
                                            <i class="fa-solid fa-download"></i>
                                        </button>
                                    </div>
                                    <div class="view-links-container view-container">
                                        <h3 id="link-1">
                                            No link uplaoded
                                        </h3>
                                        <h3 id="link-2">
                                            No Link Uploaded
                                        </h3>
                                        <h3 id="link-3">
                                            No Link Uploaded
                                        </h3>
                                        <h3 id="link-5">
                                            No Link Uploaded
                                        </h3>
                                        <h3 id="link-4">
                                            No Link Uploaded
                                        </h3>
                                    </div>
                                    <div class="view-uploads-container view-container">
                                        <div class="upload-body">
                                            <h3 id="supporting_file_1">
                                                No File Uploaded
                                            </h3>
                                            <button id="download-supporting_file_1">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                        <div class="upload-body">
                                            <h3 id="supporting_file_2">
                                                No File Uploaded
                                            </h3>
                                            <button id="download-supporting_file_2">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                        <div class="upload-body">
                                            <h3 id="supporting_file_3">
                                                No File Uploaded
                                            </h3>
                                            <button id="download-supporting_file_3">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                        <div class="upload-body">
                                            <h3 id="supporting_file_4">
                                                No File Uploaded
                                            </h3>
                                            <button id="download-supporting_file_4">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                        <div class="upload-body">
                                            <h3 id="supporting_file_5">
                                                No File Uploaded
                                            </h3>
                                            <button id="download-supporting_file_5">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="proposal-action-buttons">
                                        <form action="{{ route('tasks.complete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="task_id" name="task_id">
                                            <button class="accept" type="submit">
                                                Mark as Completed
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const viewTaskButtons = document.querySelectorAll('.view-task-button');
        viewTaskButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-task-id');
                const activeCollaborationId = this.getAttribute('data-active-collaboration-id');
                const taskDetails = document.getElementById('taskDetails' + taskId);
                const taskContainer = document.getElementById('task-container-' + activeCollaborationId);

                /// Set the proposal content to be visible and the select proposal prompt to be hidden
                const proposalContent = taskContainer.querySelector('.proposal-content');
                proposalContent.style.display = 'flex';
                taskContainer.querySelector('.select-proposal-prompt').style.display = 'none';

                // Get the task description and status
                const taskDescription = taskDetails.querySelector('h3').innerText;

                // Set the task description and status to the proposal content
                const taskDescriptionElement = taskContainer.querySelector('#task_description');
                let truncatedTaskDescription = taskDescription.substring(0, 30);
                if (taskDescription.length > 30) {
                    truncatedTaskDescription += '...';
                }

                taskDescriptionElement.innerText = truncatedTaskDescription;

                // Take the "supporting_links" and create an array of links by splitting the string by ',' and make the array size 5 by filling the undefined indexes with 'undefined'
                const links = taskDetails.querySelector('h3:nth-child(3)').innerText.split(',');
                while (links.length < 5) {
                    links.push('');
                }

                // Set the links to the view links container
                for (let i = 0; i < 5; i++) {
                    const linkElement = taskContainer.querySelector('#link-' + (i + 1));
                    if (links[i] !== '') {
                        linkElement.innerHTML = `<a href="${links[i]}" target="_blank">${links[i].length > 25 ? links[i].substring(0, 25) + '...' : links[i]}</a>`;
                    } else {
                        linkElement.innerText = 'No Link Uploaded';
                    }
                }

                // Get the supporting files and set them to the view uploads container
                const supportingFiles = [
                    taskDetails.querySelector('h3:nth-child(4)').innerText,
                    taskDetails.querySelector('h3:nth-child(5)').innerText,
                    taskDetails.querySelector('h3:nth-child(6)').innerText,
                    taskDetails.querySelector('h3:nth-child(7)').innerText,
                    taskDetails.querySelector('h3:nth-child(8)').innerText,
                ];

                // Set the supporting files in the proposal content. If they are undefined, set the text to "No File Uploaded" and truncate the text to be less than 25 characters
                for (let i = 0; i < 5; i++) {
                    const fileElement = taskContainer.querySelector('#supporting_file_' + (i + 1));
                    const downloadButton = taskContainer.querySelector('#download-supporting_file_' + (i + 1));

                    if (supportingFiles[i]) {
                        fileElement.innerText = supportingFiles[i].length > 20 ? supportingFiles[i].substring(0, 20) + '...' : supportingFiles[i];
                        downloadButton.disabled = false;
                        downloadButton.addEventListener('click', function () {
                            window.open('/storage/' + supportingFiles[i], '_blank');
                        });
                    } else {
                        fileElement.innerText = 'No File Uploaded';
                        downloadButton.disabled = true;
                    }
                }

                const viewLinksContainer = taskContainer.querySelector('.view-links-container');
                const viewUploadsContainer = taskContainer.querySelector('.view-uploads-container');
                const viewLinksButton = taskContainer.querySelector('#view_links_button');
                const viewUploadsButton = taskContainer.querySelector('#view_uploads_button');

                viewLinksContainer.style.display = 'block';
                viewUploadsContainer.style.display = 'none';
                viewLinksButton.classList.add('active-button');
                viewUploadsButton.classList.remove('active-button');

                // Add event listeners to the view links and view uploads buttons to switch between the two containers
                viewLinksButton.addEventListener('click', function () {
                    viewLinksContainer.style.display = 'block';
                    viewUploadsContainer.style.display = 'none';
                    viewLinksButton.classList.add('active-button');
                    viewUploadsButton.classList.remove('active-button');
                });

                viewUploadsButton.addEventListener('click', function () {
                    viewLinksContainer.style.display = 'none';
                    viewUploadsContainer.style.display = 'block';
                    viewLinksButton.classList.remove('active-button');
                    viewUploadsButton.classList.add('active-button');
                });

                // Find the task id input and set the value to the task id
                const taskIdInput = taskContainer.querySelector('#task_id');
                console.log(taskIdInput);
                taskIdInput.value = taskId;
            });
        });
    });
</script>
