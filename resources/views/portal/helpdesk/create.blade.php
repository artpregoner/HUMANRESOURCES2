@extends('layouts.app')
@section('title','Helpdesk - Create Ticket')
@section('header','Helpdesk')
@section('active-header', 'Submit new Ticket')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/bootstrap-select/css/bootstrap-select.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Submit new Ticket</h5>
                <div class="card-body">
                    <form action="{{ url('helpdesk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="subject" class="col-form-label">Subject</label>
                            <input id="subject" name="subject" type="text" class="form-control" required>
                        </div>
                        <div class="reply-box">
                            <div class="reply-tools">
                                <button class="btn btn-sm btn-light mr-2" onclick="document.getElementById('image-input').click();">
                                    <i class="fas fa-image"></i> Add Image
                                </button>
                                <button class="btn btn-sm btn-light mr-2" onclick="document.getElementById('file-input').click();">
                                    <i class="fas fa-paperclip"></i> Add File
                                </button>
                            </div>
                            <div class="reply-input-container">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Type your reply here..." id="response" name="response" rows="3" required></textarea>
                                </div>
                                <!-- Image input and preview area -->
                                <input type="file" id="image-input" style="display: none;" accept="image/*" onchange="previewImage(event)">
                                <div id="image-preview" style="display: none; margin-top: 10px;">
                                    <img id="preview" src="" alt="Image Preview" style="max-width: 100%; height: 100px;">
                                </div>
                                <!-- File input and file name display -->
                                <input type="file" id="file-input" style="display: none;" onchange="displayFileName(event)">
                                <div id="file-name" style="display: none; margin-top: 10px;">
                                    <p>Selected file: <span id="file-display"></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputTicketTo">Send Ticket To</label>
                            <div class="form-group row pt-0">
                                <div class="col-md-11">
                                    <select class="selectpicker" multiple data-style="btn-outline-code3">
                                        <option value="admin" selected>Admin</option>
                                        <option value="HR">HR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0 ml-auto">
                                <button type="submit" class="btn btn-space btn-code3">Submit</button>
                                <a href="{{ route('portal.helpdesk.index')}}" class="btn btn-space btn-light">Cancel</a>
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
        // Function to preview the selected image
function previewImage(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        alert('Please select a valid image file.');
    }
}

// Function to display the selected file name
function displayFileName(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('file-display').textContent = file.name;
        document.getElementById('file-name').style.display = 'block';
    }
}

    </script>
@endpush
