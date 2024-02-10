@extends('layouts.collaborations')

@section('collaborations-content')
    <div class="offer-body">
        <h3>My Proposals</h3>
        <div class="incoming-offer-container">
            <div class="glass-effect">
                <div class="offer-header">
                    <div class="offer-user">
                        {{--                <img src="" alt="Avatar">--}}
                        <i class="fa-solid fa-user"></i>
                        <h2>Code 94 Labs</h2>
                    </div>
                    <h2 class="offer-budget">
                        LKR 50,000
                    </h2>
                </div>
                <div class="my-proposal-job-details">
                    <h3>Job Title</h3>
                    <h3 id="my-proposal-job-title">Need for acting in an ad campaign</h3>
                </div>
                <div class="my-proposal-amount">
                    <h3>Proposed Amount by You</h3>
                    <h3 id="my-proposal-job-title">LKR 40,000</h3>
                </div>
                <div class="offer-actions">
                    <div class="main">
                        <button class="decline">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <button class="edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <div class="other">
                        <button class="message">
                            <i class="fa-solid fa-message"></i>
                            <h3>Chat</h3>
                        </button>
                        <button class="view">
                            <h3>View</h3>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="incoming-offer-container">
            <div class="glass-effect">
                <div class="offer-header">
                    <div class="offer-user">
                        {{--                <img src="" alt="Avatar">--}}
                        <i class="fa-solid fa-user"></i>
                        <h2>Code 94 Labs</h2>
                    </div>
                    <h2 class="offer-budget">
                        LKR 50,000
                    </h2>
                </div>
                <div class="my-proposal-job-details">
                    <h3>Job Title</h3>
                    <h3 id="my-proposal-job-title">Need for acting in an ad campaign</h3>
                </div>
                <div class="my-proposal-amount">
                    <h3>Proposed Amount by You</h3>
                    <h3 id="my-proposal-job-title">LKR 40,000</h3>
                </div>
                <div class="offer-actions">
                    <div class="main">
                        <button class="decline">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <button class="edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <div class="other">
                        <button class="message">
                            <i class="fa-solid fa-message"></i>
                            <h3>Chat</h3>
                        </button>
                        <button class="view" data-bs-toggle="modal" data-bs-target="#viewOffer">
                            <h3>View</h3>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="viewOffer" tabindex="-1" aria-labelledby="viewOfferLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered custom-modal-width">
                <div class="modal-content">
                    <div class="incoming-offer-container">
                        <div class="glass-effect">
                            <div class="offer-header">
                                <div class="offer-user">
                                    {{--                <img src="" alt="Avatar">--}}
                                    <i class="fa-solid fa-user"></i>
                                    <h2>Code 94 Labs</h2>
                                </div>
                                <div class="modal-close-section">
                                    <h2 class="offer-budget">
                                        LKR 50,000
                                    </h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="offer-title-date">
                                <h3>Need for acting in an ad campaign</h3>
                                <h3 id="offer-deadline">10/02/2023</h3>
                            </div>
                            <h4 class="offer-description">We will be showcasing a ad on hiring more youth into the
                                company. This to get
                                a
                                global outreach and and expand our business further </h4>
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
                                    <div class="offer-task">
                                        <h4>
                                            Cordially act with other performers to produce an ad
                                        </h4>
                                        <div class="offer-task-priority high-priority"></div>
                                    </div>
                                    <div class="offer-task">
                                        <h4>
                                            Cordially act with other performers to produce an ad
                                        </h4>
                                        <div class="offer-task-priority medium-priority"></div>
                                    </div>
                                    <div class="offer-task">
                                        <h4>
                                            Cordially act with other performers to produce an ad
                                        </h4>
                                        <div class="offer-task-priority low-priority"></div>
                                    </div>
                                    <div class="offer-task">
                                        <h4>
                                            Cordially act with other performers to produce an ad
                                        </h4>
                                        <div class="offer-task-priority high-priority"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="offer-actions">
                                <div class="other">
                                    <button class="message">
                                        <i class="fa-solid fa-message"></i>
                                        <h3>Chat</h3>
                                    </button>
                                </div>
                                <div class="main">
                                    <button class="decline">
                                        <h3>Reject</h3>
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                    <button class="accept">
                                        <h3>Accept</h3>
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
