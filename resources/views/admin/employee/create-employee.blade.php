@extends('layouts.app')
@section('title', 'Employee')
@section('header', 'Employee')
@section('active-header', 'Create Employee')

@push('styles')
@endpush

@section('content')
@include('components.alert.alert')

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xl:col-start-3 xl:col-span-8 lg:col-span-12">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <!-- Card Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                <h4 class="text-xl font-semibold text-gray-800">Create Employee</h4>
                <div class="ml-auto">
                    <a href="{{ route('admin.index.employee')}}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Employee List</a>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <form id="employeeForm" action="{{ route('admin.create.employee.store') }}" method="POST" data-parsley-validate class="space-y-8">
                    @csrf

                    <!-- Employee Information Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Employee Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="first_name" id="first_name" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="last_name" id="last_name" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="number" name="phone" id="phone" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Birthdate -->
                            <div>
                                <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-2">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                <select name="gender" id="gender" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <!-- Civil Status -->
                            <div>
                                <label for="civil_status" class="block text-sm font-medium text-gray-700 mb-2">Civil Status</label>
                                <select name="civil_status" id="civil_status" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="separated">Separated</option>
                                    <option value="engaged">Engaged</option>
                                </select>
                            </div>
                        </div>

                        <!-- Full Width Fields -->
                        <div class="grid grid-cols-1 gap-6 mt-6">
                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <textarea name="address" id="address" required rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base"></textarea>
                            </div>

                            <!-- Social Media -->
                            <div>
                                <label for="social_media" class="block text-sm font-medium text-gray-700 mb-2">Social Media</label>
                                <input type="text" name="social_media" id="social_media" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Department -->
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                <select name="department" id="department" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
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

                            <!-- User Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">User role | Applied For?</label>
                                <input type="text" name="role" id="role" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact Section -->
                    <div class="border-t border-gray-200 pt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Emergency Contact</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Emergency Contact Name -->
                            <div>
                                <label for="emergency_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="emergency_name" id="emergency_name" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Emergency Phone -->
                            <div>
                                <label for="emergency_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="emergency_phone" id="emergency_phone" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>

                            <!-- Emergency Relationship -->
                            <div>
                                <label for="emergency_relationship" class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                                <input type="text" name="emergency_relationship" id="emergency_relationship" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base">
                            </div>
                        </div>

                        <!-- Emergency Address (Full Width) -->
                        <div class="mt-6">
                            <label for="emergency_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea name="emergency_address" id="emergency_address" required rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-base"></textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 mt-8">
                            <button type="reset" class="px-6 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">Cancel</button>
                            <button type="submit" class="px-6 py-2 bg-gray-700 text-white font-medium rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Submit</button>
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
