@extends('layouts.app')
@section('title', 'Employee List')
@section('header', 'Employee')
@section('active-header', 'Employee lists')

@push('styles')
<style>
    th, td {
        white-space: nowrap; /* Prevent text wrapping for better spacing */
        text-align: center; /* Center align text */
    }
</style>
@endpush

@section('content')
    @include('components.alert.alert')
    <div class="row">
        <!-- ============================================================== -->
        <!-- campaign activities   -->
        <!-- ============================================================== -->
        <div class="col-lg-12">
            <div class="section-block">
                <div class="card-header d-flex">
                    <h4 class="card-header-title">Employee List</h4>
                    <div class="toolbar ml-auto">
                        <a href="{{ route('admin.create.employee') }}" class="btn btn-primary btn-sm ">Add new Employee</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="campaign-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="border-0">
                                <th class="border-0">Employee Name</th>
                                <th class="border-0">Email</th>
                                <th class="border-0">Phone number</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($EmployeeList as $employeeRequest)
                                <tr>
                                    <td>{{ $employeeRequest->first_name ?? 'Unknown First Name' }} {{ $employeeRequest->last_name ?? 'Unknown Last Name' }}</td>
                                    <td>{{ $employeeRequest->email }}</td> <!-- Assuming you want the email here -->
                                    <td>{{ $employeeRequest->phone }}</td> <!-- Assuming you want the phone number here -->
                                    <td>
                                        @php
                                            $user = $employeeRequest->user; // Fetch the related user
                                        @endphp

                                        @if ($user)
                                            @if ($user->role == 'hr')
                                                <span class="badge text-success">HR Staff</span>
                                            @elseif ($user->role == 'admin')
                                                <span class="badge text-success">Admin</span>
                                            @elseif ($user->role == 'employee')
                                                <span class="badge text-success">Registered Employee</span>
                                            @endif
                                        @else
                                            <span class="badge text-danger">Unregistered</span> <!-- Default role when no user exists -->
                                        @endif
                                    </td>
                                    <td><a href="{{ route('admin.show.employee', $employeeRequest->id) }}" class="btn btn-code3">Show</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end campaign activities   -->
        <!-- ============================================================== -->
    </div>
@endsection

@push('scripts')
@endpush
