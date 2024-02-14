@extends('layouts.collaborations')

@section('collaborations-content')
    <div class="offer-body">
        @foreach($activeCollaborations as $activeCollaboration)
            <div class="incoming-offer-container">
                <div class="glass-effect">
                    <div class="offer-header">
                        <div class="offer-user">
                            {{--                <img src="" alt="Avatar">--}}
                            <i class="fa-solid fa-user"></i>
                            {{--                            Name of the business user in the collaboration the proposal is assigned to--}}
                            <h2>
                                {{ $activeCollaboration->business->name }}
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
                        <div class="title-status-badge">
                            @if($activeCollaboration->status == 0)
                                <div class="collaboration-status-badge pending"></div>
                            @elseif($activeCollaboration->status == 1)
                                <div class="collaboration-status-badge accepted"></div>
                            @elseif($activeCollaboration->status == 2)
                                <div class="collaboration-status-badge completed"></div>
                            @elseif($activeCollaboration->status == 3)
                                <div class="collaboration-status-badge rejected"></div>
                            @endif
                            <h3>{{ $activeCollaboration->title }}</h3>
                        </div>
                        <h3>
                            {{ $activeCollaboration->deadline }}
                        </h3>
                    </div>
                    <h4 class="offer-description">
                        {{ $activeCollaboration->description }}
                    </h4>
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
                                    data-bs-target="#viewCollaboration-{{$activeCollaboration->id}}">
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
                                            {{ $activeCollaboration->business->name}}
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
                                                    @if($task->status == 0)
                                                        <button class="view-task-button"
                                                                data-task-id="{{ $task->id }}"
                                                                data-active-collaboration-id="{{ $activeCollaboration->id }}">
                                                            <i class="fa-solid fa-file-import"></i>
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
                                    <h3>Select a task to submit</h3>
                                </div>
                                <div class="proposal-content">
                                    <div class="offer-task single-task-content">
                                        <div class="offer-task-priority"></div>
                                        <h4 id="task_description"></h4>
                                    </div>
                                    <form action="{{ route('tasks.submit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="task_id" name="task_id">
                                        <div class="links-container">
                                            <label for="supporting_links">Supporting Links</label>
                                            <input type="text" id="supporting_links" name="supporting_links"
                                                   placeholder="Enter the supporting links">
                                        </div>
                                        <div class="uploads-container">
                                            <h4>Supporting Files</h4>
                                            <div class="upload-body-influencer-task">
                                                <input type="file" name="supporting_file_1" id="supporting_file_1"
                                                       hidden>
                                                <label for="supporting_file_1" id="label_supporting_file_1">No File
                                                    Uploaded</label>
                                            </div>
                                            <div class="upload-body-influencer-task">
                                                <input type="file" name="supporting_file_2" id="supporting_file_2"
                                                       hidden>
                                                <label for="supporting_file_2" id="label_supporting_file_2">No File
                                                    Uploaded</label>
                                            </div>
                                            <div class="upload-body-influencer-task">
                                                <input type="file" name="supporting_file_3" id="supporting_file_3"
                                                       hidden>
                                                <label for="supporting_file_3" id="label_supporting_file_3">No File
                                                    Uploaded</label>
                                            </div>
                                            <div class="upload-body-influencer-task">
                                                <input type="file" name="supporting_file_4" id="supporting_file_4"
                                                       hidden>
                                                <label for="supporting_file_4" id="label_supporting_file_4">No File
                                                    Uploaded</label>
                                            </div>
                                            <div class="upload-body-influencer-task">
                                                <input type="file" name="supporting_file_5" id="supporting_file_5"
                                                       hidden>
                                                <label for="supporting_file_5" id="label_supporting_file_5">No File
                                                    Uploaded</label>
                                            </div>
                                        </div>
                                        <div class="task-action-buttons">
                                            <button class="accept" type="submit">
                                                Submit Content
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

{{--Script to handle when a submit task modal is open and close the currently open modal--}}
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const viewTaskButtons = document.querySelectorAll('.view-task-button');
        viewTaskButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-task-id');
                const activeCollaborationId = this.getAttribute('data-active-collaboration-id');
                const taskDetails = document.getElementById('taskDetails' + taskId);
                const taskContainer = document.getElementById('task-container-' + activeCollaborationId);
                console.log(taskDetails);

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
                // taskStatusElement.class.add('task-pending');

                const supporting_file_1 = taskContainer.querySelector('#supporting_file_1');
                const supporting_file_2 = taskContainer.querySelector('#supporting_file_2');
                const supporting_file_3 = taskContainer.querySelector('#supporting_file_3');
                const supporting_file_4 = taskContainer.querySelector('#supporting_file_4');
                const supporting_file_5 = taskContainer.querySelector('#supporting_file_5');
                const label_supporting_file_1 = taskContainer.querySelector('#label_supporting_file_1');
                const label_supporting_file_2 = taskContainer.querySelector('#label_supporting_file_2');
                const label_supporting_file_3 = taskContainer.querySelector('#label_supporting_file_3');
                const label_supporting_file_4 = taskContainer.querySelector('#label_supporting_file_4');
                const label_supporting_file_5 = taskContainer.querySelector('#label_supporting_file_5');

                supporting_file_1.addEventListener('change', function () {
                    label_supporting_file_1.innerText = this.files[0].name;
                });
                supporting_file_2.addEventListener('change', function () {
                    label_supporting_file_2.innerText = this.files[0].name;
                });
                supporting_file_3.addEventListener('change', function () {
                    label_supporting_file_3.innerText = this.files[0].name;
                });
                supporting_file_4.addEventListener('change', function () {
                    label_supporting_file_4.innerText = this.files[0].name;
                });
                supporting_file_5.addEventListener('change', function () {
                    label_supporting_file_5.innerText = this.files[0].name;
                });

                // Get the task id and set it to the hidden input field
                const task_id = taskContainer.querySelector('#task_id');
                task_id.value = taskId;
            });
        });
    });
</script>
