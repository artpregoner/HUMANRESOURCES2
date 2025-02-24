@extends('layouts.app')
@section('title', 'Helpdesk - Reply')
@section('header', 'Helpdesk')
@section('active-header', 'Ticket Response')
@section('back-button')
    <a href="{{ route('hr2.helpdesk.index') }}" class="btn btn-space btn-code8 btn-sm float-right">Return to Ticket List</a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/vendor/image-modal/style.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.modal.image-modal')
            <livewire:hr2.helpdesk.respond :ticket="$ticket" />
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('asset/vendor/image-modal/scripts.js') }}"></script>
    <script>
        // Global variables to track attachments
        let selectedImages = [];
        let selectedFiles = [];
        const MAX_ATTACHMENTS = 10;

        // Show the reply box when the reply button is clicked
        document.querySelector('.new-chat-btn').addEventListener('click', () => {
            const replyBox = document.getElementById('reply-box');
            replyBox.style.display = 'block';
            replyBox.querySelector('textarea').focus();
        });

        // Discard the reply and hide the reply box
        function discardReply() {
            const replyBox = document.getElementById('reply-box');
            replyBox.style.display = 'none';

            // Clear the textarea and reset the preview sections
            document.querySelector('.reply-input-container textarea').value = '';
            document.getElementById('image-input').value = ''; // Clear image input field
            document.getElementById('file-input').value = ''; // Clear file input field
            document.getElementById('image-preview').style.display = 'none';
            document.getElementById('file-name').style.display = 'none';
            document.getElementById('image-display').innerHTML = ''; // Clear image preview display
            document.getElementById('file-display').innerHTML = ''; // Clear file preview display

            // Reset the arrays for selected images and files
            selectedImages = [];
            selectedFiles = [];
        }

        // Function to preview the selected image
        function previewImage(event) {
            const files = event.target.files;
            const totalFiles = selectedImages.length + selectedFiles.length + files.length;

            if (totalFiles > MAX_ATTACHMENTS) {
                alert(`You can only attach up to ${MAX_ATTACHMENTS} files in total.`);
                event.target.value = '';
                return;
            }

            for (let file of files) {
                if (!file.type.match('image/(jpeg|png|webp)')) {
                    alert('Only JPEG, PNG, and WEBP images are allowed.');
                    continue;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedImages.push({
                        name: file.name,
                        url: e.target.result
                    });
                    updatePreview();
                };
                reader.readAsDataURL(file);
            }
        }

        // Function to display the selected file name
        function displayFileName(event) {
            const files = event.target.files;
            const totalFiles = selectedImages.length + selectedFiles.length + files.length;

            if (totalFiles > MAX_ATTACHMENTS) {
                alert(`You can only attach up to ${MAX_ATTACHMENTS} files in total.`);
                event.target.value = '';
                return;
            }

            for (let file of files) {
                selectedFiles.push(file.name);
            }
            updatePreview();
        }

        // Function to update preview of all attachments
        function updatePreview() {
            const imagePreview = document.getElementById('image-preview');
            const fileDisplay = document.getElementById('file-display');
            const fileNameContainer = document.getElementById('file-name');

            // Update image previews
            if (selectedImages.length > 0) {
                imagePreview.style.display = 'block';
                imagePreview.innerHTML = selectedImages.map((img, index) =>
                    `<div class="file-preview-item" style="display: flex; align-items: center; margin-bottom: 10px;">
                <img src="${img.url}" alt="Preview" style="max-width: 100px; margin-right: 10px;">
                <span>${img.name}</span>
                <button type="button" class="btn btn-sm btn-danger remove-file" onclick="removeImage(${index})" style="margin-left: auto;">×</button>
            </div>`).join('');
            } else {
                imagePreview.style.display = 'none';
            }

            // Update file list
            if (selectedFiles.length > 0) {
                fileNameContainer.style.display = 'block';
                fileDisplay.innerHTML = selectedFiles.map((filename, index) =>
                    `<div class="file-preview-item" style="display: flex; align-items: center; margin-bottom: 10px;">
                <span>${filename}</span>
                <button type="button" class="btn btn-sm btn-danger remove-file" onclick="removeFile(${index})" style="margin-left: auto;">×</button>
            </div>`).join('');
            } else {
                fileNameContainer.style.display = selectedImages.length > 0 ? 'block' : 'none';
            }
        }

        // Remove image from the preview
        function removeImage(index) {
            selectedImages.splice(index, 1);
            updatePreview();
        }

        // Remove file from the preview
        function removeFile(index) {
            selectedFiles.splice(index, 1);
            updatePreview();
        }

        // Function to send reply with attachments
        function sendReply() {
            const textarea = document.querySelector('.reply-input-container textarea');
            const message = textarea.value.trim();

            let messageContent = '';

            if (message) {
                messageContent += `<p class="message-text">${message}</p>`;
            }

            // Add images (only those that were selected)
            selectedImages.forEach(img => {
                messageContent += `
            <div class="message-attachment">
                <img src="${img.url}" alt="Attached Image" class="message-image modalThisImage">
            </div>
        `;
            });

            // Add files (only those that were selected)
            selectedFiles.forEach(filename => {
                messageContent += `
            <div class="media media-attachment">
                <div class="avatar bg-primary">
                    <i class="far fa-file-image"></i>
                </div>
                <div class="media-body">
                    <a href="#" class="">${filename}</a>
                    <span>24kb Document</span>
                </div>
            </div>
        `;
            });

            // If there is content (text + images/files), send the message
            if (messageContent) {
                const chatboxMessages = document.querySelector('.chatbox-messages');
                chatboxMessages.insertAdjacentHTML('afterbegin', `
            <div class="chat-message sent">
                <img src="{{ asset('template/assets/images/admin.webp') }}" alt="You" class="chat-avatar">
                <div class="chat-details">
                    <span class="message-author">You</span>
                    ${messageContent}
                    <span class="message-time">${new Date().toLocaleString()}</span>
                </div>
            </div>
            <hr class="message-divider">
        `);

                // Reset the arrays after sending the reply to prevent old files from being sent again
                selectedImages = [];
                selectedFiles = [];

                // Also call discardReply to hide the reply box and clear inputs
                discardReply();
            } else {
                alert('Please enter a message or attach a file before sending.');
            }
        }



        // Additional handling for file inputs (image and general file upload handling)
        document.addEventListener('DOMContentLoaded', function() {
            const MAX_FILES = 10;
            let totalFiles = 0;
            const filePreviewsContainer = document.getElementById('file-previews');

            // Handle image selection
            document.getElementById('addImageBtn').addEventListener('click', function() {
                if (totalFiles >= MAX_FILES) {
                    alert('Maximum 10 images allowed.');
                    return;
                }
                document.getElementById('image-input').click();
            });

            // Handle file selection
            document.getElementById('addFileBtn').addEventListener('click', function() {
                if (totalFiles >= MAX_FILES) {
                    alert('Maximum 10 files allowed.');
                    return;
                }
                document.getElementById('file-input').click();
            });

            // Handle image preview and validation
            document.getElementById('image-input').addEventListener('change', function(event) {
                handleFileSelection(event.target.files, true);
            });

            // Handle file preview and validation
            document.getElementById('file-input').addEventListener('change', function(event) {
                handleFileSelection(event.target.files, false);
            });

            function handleFileSelection(files, isImage) {
                const remainingSlots = MAX_FILES - totalFiles;
                const filesToProcess = Math.min(files.length, remainingSlots);

                if (files.length > remainingSlots) {
                    alert(`Only ${remainingSlots} more file(s) can be added.`);
                }

                for (let i = 0; i < filesToProcess; i++) {
                    const file = files[i];

                    // Check for image type validation
                    if (isImage && !['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                        alert('Only JPEG, PNG, and WEBP images are allowed.');
                        continue;
                    }

                    const fileDiv = document.createElement('div');
                    fileDiv.className = 'file-preview-item mb-2 d-flex align-items-center';

                    if (isImage && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            fileDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="height: 50px; width: 50px; object-fit: cover; margin-right: 10px;">
                        <span class="file-name">${file.name}</span>
                        <button type="button" class="btn btn-sm btn-danger ml-auto remove-file">×</button>
                    `;
                            // Attach remove functionality here after the image is loaded
                            fileDiv.querySelector('.remove-file').addEventListener('click', function() {
                                fileDiv.remove();
                                totalFiles--;
                            });
                        };
                        reader.readAsDataURL(file);
                    } else {
                        fileDiv.innerHTML = `
                    <i class="fas fa-file mr-2"></i>
                    <span class="file-name">${file.name}</span>
                    <button type="button" class="btn btn-sm btn-danger ml-auto remove-file">×</button>
                `;
                        // Attach remove functionality for regular files
                        fileDiv.querySelector('.remove-file').addEventListener('click', function() {
                            fileDiv.remove();
                            totalFiles--;
                        });
                    }

                    filePreviewsContainer.appendChild(fileDiv);
                    totalFiles++;
                }
            }

            // Form submission validation
            document.getElementById('ticketForm').addEventListener('submit', function(event) {
                if (totalFiles > MAX_FILES) {
                    event.preventDefault();
                    alert('Maximum 10 files allowed. Please remove some files.');
                }
            });
        });
    </script>
@endpush
