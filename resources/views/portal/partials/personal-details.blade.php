<div class="row">
    <div class="col-xl-12 col-lg- col-md-7 col-sm-12 col-12">
        <div class="section-block">
            <div class="card">
                <h5 class="card-header">Personal Information</h5>
                <div class="card-body">
                    <h4>Personal Details</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" value="{{ Auth::user()->personalInformation->first_name ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" value="{{ Auth::user()->personalInformation->last_name ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename">Middle name</label>
                            <input type="text" class="form-control" id="middlename" value="{{ Auth::user()->personalInformation->middle_name ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dateofbirth">Date of Birth</label>
                            <input type="text" class="form-control" id="dateofbirth" value="{{ Auth::user()->personalInformation->date_of_birth->format('F d, Y') ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="gender">Gender</label>
                            <input type="text" class="form-control" id="gender" value="{{ Auth::user()->personalInformation->gender ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="maritalstatus">Marital Status</label>
                            <input type="text" class="form-control" id="maritalstatus" value="{{ Auth::user()->personalInformation->marital_status ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="bloodtype">Blood Type</label>
                            <input type="text" class="form-control" id="bloodtype" value="{{ Auth::user()->personalInformation->blood_group ?? 'N/A' }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Personal Contact Information</h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="phonenumber">Phone Number</label>
                            <input type="text" class="form-control" id="phonenumber" value="{{ Auth::user()->personalInformation->phone_number ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" value="{{ Auth::user()->personalInformation->address ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" value="{{ Auth::user()->personalInformation->state ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" value="{{ Auth::user()->personalInformation->city ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" value="{{ Auth::user()->personalInformation->country ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="postalcode">Postal Code</label>
                            <input type="text" class="form-control" id="postalcode" value="{{ Auth::user()->personalInformation->postal_code ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nationality">Nationality</label>
                            <input type="text" class="form-control" id="nationality" value="{{ Auth::user()->personalInformation->nationality ?? 'N/A' }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Emergency Contact Information</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="contactnumber">Contact Number</label>
                            <input type="text" class="form-control" id="contactnumber" value="{{ Auth::user()->personalInformation->emergency_contact_number ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="contactname">Contact name</label>
                            <input type="text" class="form-control" id="contactname" value="{{ Auth::user()->personalInformation->emergency_contact_name ?? 'N/A' }}" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="relationship">Relationship</label>
                            <input type="text" class="form-control" id="relationship" value="{{ Auth::user()->personalInformation->emergency_relationship ?? 'N/A' }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
