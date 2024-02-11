@extends('layouts.collaborations')

@section('collaborations-content')
    <div class="offer-body">
        @foreach($collaborations as $collaboration)
            <div class="incoming-offer-container">
                <div class="glass-effect">
                    <div class="offer-title-date">
                        <div class="title-status-badge">
                            @if($collaboration->status == 0)
                                <div class="collaboration-status-badge pending"></div>
                            @elseif($collaboration->status == 1)
                                <div class="collaboration-status-badge accepted"></div>
                            @elseif($collaboration->status == 2)
                                <div class="collaboration-status-badge completed"></div>
                            @elseif($collaboration->status == 3)
                                <div class="collaboration-status-badge rejected"></div>
                            @endif
                            <h3>{{ $collaboration->title }}</h3>
                        </div>
                        <h3 id="offer-deadline">{{ $collaboration->deadline }}</h3>
                    </div>
                    <h4 class="offer-description">{{ $collaboration->description }}</h4>
                    <div class="collaboration-type-tasks-number">
                        <h3>
                            Type: {{ \App\Enums\CollaborationType::asSelectArray()[$collaboration->collaboration_type] }}</h3>
                        <h3>No of tasks: {{ $collaboration->tasks->count() }}</h3>
                    </div>
                    <div class="offer-actions">
                        <div class="main">
                            @if($collaboration->status == 0)
                                <button class="decline">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <button class="edit" data-bs-toggle="modal"
                                        data-bs-target="#editCollaboration-{{ $collaboration->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            @endif
                        </div>
                        <div class="other">
                            <button class="message" data-bs-toggle="modal"
                                    data-bs-target="#proposalsModal-{{ $collaboration->id }}"
                                    data-collaboration-id="{{ $collaboration->id }}">
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
                            <form method="post"
                                  action="{{ route('collaborations.updateByBusiness', ['collaboration' => $collaboration->id]) }}">
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
                                    <div id="col input-item tasks-container">
                                        <label for="tasks">Tasks</label>
                                        <div id="tasks_body" class="tasks-body">
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
            <div class="modal fade" id="proposalsModal-{{ $collaboration->id }}" tabindex="-1"
                 aria-labelledby="proposalsModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered custom-modal-width">
                    <div class="proposals-modal modal-content">
                        <div class="proposal-container-1 background-image">
                            <div class="proposal-glass-effect">
                                <div class="proposals-header">
                                    <h5 class="modal-title" id="proposalsModalLabel">Proposal Submissions
                                        for <span class="orange-text">{{$collaboration->title}}</span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="proposals-container">
                                    @if($collaboration->proposals->count() == 0)
                                        <h3 class="no-proposals">No proposals submitted</h3>
                                    @else
                                        @foreach ($collaboration->proposals as $proposal)
                                            <div class="proposals-user-budget">
                                                <div class="user-budget">
                                                    <div class="offer-user">
                                                        <i class="fa-solid fa-user"></i>
                                                    </div>
                                                    <h4>{{ $proposal->influencer->name }}</h4>
                                                    <h4>{{ $proposal->proposed_budget }} LKR</h4>
                                                </div>
                                                <div class="other">
                                                    <button class="view-button"
                                                            data-proposal-id="{{ $proposal->id }}">
                                                        View
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 proposal-details" id="proposalDetails{{$proposal->id}}">
                                                <div class="proposal-body">
                                                    <h3>{{ $proposal->influencer->name }}</h3>
                                                    <h3>{{ $proposal->proposed_budget }}</h3>
                                                    <h3>{{ $proposal->supporting_links }}</h3>
                                                    <h3>{{ $proposal->supporting_file_1 }}</h3>
                                                    <h3>{{ $proposal->supporting_file_2 }}</h3>
                                                    <h3>{{ $proposal->supporting_file_3 }}</h3>
                                                    <h3>{{ $proposal->supporting_file_4 }}</h3>
                                                    <h3>{{ $proposal->supporting_file_5 }}</h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="proposal-container-2 background-image">
                            <div class="proposal-glass-effect">
                                <div class="select-proposal-prompt">
                                    <h3>Select a proposal to view</h3>
                                </div>
                                <div class="proposal-content">
                                    <div class="offer-user">
                                        <i class="fa-solid fa-user"></i>
                                        <h2 id="influencer_name"></h2>
                                    </div>
                                    <div class="proposal-budget">
                                        <h2>Amount</h2>
                                        <h2 id="proposed_budget"></h2>
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
                                        <h3 id="link-3">
                                            No Link Uploaded
                                        </h3>
                                        <h3 id="link-2">
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
{{--                                    Check to see if the staus of the collaboration is not equal to 0 then show now buttons--}}
                                    @if($collaboration->status = 0)
                                        <div class="proposal-action-buttons">
                                            <form action="{{ route('proposals.acceptProposal', ['proposal' => $proposal->id]) }}">
                                                @csrf
                                                <button class="accept" type="submit">
                                                    Accept
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('proposals.rejectProposal', ['proposal' => $proposal->id]) }}">
                                                @csrf
                                                <button class="decline" type="submit">
                                                    Reject
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
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
        const viewButtons = document.querySelectorAll('.view-button');
        const proposalContent = document.querySelector('.proposal-content');
        const viewLinksButton = document.getElementById('view_links_button');
        const viewUploadsButton = document.getElementById('view_uploads_button');
        const viewLinksContainer = document.querySelector('.view-links-container');
        const viewUploadsContainer = document.querySelector('.view-uploads-container');

        viewButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the clicked proposal detail
                const proposalId = this.getAttribute('data-proposal-id');
                const clickedProposalDetail = document.getElementById('proposalDetails' + proposalId);

                // Set the proposal content to be visible and the select proposal prompt to be hidden
                proposalContent.style.display = 'flex';
                document.querySelector('.select-proposal-prompt').style.display = 'none';

                // Get the influencer name and proposed budget
                const influencerName = clickedProposalDetail.querySelector('h3').innerText;
                const proposedBudget = clickedProposalDetail.querySelector('h3:nth-child(2)').innerText;

                // Set the influencer name and proposed budget in the proposal content
                document.getElementById('influencer_name').innerText = influencerName;
                document.getElementById('proposed_budget').innerText = proposedBudget + " LKR";

                // Take the "supporting_links" and create an array of links by splitting the string by ',' and make the array size 5 by filling the undefined indexes with 'undefined'
                const links = clickedProposalDetail.querySelector('h3:nth-child(3)').innerText.split(',');
                while (links.length < 5) {
                    links.push('');
                }
                console.log(links);

                // Set the links in the proposal content by using the array. If they are undefined, set the text to "No Link Uploaded" and truncate the text to be less than 20 characters
                document.getElementById('link-1').innerText = links[0] === '' ? 'No Link Uploaded' : links[0].length > 25 ? links[0].substring(0, 25) + '...' : links[0];
                document.getElementById('link-2').innerText = links[1] === '' ? 'No Link Uploaded' : links[1].length > 25 ? links[1].substring(0, 25) + '...' : links[1];
                document.getElementById('link-3').innerText = links[2] === '' ? 'No Link Uploaded' : links[2].length > 25 ? links[2].substring(0, 25) + '...' : links[2];
                document.getElementById('link-4').innerText = links[3] === '' ? 'No Link Uploaded' : links[3].length > 25 ? links[3].substring(0, 25) + '...' : links[3];
                document.getElementById('link-5').innerText = links[4] === '' ? 'No Link Uploaded' : links[4].length > 25 ? links[4].substring(0, 25) + '...' : links[4];

                // Get the supporting files respectively
                const supportingFile1 = clickedProposalDetail.querySelector('h3:nth-child(4)').innerText;
                const supportingFile2 = clickedProposalDetail.querySelector('h3:nth-child(5)').innerText;
                const supportingFile3 = clickedProposalDetail.querySelector('h3:nth-child(6)').innerText;
                const supportingFile4 = clickedProposalDetail.querySelector('h3:nth-child(7)').innerText;
                const supportingFile5 = clickedProposalDetail.querySelector('h3:nth-child(8)').innerText;

                // Set the supporting files in the proposal content. If they are undefined, set the text to "No File Uploaded" and truncate the text to be less than 25 characters
                document.getElementById('supporting_file_1').innerText = supportingFile1 === '' ? 'No File Uploaded' : supportingFile1.length > 20 ? supportingFile1.substring(0, 20) + '...' : supportingFile1;
                document.getElementById('supporting_file_2').innerText = supportingFile2 === '' ? 'No File Uploaded' : supportingFile2.length > 20 ? supportingFile2.substring(0, 20) + '...' : supportingFile2;
                document.getElementById('supporting_file_3').innerText = supportingFile3 === '' ? 'No File Uploaded' : supportingFile3.length > 20 ? supportingFile3.substring(0, 20) + '...' : supportingFile3;
                document.getElementById('supporting_file_4').innerText = supportingFile4 === '' ? 'No File Uploaded' : supportingFile4.length > 20 ? supportingFile4.substring(0, 20) + '...' : supportingFile4;
                document.getElementById('supporting_file_5').innerText = supportingFile5 === '' ? 'No File Uploaded' : supportingFile5.length > 20 ? supportingFile5.substring(0, 20) + '...' : supportingFile5;

                // Set the download buttons to download the respective files and if they are undefined, set the button to be disabled
                const downloadSupportingFile1 = document.getElementById('download-supporting_file_1');
                const downloadSupportingFile2 = document.getElementById('download-supporting_file_2');
                const downloadSupportingFile3 = document.getElementById('download-supporting_file_3');
                const downloadSupportingFile4 = document.getElementById('download-supporting_file_4');
                const downloadSupportingFile5 = document.getElementById('download-supporting_file_5');

                downloadSupportingFile1.addEventListener('click', function () {
                    if (supportingFile1 !== '') {
                        window.open('/storage/app/' + supportingFile1, '_blank');
                    }
                });
                downloadSupportingFile2.addEventListener('click', function () {
                    if (supportingFile2 !== '') {
                        window.open('/storage/app/' + supportingFile2, '_blank');
                    }
                });
                downloadSupportingFile3.addEventListener('click', function () {
                    if (supportingFile3 !== '') {
                        window.open('/storage/app/' + supportingFile3, '_blank');
                    }
                });
                downloadSupportingFile4.addEventListener('click', function () {
                    if (supportingFile4 !== '') {
                        window.open('/storage/app/' + supportingFile4, '_blank');
                    }
                });
                downloadSupportingFile5.addEventListener('click', function () {
                    if (supportingFile5 !== '') {
                        window.open('/storage/app/' + supportingFile5, '_blank');
                    }
                });

                // Set the links container by default to display first and uploads container to display none and set the view links button to active
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
            });
        });

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
