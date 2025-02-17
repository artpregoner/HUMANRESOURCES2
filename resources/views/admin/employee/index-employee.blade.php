@extends('layouts.app')
@section('title', 'Employee List')
@section('header', 'Employee')
@section('active-header', 'Employee lists')

@push('styles')
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
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle  card-drop" data-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- item-->
                                                <a href="{{ route('admin.show.employee', $employeeRequest->id) }}" class="dropdown-item">Show</a>
                                                <!-- item-->
                                            </div>
                                        </div>
                                    </td>
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
