@extends('layouts.app')
@section('title', 'Helpdesk - Update Ticket')
@section('header', 'Helpdesk')
@section('active-header', 'Edit ticket')

@section('content')
    {{-- <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Submit new Ticket</h5>
                <div class="card-body">
                    <form action="{{ url('portal.helpdesk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="subject" class="col-form-label">Subject</label>
                            <input id="subject" name="subject" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="Recruitment">Recruitment</option>
                                <option value="Training">Training and Development</option>
                                <option value="Compensation">Compensation and Benefits</option>
                                <option value="EmployeeRelations">Employee Relations</option>
                                <option value="OrganizationalDevelopment">Organizational Development</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select class="form-control" id="priority" name="priority" required>
                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                                <option>Urgent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <!-- Recruitment Categories -->
                                <option class="Recruitment" value="Hiring Process">Hiring Process</option>
                                <option class="Recruitment" value="Onboarding">Onboarding</option>
                                <option class="Recruitment" value="NewHire">New Hire Orientation</option>

                                <!-- Training Categories -->
                                <option class="Training" value="Leadership Development">Leadership Development</option>
                                <option class="Training" value="Professional Development">Professional Development</option>
                                <option class="Training" value="Training Request">Training Request</option>

                                <!-- Compensation Categories -->
                                <option class="Compensation" value="Benefits Inquiry">Benefits Inquiry</option>
                                <option class="Compensation" value="Compensation Review">Compensation Review</option>
                                <option class="Compensation" value="Payroll Discrepancy">Payroll Discrepancy</option>

                                <!-- Employee Relations Categories -->
                                <option class="EmployeeRelations" value="Conflict Resolution">Conflict Resolution</option>
                                <option class="EmployeeRelations" value="Employee Complaints">Employee Complaints</option>
                                <option class="EmployeeRelations" value="Workplace Issues">Workplace Issues</option>

                                <!-- Organizational Development Categories -->
                                <option class="OrganizationalDevelopment" value="Organizational Change">Organizational Change</option>
                                <option class="OrganizationalDevelopment" value="Restructuring">Restructuring</option>
                                <option class="OrganizationalDevelopment" value="Cultural Transformation">Cultural Transformation</option>
                            </select>
                        </div>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="file">
                            <label class="custom-file-label" for="customFile">Attach file</label>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0 ml-auto">
                                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                <a href="{{ route('portal.helpdesk.index')}}" class="btn btn-space btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
<script>
    document.getElementById('department').addEventListener('change', function() {
        // Kunin ang napiling department
        var selectedDepartment = this.value;

        // Kunin ang lahat ng options sa category
        var categoryOptions = document.querySelectorAll('#category option');

        // I-loop ang mga options at itago o ipakita batay sa napiling department
        categoryOptions.forEach(function(option) {
            if (option.value === "") {
                option.style.display = "block"; // Palaging ipakita ang "Select Category"
            } else if (option.classList.contains(selectedDepartment)) {
                option.style.display = "block"; // Ipakita ang option kung ito ay kasama sa napiling department
            } else {
                option.style.display = "none"; // Itago ang option kung hindi ito kasama
            }
        });

        // I-reset ang category dropdown kung kinakailangan
        document.getElementById('category').value = ""; // I-reset ang category
    });
</script>
@endpush
                        {{-- End submit response ticket --}}

                        {{-- <!-- Send Ticket to user with admin and HR role -->
                        <label for="reply-box" class="col-form-label">Send Ticket To:</label><button
                        class="btn btn-xs m-b-xs btn-outline btn-link"
                        data-content="Select Admin/HR. You can select also a specific HR user." data-placement="top"
                        data-toggle="popover" tabindex="-1" type="button" data-original-title=""
                        title="">
                        <i class="fa fa-question-circle"></i>
                        </button> --}}


                        {{-- i dont use this anymore but keep this section comment --}}
                        {{-- <div class="input-group mb-3">
                            <!-- Fixed: Always Send to All Admins -->
                            <input type="hidden" name="assigned_to[]" value="admin">

                            <div class="input-group-prepend be-addon">
                                <div class="form-group row pt-0">
                                    <div class="col-md-1">
                                        <select class="selectpicker" multiple data-style="btn-outline-code3">
                                            <option value="admin" selected disabled>Admin</option> <!--disabled means all users who are admin are see this ticket-->
                                            <option value="HR">HR</option> <!--if user select also HR, all user has role hr can see his ticket-->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- HR User Selection, user can send this ticket for specific hr user.-->
                            @if($hrs->isNotEmpty())
                                <select id="hr_users" class="js-example-basic-multiple form-control" multiple="multiple" name="assigned_to[]">
                                    @foreach($hrs as $hr)
                                        <option value="{{ $hr->id }}">{{ $hr->name }} (HR)</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-danger ml-2">No HR users available.</p>
                            @endif
                        </div> --}}


                                            {{-- response section working 100% --}}
                    {{-- <div class="chatbox">
                        @include('components.modal.image-modal')
                        @foreach ($responses as $response)
                            <div class="chatbox-messages">
                                <!-- Example message with image and file attachments -->
                                <div class="chat-message received">
                                    <img src="{{ asset('template/assets/images/user1.png') }}" alt="Admin" class="user-avatar-lg rounded-circle">
                                    {{-- <img src="{{ asset($response->user->avatar) }}" alt="User" class="user-avatar-lg rounded-circle"> --}}
                                    <div class="chat-details">
                                        <span class="message-author">{{ $response->user->name }}</span>
                                        <p class="message-text">{{ $response->response_text }}</p>

                                        <!-- Displaying images inline -->
                                        <div class="message-attachment">
                                            @foreach ($response->files as $file)
                                            @if (in_array($file->file_type, ['image/jpeg', 'image/png', 'image/gif']))
                                                <!-- Displaying images inline -->
                                                <img src="{{ asset('storage/' . $file->file_path) }}" alt="Attached Image" class="message-image modalThisImage">
                                            @else
                                                <!-- For non-image files (e.g., documents) -->
                                                <div class="media media-attachment">
                                                    <div class="avatar bg-primary">
                                                        <i class="far fa-file-image"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ $file->file_name }}</a>
                                                        <span>{{ number_format($file->size / 1024, 2) }} KB</span>
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
                    </div> --}}
                    {{-- end response section  --}}
