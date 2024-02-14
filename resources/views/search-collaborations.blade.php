@extends('layouts.app')

@include('components.navbar')

@section('content')

    <div class="section">
        <div class="section-header">
            <div class="section-header-content">
                <h2>Apply For Collaborations</h2>
                <h4>
                    Find the best collaborations that suit your needs and apply for them.
                </h4>
            </div>
            <div class="section-header-divider"></div>
        </div>
        <div class="offer-body search-collaborations-container">
            @foreach($pendingCollaborations as $pendingCollaboration)
                <div class="incoming-offer-container">
                    <div class="glass-effect">
                        <div class="offer-header">
                            <div class="offer-user">
                                <i class="fa-solid fa-user"></i>
                                <h2>
                                    {{ $pendingCollaboration->business->name }}
                                </h2>
                            </div>
                            <div class="active-collaboration-budegt-type">
                                <h2 class="offer-budget">
                                    {{ \App\Enums\CollaborationType::asSelectArray()[$pendingCollaboration->collaboration_type] }}
                                </h2>
                                <h2 class="offer-budget">
                                    {{$pendingCollaboration->budget}}LKR
                                </h2>
                            </div>
                        </div>
                        <div class="active-collaboration-title-deadline">
                            <div class="title-status-badge">
                                @if($pendingCollaboration->status == 0)
                                    <div class="collaboration-status-badge pending"></div>
                                @elseif($pendingCollaboration->status == 1)
                                    <div class="collaboration-status-badge accepted"></div>
                                @elseif($pendingCollaboration->status == 2)
                                    <div class="collaboration-status-badge completed"></div>
                                @elseif($pendingCollaboration->status == 3)
                                    <div class="collaboration-status-badge rejected"></div>
                                @endif
                                <h3>{{ $pendingCollaboration->title }}</h3>
                            </div>
                            <h3>
                                {{ $pendingCollaboration->deadline }}
                            </h3>
                        </div>
                        <h4 class="offer-description">
                            {{ $pendingCollaboration->description }}
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
                                @php
                                    $hasSubmitted = \App\Models\Proposal::where('collaboration_id', $pendingCollaboration->id)
                                        ->where('influencer_id', Auth::id())
                                        ->exists();
                                @endphp

                                @if($hasSubmitted)
                                    <button class="view" disabled>
                                        <h3>Submitted</h3>
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                @else
                                    <button class="view" data-bs-toggle="modal"
                                            data-collaboration-id="{{ $pendingCollaboration->id }}"
                                            data-bs-target="#applyProposal">
                                        <h3>Apply</h3>
                                        <i class="fa-solid fa-file-import"></i>
                                    </button>
                                @endif
                                <button class="view" data-bs-toggle="modal"
                                        data-bs-target="#viewCollaboration-{{$pendingCollaboration->id}}">
                                    <h3>View</h3>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="viewCollaboration-{{ $pendingCollaboration->id }}" tabindex="-1"
                     aria-labelledby="viewCollaborationLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered custom-modal-width">
                        <div class="modal-content">
                            <div class="incoming-offer-container">
                                <div class="glass-effect">
                                    <div class="offer-header">
                                        <div class="offer-user">
                                            <i class="fa-solid fa-user"></i>
                                            <h2>{{ $pendingCollaboration->business->name }}</h2>
                                        </div>
                                        <div class="modal-close-section">
                                            <h2 class="offer-budget">
                                                LKR {{ $pendingCollaboration->budget }}
                                            </h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="offer-title-date">
                                        <h3>
                                            {{ $pendingCollaboration->title }}
                                        </h3>
                                        <h3 id="offer-deadline">
                                            {{ $pendingCollaboration->deadline }}
                                        </h3>
                                    </div>
                                    <h4 class="offer-description">
                                        {{ $pendingCollaboration->description }}
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
                                            @foreach($pendingCollaboration->tasks as $task)
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
            <div class="modal fade" id="applyProposal" tabindex="-1" aria-labelledby="applyProposalLabel"
                 aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="custom-modal-header modal-header">
                            <h5 class="modal-title" id="addProposalLabel">Apply your proposal here</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="custom-modal-body modal-body">
                            <form method="post" action="{{ route('proposals.storeByInfluencers') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="collaboration-id-input" name="collaboration_id">
                                <div class="form-container">
                                    <input type="hidden" name="collaboration_id"
                                           value="{{ $pendingCollaboration->id }}">
                                    <div class="col input-item">
                                        <label for="proposed_budget">Proposed Budget</label>
                                        <input placeholder="Enter proposed budget" type="text" class="form-control"
                                               id="proposed_budget" name="proposed_budget"
                                               required>
                                    </div>
                                    <div class="col input-item">
                                        <label for="supporting_links">Supporting Links</label>
                                        <input type="text" placeholder="separate with a comma(,)" class="form-control"
                                               id="supporting_links" name="supporting_links">
                                    </div>
                                    <div id="col input-item">
                                        <label for="tasks">Supporting Files</label>
                                        <div id="files_body1" class="tasks-body">
                                            <h4 class="default-message">Click "Upload File" to add a file to the
                                                proposal</h4>
                                            <!-- file fields will be added here -->
                                        </div>
                                    </div>
                                    <div class="custom-button-container">
                                        <button type="button" id="upload_file_button1" class="">Upload File
                                        </button>
                                        <button type="submit" class="">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <x-footer/>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.remove-button').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById(`new_${button.dataset.fileKey}`).value = '';
            });
        });

        let fileId1 = 1;
        const taskContainer1 = document.getElementById('files_body1');
        const defaultMessage1 = document.querySelector('.default-message');

        document.querySelectorAll('.view').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('collaboration-id-input').value = this.getAttribute('data-collaboration-id');
            });
        });

        document.getElementById('upload_file_button1').addEventListener('click', function () {
            // Get the data of the collaboration id and set it to the form as a hidden input

            if (defaultMessage1) {
                defaultMessage1.remove();
            }

            const fileBody = document.createElement('div');
            fileBody.className = 'task-body file-body';

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = `supporting_file_${fileId1}`;
            fileInput.className = 'form-control';
            fileInput.style.display = 'none'; // Hide the input element
            fileBody.appendChild(fileInput);

            const fileNameDisplay = document.createElement('span');
            fileBody.appendChild(fileNameDisplay);

            const deleteButton = document.createElement('button');
            deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>';
            deleteButton.className = 'action-btn delete-btn';
            deleteButton.type = 'button';
            deleteButton.addEventListener('click', function () {
                fileBody.remove();
            });
            fileBody.appendChild(deleteButton);
            taskContainer1.appendChild(fileBody);

            // Trigger click event on the file input
            fileInput.click();

            // Display the name of the file after it's selected
            fileInput.addEventListener('change', function () {
                let fileName = fileInput.files[0].name;
                fileNameDisplay.textContent = fileName.length > 35 ? fileName.substring(0, 35) + '...' : fileName;
            });

            fileId1++;
        });
    });
</script>
