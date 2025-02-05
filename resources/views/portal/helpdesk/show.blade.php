@extends('layouts.app')
@section('title', 'Helpdesk - My Tickets')
@section('header', 'Helpdesk')
@section('active-header', 'Response')
@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/vendor/image-modal/style.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="card-header-title">
                        <i class="fas fa-inbox"></i> Ticket Reply for: {{ $ticket->title }}
                    </h4>
                    <div class="toolbar ml-auto">
                        <a href="{{ route('portal.helpdesk.index') }}" class="btn btn-space btn-light btn-sm">Return to Ticket List</a>
                        <button class="btn btn-space btn-code3 btn-sm new-chat-btn">
                            <i class="fas fa-reply"></i> Reply
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- reply box --}}
                    <form action="{{ route('portal.helpdesk.respond', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="reply-box" class="reply-box" style="display: none;">
                            <div class="reply-tools">
                                <button type="button" class="btn btn-sm btn-light mr-2" id="addImageBtn">
                                    <i class="fas fa-image"></i> Add Image
                                </button>
                                <button type="button" class="btn btn-sm btn-light mr-2" id="addFileBtn">
                                    <i class="fas fa-paperclip"></i> Add File
                                </button>
                                <small class="text-muted ml-2">Maximum 10 files total</small>
                            </div>
                            <div class="reply-input-container">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Type your reply here..." id="response" name="response" rows="3" required></textarea>
                                </div>
                                <!-- Hidden file inputs -->
                                <input type="file" id="image-input" name="files[]" style="display: none;" accept="image/jpeg, image/png, image/webp" multiple>
                                <input type="file" id="file-input" name="files[]" style="display: none;" multiple>
                                <!-- File preview container -->
                                <div id="file-previews" class="mt-3"></div>
                            </div>
                            <div class="reply-actions">
                                <button type="button" class="btn btn-light mr-2" onclick="discardReply()">
                                    <i class="fas fa-times"></i> Discard
                                </button>
                                <button type="submit" class="btn btn-code3">
                                    <i class="fas fa-paper-plane"></i> Send
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- response section --}}
                    <div class="chatbox">
                        @include('components.modal.image-modal')
                        @foreach ($responses->reverse() as $response)
                            <div class="chatbox-messages">
                                <div class="chat-message received">
                                    <img src="{{ asset('template/assets/images/user1.png') }}" alt="Admin" class="user-avatar-lg rounded-circle">
                                    <div class="chat-details">
                                        <span class="message-author">{{ $response->user->name }}</span>
                                        <p class="message-text">{{ $response->response_text }}</p>

                                        <!-- Displaying images inline -->
                                        <div class="message-attachment">
                                            @foreach ($response->files as $file)
                                                @if (in_array($file->file_type, ['image/jpeg', 'image/png', 'image/gif']))
                                                    <img src="{{ asset('storage/' . $file->file_path) }}" alt="Attached Image" class="message-image modalThisImage">
                                                @else
                                                    <div class="media media-attachment">
                                                        <div class="avatar bg-primary">
                                                            <i class="far fa-file-image"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ $file->file_name }}</a>
                                                            <span>{{ number_format($file->file_size / 1024, 2) }} KB</span>  <!-- Use file_size directly -->
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <span class="message-time">{{ $response->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                                <hr class="message-divider">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        // Global variables for attachments
        let selectedImages = [];
        let selectedFiles = [];
        const MAX_ATTACHMENTS = 10;

        // Show reply box when 'Reply' button is clicked
        document.querySelector('.new-chat-btn').addEventListener('click', () => {
            const replyBox = document.getElementById('reply-box');
            replyBox.style.display = 'block';
            replyBox.querySelector('textarea').focus();
        });

        // Discard the reply and clear inputs
        function discardReply() {
            const replyBox = document.getElementById('reply-box');
            replyBox.style.display = 'none';
            document.querySelector('.reply-input-container textarea').value = '';
            document.getElementById('image-input').value = '';
            document.getElementById('file-input').value = '';
            document.getElementById('file-previews').innerHTML = '';
            selectedImages = [];
            selectedFiles = [];
        }

        // Handle image file selection and preview
        document.getElementById('addImageBtn').addEventListener('click', function() {
            if (selectedImages.length + selectedFiles.length >= MAX_ATTACHMENTS) {
                alert('Maximum 10 files allowed.');
                return;
            }
            document.getElementById('image-input').click();
        });

        // Handle file selection and preview
        document.getElementById('addFileBtn').addEventListener('click', function() {
            if (selectedImages.length + selectedFiles.length >= MAX_ATTACHMENTS) {
                alert('Maximum 10 files allowed.');
                return;
            }
            document.getElementById('file-input').click();
        });

        // Handle image input change
        document.getElementById('image-input').addEventListener('change', function(event) {
            previewAttachments(event.target.files, 'image');
        });

        // Handle file input change
        document.getElementById('file-input').addEventListener('change', function(event) {
            previewAttachments(event.target.files, 'file');
        });

        // Preview selected attachments (image/file)
        function previewAttachments(files, type) {
            const previewContainer = document.getElementById('file-previews');
            const isImage = type === 'image';
            const fileLimit = MAX_ATTACHMENTS - selectedImages.length - selectedFiles.length;

            if (files.length > fileLimit) {
                alert(`Only ${fileLimit} more file(s) can be added.`);
                return;
            }

            for (let file of files) {
                if (isImage && !['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                    alert('Only JPEG, PNG, and WEBP images are allowed.');
                    continue;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'file-preview-item d-flex align-items-center';

                    if (isImage) {
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" style="max-width: 100px; margin-right: 10px;">
                            <span>${file.name}</span>
                            <button type="button" class="btn btn-sm btn-danger ml-auto remove-file" onclick="removeAttachment('${file.name}')">×</button>
                        `;
                        selectedImages.push(file);
                    } else {
                        previewItem.innerHTML = `
                            <i class="fas fa-file mr-2"></i>
                            <span>${file.name}</span>
                            <button type="button" class="btn btn-sm btn-danger ml-auto remove-file" onclick="removeAttachment('${file.name}')">×</button>
                        `;
                        selectedFiles.push(file);
                    }

                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            }
        }

        // Remove image/file from preview
        function removeAttachment(fileName) {
            selectedImages = selectedImages.filter(img => img.name !== fileName);
            selectedFiles = selectedFiles.filter(file => file.name !== fileName);
            updatePreview();
        }

        // Update file preview
        function updatePreview() {
            const previewContainer = document.getElementById('file-previews');
            previewContainer.innerHTML = '';
            selectedImages.concat(selectedFiles).forEach(file => {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'file-preview-item d-flex align-items-center';
                fileDiv.innerHTML = `
                    <span>${file.name}</span>
                    <button type="button" class="btn btn-sm btn-danger ml-auto remove-file" onclick="removeAttachment('${file.name}')">×</button>
                `;
                previewContainer.appendChild(fileDiv);
            });
        }
    </script>
    <script src="{{ asset('asset/vendor/image-modal/scripts.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
// Handle form submission with AJAX
$('form').on('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = $(this);
    const formData = new FormData(form[0]);

    // Disable submit button to prevent multiple submissions
    $('button[type="submit"]').prop('disabled', true);

    // Send the form data using AJAX
    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // On success, append the new response to the chatbox
            const newMessage = `
                <div class="chatbox-messages">
                    <div class="chat-message received">
                        <img src="{{ asset('template/assets/images/user1.png') }}" alt="Admin" class="user-avatar-lg rounded-circle">
                        <div class="chat-details">
                            <span class="message-author">${response.user_name}</span>
                            <p class="message-text">${response.response_text}</p>
                            <div class="message-attachment">
                                ${response.files.map(file => `
                                    <img src="${file.url}" alt="Attached Image" class="message-image modalThisImage">
                                `).join('')}
                            </div>
                            <span class="message-time">${response.created_at}</span>
                        </div>
                    </div>
                    <hr class="message-divider">
                </div>
            `;
            $('.chatbox').prepend(newMessage); // Prepend the new message at the top
            $('#response').val(''); // Clear the reply textarea
            document.getElementById('image-input').value = '';
            document.getElementById('file-input').value = '';
            document.getElementById('file-previews').innerHTML = ''; // Clear file previews
            selectedImages = [];
            selectedFiles = [];

            // Re-enable the submit button
            $('button[type="submit"]').prop('disabled', false);
        },
        error: function(xhr, status, error) {
            alert('Error occurred while sending the response.');
            $('button[type="submit"]').prop('disabled', false); // Re-enable submit button in case of error
        }
    });
});

    </script>

@endpush
