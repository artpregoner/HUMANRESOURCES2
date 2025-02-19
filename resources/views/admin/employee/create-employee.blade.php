@extends('layouts.app')
@section('title', 'Employee')
@section('header', 'Employee')
@section('active-header', 'Create Employee')

@push('styles')
@endpush

@section('content')
@include('components.alert.alert')
<div class="row">
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">Create Employee</h4>
                <div class="toolbar ml-auto">
                    <a href="{{ route('admin.index.employee')}}" class="btn btn-primary btn-sm ">Employee List</a>
                </div>
            </div>
            <div class="card-body">
                <form id="employeeForm" action="{{ route('admin.create.employee.store') }}" method="POST" data-parsley-validate>
                    @csrf
                    <!-- Employee Information -->
                    <div class="card-body">
                        <h3>Employee Information</h3>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="phone" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" name="birthdate" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" required class="form-control form-control-lg">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Civil Status</label>
                            <select name="civil_status" required class="form-control form-control-lg">
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                                <option value="separated">Separated</option>
                                <option value="engaged">Engaged</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" required class="form-control form-control-lg"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Social Media</label>
                            <input type="text" name="social_media" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <select name="department" required class="form-control form-control-lg">
                                <option value="admin">Admin</option>
                                <option value="hr1">HR1</option>
                                <option value="hr2">HR2</option>
                                <option value="hr3">HR3</option>
                                <option value="finance">Finance</option>
                                <option value="logistic1">Logistic 1</option>
                                <option value="logistic2">Logistic 2</option>
                                <option value="core1">Core1</option>
                                <option value="core2">Core2</option>
                                <option value="core3">Core3</option>
                            </select>
                        </div>
                        {{-- if department request users, it should be required to put his user_type/role in their website/system --}}
                        <div class="form-group">
                            <label>User role | Applied For?</label>
                            <input type="text" name="role" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <!-- Emergency Contact -->
                    <div class="card-body border-top">
                        <h3>Emergency Contact</h3>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="emergency_name" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="emergency_address" required class="form-control form-control-lg"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="emergency_phone" required class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label>Relationship</label>
                            <input type="text" name="emergency_relationship" required class="form-control form-control-lg">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-code3">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
