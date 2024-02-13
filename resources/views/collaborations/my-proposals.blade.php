@extends('layouts.collaborations')

@section('collaborations-content')
    <div class="offer-body">
        @foreach($proposals as $proposal)
            <div class="incoming-offer-container">
                <div class="glass-effect">
                    <div class="offer-header">
                        <div class="offer-user">
                            {{--                <img src="" alt="Avatar">--}}
                            <i class="fa-solid fa-user"></i>
                            {{--                            Name of the business user in the collaboration the proposal is assigned to--}}
                            <h2>
                                {{ $proposal->collaboration->business->name }}
                            </h2>
                        </div>
                        <h2 class="offer-budget proposal-status">
                            @if($proposal->status == 0)
                                <div class="collaboration-status-badge pending-yellow"></div>
                                Pending
                            @elseif($proposal->status == 1)
                                <div class="collaboration-status-badge accepted-green"></div>
                                Accepted
                            @else
                                <div class="collaboration-status-badge rejected"></div>
                                Rejected
                            @endif
                        </h2>
                    </div>
                    <div class="my-proposal-details">
                        <h3>Collaboration Title</h3>
                        <h3 id="my-proposal-job-title">
                            {{ $proposal->collaboration->title }}
                        </h3>
                    </div>
                    <div class="my-proposal-details">
                        <h3>Proposed Amount by You</h3>
                        <h3 id="my-proposal-job-title">
                            LKR{{ $proposal->proposed_budget }}
                        </h3>
                    </div>
                    <div class="offer-actions">
                        <div class="main">
                            @if($proposal->status == 0)
                                <button class="decline" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $proposal->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <button class="edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProposalModal{{ $proposal->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            @endif
                        </div>
                        <div class="other">
                            <button class="message">
                                <i class="fa-solid fa-message"></i>
                                <h3>Chat</h3>
                            </button>
                            <button class="view" data-bs-toggle="modal"
                                    data-bs-target="#viewCollaboration-{{ $proposal->collaboration->id }}">
                                <h3>View</h3>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal{{ $proposal->id }}" tabindex="-1"
                 aria-labelledby="deleteModalLabel{{ $proposal->id }}"
                 aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="incoming-offer-container">
                            <div class="glass-effect">
                                <div class="offer-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Proposal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="offer-task-section delete-modal-body">
                                    <p>Are you sure you want to delete this proposal?</p>
                                    <div class="delete-custom-button-container">
                                        <form method="post"
                                              action="{{ route('proposals.destroyByInfluencers', $proposal->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-modal-button delete">Delete</button>
                                        </form>
                                        <button type="button" class="delete-modal-button" data-bs-dismiss="modal">Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editProposalModal{{ $proposal->id }}" tabindex="-1"
                 aria-labelledby="editProposalModalLabel{{ $proposal->id }}"
                 aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="custom-modal-header modal-header">
                            <h5 class="modal-title" id="editProposalModalLabel">Edit Proposal By
                                "{{ $proposal->influencer->name }}" for Collaboration id
                                "{{ $proposal->collaboration_id }}"</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="custom-modal-body modal-body">
                            <form method="post" action="{{ route('proposals.updateByInfluencers', $proposal->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-container">
                                    <input type="hidden" name="collaboration_id"
                                           value="{{ $proposal->collaboration_id }}">
                                    <div class="col input-item">
                                        <label for="proposed_budget">Proposed Budget</label>
                                        <input type="text" class="form-control" id="proposed_budget"
                                               name="proposed_budget" value="{{ $proposal->proposed_budget }}" required>
                                    </div>
                                    <div class="col input-item">
                                        <label for="supporting_links">Supporting Links</label>
                                        <input type="text" placeholder="separate with a comma(,)" class="form-control"
                                               id="supporting_links" name="supporting_links"
                                               value="{{ $proposal->supporting_links }}">
                                    </div>
                                    <div id="col input-item tasks-container">
                                        <label for="tasks">Supporting Files</label>
                                        <div id="files_body" class="tasks-body">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @php
                                                    $fileKey = "supporting_file_$i";
                                                @endphp
                                                @if ($proposal->$fileKey)
                                                    <div class="task-body">
                                                        <input disabled type="text" class="form-control"
                                                               id="{{ $fileKey }}" name="{{ $fileKey }}"
                                                               value="{{ basename(Storage::url($proposal->$fileKey)) }}"
                                                               readonly>
                                                        <input type="hidden" id="new_{{ $fileKey }}"
                                                               name="new_{{ $fileKey }}">
                                                        <button type="button" class="btn btn-danger remove-button"
                                                                data-file-key="{{ $fileKey }}">Remove
                                                        </button>
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="custom-button-container">
                                        <button type="button" id="upload_file_button" class="btn btn-primary">Upload
                                            File
                                        </button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewCollaboration-{{ $proposal->collaboration->id }}" tabindex="-1"
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
                                        <h2>{{ $proposal->collaboration->business->name }}</h2>
                                    </div>
                                    <div class="modal-close-section">
                                        <h2 class="offer-budget">
                                            LKR {{ $proposal->collaboration->budget }}
                                        </h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="offer-title-date">
                                    <h3>
                                        {{ $proposal->collaboration->title }}
                                    </h3>
                                    <h3 id="offer-deadline">
                                        {{ $proposal->collaboration->deadline }}
                                    </h3>
                                </div>
                                <h4 class="offer-description">
                                    {{ $proposal->collaboration->description }}
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
                                        @foreach($proposal->collaboration->tasks as $task)
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
        @endforeach
    </div>
    <script>
        let fileId = 1;
        const taskContainer = document.getElementById('files_body');

        document.getElementById('upload_file_button').addEventListener('click', function () {
            const fileBody = document.createElement('div');
            fileBody.className = 'task-body';

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = `supporting_file_${fileId}`;
            fileInput.className = 'form-control';
            fileInput.style.display = 'none'; // Hide the input element
            fileBody.appendChild(fileInput);

            const fileNameDisplay = document.createElement('span');
            fileBody.appendChild(fileNameDisplay);

            const deleteButton = document.createElement('button');
            deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>';
            deleteButton.className = 'btn btn-danger';
            deleteButton.type = 'button';
            deleteButton.addEventListener('click', function () {
                fileBody.remove();
            });
            fileBody.appendChild(deleteButton);
            taskContainer.appendChild(fileBody);

            // Trigger click event on the file input
            fileInput.click();

            // Display the name of the file after it's selected
            fileInput.addEventListener('change', function () {
                if (fileInput.files.length > 0) {
                    fileNameDisplay.textContent = fileInput.files[0].name;
                }
            });

            fileId++;
        });
    </script>
@endsection
