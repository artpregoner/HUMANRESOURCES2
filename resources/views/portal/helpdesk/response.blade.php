@extends('layouts.app')
@section('title','Helpdesk - Reply')
{{-- @section('header','Helpdesk')
@section('active-header', 'View Reply') --}}
@push('styles')
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">
                    <i class="fas fa-inbox"></i> Ticket Reply for:
                </h4>
                <div class="toolbar ml-auto">
                    <a href="{{ route('portal.helpdesk.index') }}" class="btn btn-space btn-light">Return to Ticket List</a>
                    <button class="btn btn-space btn-code3 btn-sm new-chat-btn">
                        <i class="fas fa-reply"></i> Reply
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="reply-box" class="reply-box" style="display: none;">
                    <div class="reply-tools">
                        <button class="btn btn-sm btn-light mr-2" onclick="document.getElementById('image-input').click();">
                            <i class="fas fa-image"></i> Add Image
                        </button>
                        <button class="btn btn-sm btn-light mr-2" onclick="document.getElementById('file-input').click();">
                            <i class="fas fa-paperclip"></i> Add File
                        </button>
                    </div>
                    <div class="reply-input-container">
                        <textarea class="form-control mb-2" rows="4" placeholder="Type your reply here..."></textarea>
                        <div class="reply-actions">
                            <button class="btn btn-light mr-2" onclick="discardReply()">
                                <i class="fas fa-times"></i> Discard
                            </button>
                            <button class="btn btn-code3" onclick="sendReply()">
                                <i class="fas fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </div>
                </div>
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
</div>
@endsection

@push('scripts')
<script>
    document.querySelector('.new-chat-btn').addEventListener('click', () => {
        const replyBox = document.getElementById('reply-box');
        replyBox.style.display = 'block';
        replyBox.querySelector('textarea').focus();
    });

    function discardReply() {
        const replyBox = document.getElementById('reply-box');
        replyBox.style.display = 'none';
        replyBox.querySelector('textarea').value = '';
    }

    function sendReply() {
        const textarea = document.querySelector('.reply-input-container textarea');
        const message = textarea.value.trim();

        if (message) {
            console.log('Sending message:', message);
            textarea.value = '';
            discardReply();
        }
    }
    function sendReply() {
    const textarea = document.querySelector('.reply-input-container textarea');
    const message = textarea.value.trim();

    if (message) {
        // Sample data for new message (sa actual implementation, gamitin ang server-side logic)
        const newMessage = {
            author: "You",
            avatar: "{{ asset('template/assets/images/admin.webp') }}",
            text: message,
            time: new Date().toLocaleString(), // Format: MM/DD/YYYY HH:mm
        };

        // Append the new message to the top of the chatbox
        const chatboxMessages = document.querySelector('.chatbox-messages');
        chatboxMessages.insertAdjacentHTML('afterbegin', `
            <div class="chat-message sent">
                <img src="${newMessage.avatar}" alt="${newMessage.author}" class="chat-avatar">
                <div class="chat-details">
                    <span class="message-author">${newMessage.author}</span>
                    <p class="message-text">${newMessage.text}</p>
                    <span class="message-time">${newMessage.time}</span>
                </div>
            </div>
            <hr class="message-divider">
        `);

        // Scroll to the bottom of the chatbox
        chatboxMessages.scrollTop = chatboxMessages.scrollHeight;

        // Clear the input field and hide reply box
        textarea.value = '';
        discardReply();

        console.log('Message sent:', newMessage);
    } else {
        alert('Please enter a message before sending.');
    }
}

</script>
@endpush
