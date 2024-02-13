@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="users-header">
                    <h3>Proposals</h3>
                    <div class="search-add">
                        <div class="add-user-button">
                            <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addProposalModal">Add
                                Proposal</a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="table-column-id">ID</th>
                        <th class="table-column-title">Influencer</th>
                        <th class="table-column-business">Proposed Amount</th>
                        <th class="table-column-influencer">Collaboration ID</th>
                        <th class="table-column-status">Status</th>
                        <th class="table-column-actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($proposals as $proposal)
                        <tr>
                            <td>{{ $proposal->id }}</td>
                            <td>{{ \App\Models\User::find($proposal->influencer_id)->name }}</td>
                            <td>{{ $proposal->proposed_budget }}</td>
                            <td>
                                {{ $proposal->collaboration_id }}
                            </td>
                            <td>
                                @if ($proposal->status == 0)
                                    <div class="status orange">
                                        <div class="status-badge"></div>
                                        <p>Pending</p>
                                    </div>
                                @elseif($proposal->status == 1)
                                    <div class="status green">
                                        <div class="status-badge"></div>
                                        <p>Accepted</p>
                                    </div>
                                @elseif($proposal->status == 2)
                                    <div class="status red">
                                        <div class="status-badge"></div>
                                        <p>Rejected</p>
                                    </div>
                                @endif
                            </td>
                            <td class="action-btns">
                                <button type="button" class="btn action-btn edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#viewModal{{ $proposal->id }}">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    View
                                </button>
                                @if ($proposal->status == 0)
                                    <button
                                        type="button"
                                        class="btn action-btn edit-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProposalModal{{ $proposal->id }}"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                        Edit
                                    </button>
                                @endif
                                @if($proposal->status == 0 || $proposal->status == 2)
                                    <button type="button" class="btn action-btn delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $proposal->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </button>
                                @endif
                            </td>
                        </tr>
                        <div class="modal fade" id="editProposalModal{{ $proposal->id }}" tabindex="-1"
                             aria-labelledby="editProposalModalLabel{{ $proposal->id }}"
                             aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="custom-modal-header modal-header">
                                        <h5 class="modal-title" id="editProposalModalLabel">Edit Proposal By
                                            "{{ $proposal->influencer->name }}" for Collaboration id
                                            "{{ $proposal->collaboration_id }}"</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="custom-modal-body modal-body">
                                        <form method="post" action="{{ route('proposals.update', $proposal->id) }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-container">
                                                <input type="hidden" name="collaboration_id"
                                                       value="{{ $proposal->collaboration_id }}">
                                                <input type="hidden" name="influencer_id"
                                                       value="{{ $proposal->influencer_id }}">
                                                <div class="col input-item">
                                                    <label for="proposed_budget">Proposed Budget</label>
                                                    <input type="text" class="form-control" id="proposed_budget"
                                                           name="proposed_budget"
                                                           value="{{ $proposal->proposed_budget }}" required>
                                                </div>
                                                <div class="col input-item">
                                                    <label for="supporting_links">Supporting Links</label>
                                                    <input type="text" placeholder="separate with a comma(,)"
                                                           class="form-control" id="supporting_links"
                                                           name="supporting_links"
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
                                                                <div class="task-body file-body">
                                                                    <span class="form-control" id="{{ $fileKey }}"
                                                                          name="{{ $fileKey }}">
                                                                        {{ strlen(basename(Storage::url($proposal->$fileKey))) > 35 ? substr(basename(Storage::url($proposal->$fileKey)), 0, 35) . '...' : basename(Storage::url($proposal->$fileKey)) }}
                                                                    </span>
                                                                    <input type="hidden" id="new_{{ $fileKey }}"
                                                                           name="new_{{ $fileKey }}">
                                                                    <button type="button"
                                                                            class="btn action-btn delete-btn"
                                                                            data-file-key="{{ $fileKey }}"><i
                                                                            class="fa-solid fa-trash"></i></button>
                                                                </div>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="custom-button-container">
                                                    <button type="button" id="upload_file_button"
                                                            class="btn btn-primary">Upload File
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{ $proposal->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="deleteModalLabel{{ $proposal->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title custom-title"
                                            id="deleteModalLabel{{ $proposal->id }}">
                                            Delete Proposal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            Are you sure you want to delete this proposal?
                                        </div>
                                        <div class="modal-button">
                                            <form action="{{ route('proposals.destroy', $proposal->id) }}"
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
    <div class="modal fade" id="addProposalModal" tabindex="-1" aria-labelledby="addProposalLabel"
         aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="custom-modal-header modal-header">
                    <h5 class="modal-title" id="addProposalLabel">Add Proposal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="custom-modal-body modal-body">
                    <form method="post" action="{{ route('proposals.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-container">
                            <div class="col input-item">
                                <label for="influencer_id">Pick a influencer to assign the proposal to</label>
                                <select id="influencer_id" name="influencer_id" class="form-control">
                                    @foreach ($users as $user)
                                        @if ($user->role_id->value == 10)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col input-item">
                                <label for="collaboration_id">Pick a collaboration to assign the proposal to</label>
                                <select id="collaboration_id" name="collaboration_id" class="form-control">
                                    @foreach ($collaborations as $collaboration)
                                        <option value="{{ $collaboration->id }}">
                                            {{ $collaboration->id }} : {{ $collaboration->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col input-item">
                                <label for="proposed_budget">Proposed Budget</label>
                                <input placeholder="Enter proposed budget" type="text" class="form-control" id="proposed_budget" name="proposed_budget"
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
                                    <h4 class="default-message">Click "Upload File" to add a file to the proposal</h4>
                                    <!-- file fields will be added here -->
                                </div>
                            </div>
                            <div class="custom-button-container">
                                <button type="button" id="upload_file_button1" class="btn btn-primary">Upload File
                                </button>
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
        // Add event listeners to the "Remove" buttons
        document.querySelectorAll('.remove-button').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById(`new_${button.dataset.fileKey}`).value = '';
            });
        });

        let fileId1 = 1;
        const taskContainer1 = document.getElementById('files_body1');
        const defaultMessage1 = document.querySelector('.default-message');

        document.getElementById('upload_file_button1').addEventListener('click', function () {
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
            deleteButton.className = 'btn action-btn delete-btn';
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
