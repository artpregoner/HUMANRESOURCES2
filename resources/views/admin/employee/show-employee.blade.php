@extends('layouts.app')
@section('title', 'Employee Details')
@section('header', 'Employee')
@section('active-header', 'Employee Details')

@push('styles')
@endpush

@section('content')
    @include('components.alert.alert')
    <div class="card-header d-flex">
        <h4 class="card-header-title">Show Employee</h4>
        <div class="toolbar ml-auto">
            <a href="{{ route('admin.index.employee') }}" class="btn btn-primary btn-sm ">Employee List</a>
        </div>
    </div>
    <div class="card-body border-top"></div>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- card profile -->
            <!-- ============================================================== -->
            <div class="card">
                <div class="card-body">
                    <div class="user-avatar text-center d-block">
                        <img src="{{ asset('template/assets/images/avatar-1.jpg')}}" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                    </div>
                    <div class="text-center">
                        <!-- Display the employee's first and last name -->
                        <h2 class="font-24 mb-0">{{ $employeeRequest->first_name ?? 'Not Assigned' }} {{ $employeeRequest->last_name ?? 'Not Assigned' }}</h2>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Department & Desired Position</h3>
                    <div class="">
                        <ul class="mb-0 list-unstyled">
                            <li class="mb-2"><i class="fas fa-building mr-2"></i>{{ $employeeRequest->department ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-male mr-2"></i>{{ $employeeRequest->role ?? 'Not Assigned' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Contact Information</h3>
                    <div class="">
                        <ul class="list-unstyled mb-0">
                            <!-- Display employee email and phone number -->
                            <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>{{ $employeeRequest->email ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>{{ $employeeRequest->phone ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-address-card mr-2"></i>{{ $employeeRequest->address ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-link mr-2"></i>{{ $employeeRequest->social_media ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-birthday-cake mr-2"></i>{{ $employeeRequest->birthdate ?? 'Not Assigned' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Emergency Contact</h3>
                    <div class="">
                        <ul class="mb-0 list-unstyled">
                            <li class="mb-2"><i class="fas fa-fw fa-user mr-2"></i>{{ $employeeRequest->emergency_name ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>{{ $employeeRequest->emergency_phone ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-address-card mr-2"></i>{{ $employeeRequest->emergency_address ?? 'Not Assigned' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-users mr-2"></i>{{ $employeeRequest->emergency_relationship ?? 'Not Assigned' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Category</h3>
                    <div>
                        <a href="#" class="badge badge-light mr-1">{{ $employeeRequest->gender ?? 'Not Assigned' }}</a>
                        <a href="#" class="badge badge-light mr-1">{{ $employeeRequest->civil_status ?? 'Not Assigned' }}</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end card profile -->
            <!-- ============================================================== -->
        </div>

        <!-- ============================================================== -->
        <!-- Create User Form -->
        <!-- ============================================================== -->
        <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
                @if ($userExists)
                <div class="alert alert-warning">
                    This employee is already registered as a users, you can update his user role.
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex">
                    <h3>Create User from Employee Data</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.create.user') }}">
                        @csrf
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="employee" {{ old('role', $employeeRequest->role) == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="hr" {{ old('role', $employeeRequest->role) == 'hr' ? 'selected' : '' }}>HR</option>
                                <option value="admin" {{ old('role', $employeeRequest->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Display Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ old('name', $employeeRequest->first_name . ' ' . $employeeRequest->last_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email', $employeeRequest->email) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Create User</button>
                        {{-- @if (!$userExists)
                            <a href="{{ route('admin.create.user', ['employeeId' => $employeeRequest->id]) }}" class="btn btn-success">
                                Create User
                            </a>
                        @endif --}}
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
    </div>
@endsection

@push('scripts')
@endpush
