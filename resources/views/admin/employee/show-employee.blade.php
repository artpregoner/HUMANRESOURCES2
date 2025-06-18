@extends('layouts.app')

@section('title', 'Employee Details')
@section('header', 'Employee')
@section('active-header', 'Employee Details')

@push('styles')
@endpush

@section('content')
    @include('components.alert.alert')

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800">Show Employee</h4>
        <div class="ml-auto">
            <a href="{{ route('admin.index.employee') }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Employee List</a>
        </div>
    </div>

    <div class="border-t border-gray-200 mb-6"></div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Profile Card Section -->
        <div class="col-span-12 xl:col-span-3 lg:col-span-3 md:col-span-5">
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Avatar Section -->
                <div class="p-6">
                    <div class="text-center">
                        <img src="{{ asset('template/assets/images/avatar-1.jpg')}}" alt="User Avatar" class="w-24 h-24 rounded-full mx-auto object-cover">
                    </div>
                    <div class="text-center mt-4">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $employeeRequest->first_name ?? 'Not Assigned' }} {{ $employeeRequest->last_name ?? 'Not Assigned' }}</h2>
                    </div>
                </div>

                <!-- Department & Position Section -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <h3 class="text-base font-medium text-gray-900 mb-3">Department & Desired Position</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-building w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->department ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-male w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->role ?? 'Not Assigned' }}
                        </li>
                    </ul>
                </div>

                <!-- Contact Information Section -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <h3 class="text-base font-medium text-gray-900 mb-3">Contact Information</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-envelope w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->email ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-phone w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->phone ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-address-card w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->address ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-link w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->social_media ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-birthday-cake w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->birthdate ?? 'Not Assigned' }}
                        </li>
                    </ul>
                </div>

                <!-- Emergency Contact Section -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <h3 class="text-base font-medium text-gray-900 mb-3">Emergency Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-user w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->emergency_name ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-phone w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->emergency_phone ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-address-card w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->emergency_address ?? 'Not Assigned' }}
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-users w-4 h-4 mr-3 text-gray-400"></i>
                            {{ $employeeRequest->emergency_relationship ?? 'Not Assigned' }}
                        </li>
                    </ul>
                </div>

                <!-- Category Section -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <h3 class="text-base font-medium text-gray-900 mb-3">Category</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded">{{ $employeeRequest->gender ?? 'Not Assigned' }}</span>
                        <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded">{{ $employeeRequest->civil_status ?? 'Not Assigned' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create User Form Section -->
        <div class="col-span-12 xl:col-span-9 lg:col-span-9 md:col-span-7">
            @if ($userExists)
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-md mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">This employee is already registered as a user, you can update their user role.</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Create User from Employee Data</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.create.user') }}" class="space-y-6">
                        @csrf

                        <!-- Role Field -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                            <select name="role" id="role" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="employee" {{ old('role', $employeeRequest->role) == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="hr" {{ old('role', $employeeRequest->role) == 'hr' ? 'selected' : '' }}>HR</option>
                                <option value="admin" {{ old('role', $employeeRequest->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <!-- Display Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Display Name</label>
                            <input type="text" name="name" id="name" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter name" value="{{ old('name', $employeeRequest->first_name . ' ' . $employeeRequest->last_name) }}">
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter email" value="{{ old('email', $employeeRequest->email) }}">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-start">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
