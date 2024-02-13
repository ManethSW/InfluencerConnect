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
        @endforeach
    </div>
@endsection
