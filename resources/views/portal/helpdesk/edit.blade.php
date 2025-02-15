@extends('layouts.portal')
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
