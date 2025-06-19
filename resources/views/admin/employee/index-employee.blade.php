@extends('layouts.app')
@section('title', 'Employee List')
@section('header', 'Employee')
@section('active-header', 'Employee lists')

@push('styles')
{{-- No custom styles needed here for this conversion, Tailwind handles most of it. --}}
{{-- If you have specific complex styles not easily covered by Tailwind, you might still need a <style> block. --}}
@endpush

@section('content')
    {{-- Assuming 'components.alert.alert' renders a standard alert, you might want to convert its content to Flowbite alerts too.
         For example, a basic Flowbite success alert:
         <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-zinc-800 dark:text-green-400" role="alert">
             <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                 <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
             </svg>
             <span class="sr-only">Info</span>
             <div class="text-sm font-medium ms-3">
                 A simple success alert!
             </div>
             <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-zinc-800 dark:text-green-400 dark:hover:bg-zinc-700" data-dismiss-target="#alert-success" aria-label="Close">
                 <span class="sr-only">Close</span>
                 <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                 </svg>
             </button>
         </div>
    --}}
    @include('components.alert.alert')

    <div class="flex flex-wrap -mx-4"> {{-- Equivalent to 'row' with negative margins for column padding --}}
        <div class="w-full px-4 lg:w-full"> {{-- Equivalent to 'col-lg-12' --}}
            <div class="mb-6"> {{-- Used to be section-block, adding some bottom margin --}}
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-zinc-800 sm:rounded-lg">
                    <div class="flex flex-col items-center justify-between p-4 space-y-3 border-b md:flex-row md:space-y-0 md:space-x-4 border-zinc-200 bg-zinc-50 dark:bg-zinc-700 dark:border-zinc-600">{{-- card-header d-flex --}}
                        <h4 class="text-lg font-semibold text-zinc-900 dark:text-white">Employee List</h4> {{-- card-header-title --}}
                        <div class="ml-auto"> {{-- toolbar ml-auto --}}
                            <a href="{{ route('admin.create.employee') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> {{-- btn btn-primary btn-sm Flowbite button --}}
                                Add new Employee
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto"> {{-- campaign-table table-responsive --}}
                        <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400"> {{-- Flowbite table --}}
                            <thead class="text-xs uppercase text-zinc-700 bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Employee Name</th> {{-- border-0, centered, nowrap --}}
                                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Email</th>
                                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Phone number</th>
                                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($EmployeeList as $employeeRequest)
                                    <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600">
                                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $employeeRequest->first_name ?? 'Unknown First Name' }} {{ $employeeRequest->last_name ?? 'Unknown Last Name' }}</td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $employeeRequest->email }}</td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $employeeRequest->phone }}</td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @php
                                                $user = $employeeRequest->user;
                                            @endphp

                                            @if ($user)
                                                @if ($user->role == 'hr')
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">HR Staff</span>
                                                @elseif ($user->role == 'admin')
                                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">Admin</span>
                                                @elseif ($user->role == 'employee')
                                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Registered Employee</span>
                                                @endif
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Unregistered</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <a href="{{ route('admin.show.employee', $employeeRequest->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Show</a> {{-- Simple text link as btn-code3 is not defined --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- If you're using Flowbite's JS components (e.g., for modals, dropdowns), ensure you've included Flowbite's JS. --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> --}}
@endpush
