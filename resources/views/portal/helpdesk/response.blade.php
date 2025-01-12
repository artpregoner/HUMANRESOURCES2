@extends('layouts.app')
@section('title','Helpdesk - Reply')
{{-- @section('header','Helpdesk')
@section('active-header', 'View Reply') --}}
@push('styles')
<style>
    .chat-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 400px;
        height: 500px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        z-index: 1000;
    }

    .chat-header {
        padding: 15px;
        border-bottom: 1px solid #e5e7eb;
        background: #f8f9fa;
        border-radius: 8px 8px 0 0;
    }

    .chat-tools {
        width: 100%;
    }

    .tool-buttons button,
    .view-controls button {
        padding: 5px 10px;
        border: 1px solid #dee2e6;
    }

    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
    }

    .chat-footer {
        padding: 15px;
        border-top: 1px solid #e5e7eb;
        background: #f8f9fa;
        border-radius: 0 0 8px 8px;
    }

    /* Fullscreen mode */
    .chat-container.fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        border-radius: 0;
    }

    /* Modal mode */
    .chat-container.modal {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        height: 80%;
    }

    .back-btn {
        width: 100%;
    }

    .new-chat-btn {
        margin-right: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .chat-container {
            width: 100%;
            height: 100%;
            bottom: 0;
            right: 0;
            border-radius: 0;
        }
    }

    .chatbox {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    max-height: 400px;
    overflow-y: auto;
    background-color: #fdfdfd;
}

.chatbox-messages {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.chat-message {
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.chat-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.chat-details {
    flex-grow: 1;
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 10px 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.message-author {
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 1.1em;
}

.message-text {
    margin: 5px 0;
    line-height: 1.6;
    font-size: 1em;
}

.message-time {
    font-size: 0.9em;
    color: #888;
    margin-top: 5px;
}

.message-divider {
    border: 0;
    border-top: 1px solid #ddd;
    margin: 0;
}


    </style>
@endpush
@section('content')
<!-- Chat Container (Initially Hidden) -->
<div id="chat-container" class="chat-container" style="display: none;">
    <!-- Chat Header -->
    <div class="chat-header">
        <div class="chat-tools d-flex align-items-center">
            <div class="tool-buttons">
                <input type="file" id="image-input" class="d-none" />
                <button class="btn btn-sm btn-light mr-2" title="Add Image" onclick="document.getElementById('image-input').click();">
                    <i class="fas fa-image"></i>
                </button>
                <input type="file" id="file-input" class="d-none" />
                <button class="btn btn-sm btn-light mr-2" title="Add File" onclick="document.getElementById('file-input').click();">
                    <i class="fas fa-paperclip"></i>
                </button>
                <input type="url" id="link-input" class="d-none" placeholder="Enter link" />
                <button class="btn btn-sm btn-light mr-2" title="Add Link" onclick="document.getElementById('link-input').focus();">
                    <i class="fas fa-link"></i>
                </button>
            </div>
            <div class="view-controls ml-auto">
                <button class="btn btn-sm btn-light mr-2" title="Fullscreen" onclick="toggleFullscreen();">
                    <i class="fas fa-expand"></i>
                </button>
                <button class="btn btn-sm btn-light" title="Modal View" onclick="toggleModal();">
                    <i class="fas fa-compress"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Chat Body -->
    <div class="chat-body">
        <!-- Messages will go here -->
    </div>

    <!-- Chat Footer -->
    <div class="chat-footer">
        <button class="btn btn-secondary back-btn" onclick="closeChat()">
            <i class="fas fa-arrow-left"></i> Back
        </button>
    </div>
</div>
<div class="row">
    <!-- ============================================================== -->
    <!-- CHAT BOX -->
    <!-- ============================================================== -->
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">
                    <i class="fas fa-inbox"></i> Ticket Reply for:
                </h4>
                <div class="toolbar ml-auto">
                    <a href="{{ route('portal.helpdesk.index') }}" class="btn btn-space btn-light" aria-label="Return to the ticket list">Return Ticket List</a>
                    <a href="#" class="btn btn-space btn-primary btn-sm new-chat-btn" aria-label="Reply to this ticket">
                        <i class="fas fa-reply"></i> Reply
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Chatbox -->
                <div class="chatbox">
                    <div class="chatbox-messages">
                        <div class="chat-message received">
                            <img src="{{ asset('template/assets/images/user1.png') }}" alt="Admin" class="chat-avatar">
                            <div class="chat-details">
                                <span class="message-author">Admin</span>
                                <p class="message-text">Hello, how can I assist you?</p>
                                <span class="message-time">01/12/2025 15:55</span>
                            </div>
                        </div>
                        <hr class="message-divider">
                        <div class="chat-message sent">
                            <img src="{{ asset('template/assets/images/admin.webp') }}" alt="You" class="chat-avatar">
                            <div class="chat-details">
                                <span class="message-author">You</span>
                                <p class="message-text">I need help with my account.</p>
                                <span class="message-time">01/12/2025 15:56</span>
                            </div>
                        </div>
                        <hr class="message-divider">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- CHAT BOX -->
    <!-- ============================================================== -->
</div>
@endsection
@push('scripts')
<script>
    let chatVisible = false;

    document.querySelector('.new-chat-btn').addEventListener('click', () => {
        const chatContainer = document.getElementById('chat-container');
        if (!chatVisible) {
            chatContainer.style.display = 'flex';
            chatVisible = true;
        }
    });

    function closeChat() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.style.display = 'none';
        chatVisible = false;
    }

    function toggleFullscreen() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.classList.toggle('fullscreen');
    }

    function toggleModal() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.classList.toggle('modal');
    }
    </script>
@endpush
