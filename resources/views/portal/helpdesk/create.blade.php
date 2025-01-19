@extends('layouts.app')
@section('title', 'Helpdesk - Create Ticket')
@section('header', 'Helpdesk')
@section('active-header', 'Submit new Ticket')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Submit new Ticket</h5>
                <div class="card-body">
                    <form action="{{ url('helpdesk.store') }}" method="POST" enctype="multipart/form-data" id="ticketForm">
                        @csrf
                        <!-- SUBJECT for Helpdesk  -->
                        <div class="form-group">
                            <label for="subject" class="col-form-label">Subject</label>
                            <input id="subject" name="subject" type="text" class="form-control" required>
                        </div>
                        <!-- Category dropdown for Ticket -->
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="ticketCategory" class="d-none d-md-block">Category</label>
                                <select class="custom-select d-block w-100" name="ticket[0][category]" required>
                                    <option value="">Choose...</option>
                                    <option value="Fuel">Account</option>
                                    <option value="Medical">Information</option>
                                    <option value="Fare">Others...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid Category.
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Response-->
                        <div class="form-group">
                            <label for="reply-box" class="col-form-label">Response</label>
                            <div class="reply-box">
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
                                    <input type="file" id="image-input" style="display: none;" accept="image/jpeg, image/png, image/webp" multiple>
                                    <input type="file" id="file-input" style="display: none;" multiple>
                                    <!-- File preview container -->
                                    <div id="file-previews" class="mt-3"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Send Ticket to -->
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="inputTicketTo">Send Ticket To</label>
                                <div class="form-group row pt-0">
                                    <div class="col-md-1">
                                        <select class="selectpicker" multiple data-style="btn-outline-code3">
                                            <option value="admin" selected>Admin</option>
                                            <option value="HR">HR</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0 ml-auto">
                                <button type="submit" class="btn btn-space btn-code3">Submit</button>
                                <a href="{{ route('portal.helpdesk.index') }}" class="btn btn-space btn-light">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('template/assets/vendor/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script>
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
