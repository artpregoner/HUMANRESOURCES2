@extends('layouts.portal')
@section('title', 'Claims')
@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('portal.claims.index')">Claims</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('portal.claims.index')">Expenses show</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('portal.claims.index')">ID: #{{ $claim->id }}</flux:breadcrumbs.item>
@endsection

@push('styles')

@endpush

@section('content')
    @include('components.alert.alert')
    <div class="max-w-4xl mx-auto">
        <div class="relative w-full overflow-x-auto">
            <!-- Main Card -->
            <div class="mb-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <!-- Card Header -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Expense Claim</h3>
                        <p class="text-gray-500 dark:text-gray-400">Claims # {{ $claim->id }}</p>
                    </div>
                    <div class="text-right">
                        <h3 class="mb-1">
                            {{-- <span class="inline-flex px-2 py-1 text-sm font-medium rounded-full {{ $statusBadge }}">
                                {{ ucfirst($claim->status) }}
                            </span> --}}
                            <flux:badge variant="solid" color="{{ $claim->status == 'submitted' ? 'zinc' :  ($claim->status == 'unapproved' ? 'yellow' : ($claim->status == 'approved' ? 'green' : ($claim->status == 'rejected' ? 'red' : 'pink'))) }}">
                                {{ ucfirst(str_replace('_', ' ', $claim->status)) }}
                            </flux:badge>
                        </h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $actionedBy }}</span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-5">
                    <!-- User Information -->
                    <div class="flex flex-wrap mb-6">
                        <div class="w-full mb-4 md:w-1/2 md:mb-0">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ $claim->user->profile_photo_path ? Storage::url($claim->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                                         class="w-12 h-12 rounded-full" alt="User Avatar">
                                </div>
                                <div class="ml-3">
                                    <h5 class="text-lg font-medium text-gray-900 dark:text-white">{{ $claim->user->name }}</h5>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $claim->user->email }}</span>
                                    @if($claim->assigned_to_id)
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Assigned to: {{ $claim->assignedTo->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-right md:w-1/2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Submitted by: {{ $claim->submittedBy->name }}</p>
                        </div>
                    </div>

                    <!-- Currency Selector -->
                    <div class="mb-4">
                        <label for="currencySelector" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Currency
                        </label>
                        <select id="currencySelector" disabled
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option>{{ $claim->currency }}</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="inputDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input value="{{ $claim->description }}" id="inputDescription" type="text" disabled
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- Comments -->
                    <div class="mb-4">
                        <label for="inputComments" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comments</label>
                        <textarea id="inputComments" rows="4" disabled
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $claim->comments}}</textarea>
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
                        <div>
                            <label for="expenseDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expense Date</label>
                            <input value="{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}" type="text" id="expenseDate" disabled
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="submittedDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Submitted Date</label>
                            <input value="{{ Carbon\Carbon::parse($claim->submitted_date)->format('M d, Y - h:i A') }}" type="text" id="submittedDate" disabled
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="approvedDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approved Date</label>
                            <input value="{{ $claim->approved_date ? Carbon\Carbon::parse($claim->approved_date)->format('M d, Y') : 'N/A' }}" type="text" id="approvedDate" disabled
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>

                    <!-- Expenses Table -->
                    <div class="relative mb-6 overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                              <th scope="col" class="px-6 py-3">Category</th>
                              <th scope="col" class="px-6 py-3">Details</th>
                              <th scope="col" class="px-6 py-3 text-right">Amount ({{ $claim->currency }})</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($claim->items as $item)
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $item->category->name }}</td>
                                <td class="px-6 py-4">{{ $item->details }}</td>
                                <td class="px-6 py-4 text-right">{{ number_format($item->amount, 2) }}</td>
                              </tr>
                            @endforeach
                            <tr class="font-semibold text-gray-800 bg-gray-50 dark:bg-gray-700 dark:text-white">
                              <th scope="row" colspan="2" class="px-6 py-3 text-right">Total:</th>
                              <td class="px-6 py-3 text-right">{{ number_format($claim->total_amount, 2) }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                </div>

                <!-- Reimbursement Section -->
                {{-- @if($claim->reimbursement_required)
                <div class="p-5 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <input id="reimbursement-checkbox" type="checkbox" checked disabled
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                        <label for="reimbursement-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">
                            Reimbursement is required for this expense claim
                        </label>
                    </div>
                </div>
                @endif --}}

                <!-- Attachments Section -->
                <div class="p-5 border-t border-gray-200 dark:border-gray-700">
                    <h5 class="mb-4 text-base font-semibold text-gray-900 dark:text-white">Attachments</h5>
                    <div class="space-y-3">
                        @forelse($claim->attachments as $attachment)
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full dark:bg-blue-900">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.5 17H4a3 3 0 0 1-3-3V8.5a3 3 0 0 1 3-3h.5V4c0-1.1.9-2 2-2h7a2 2 0 0 1 2 2v1.5h.5a3 3 0 0 1 3 3V14a3 3 0 0 1-3 3h-.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4.5 18.5V17Z"/>
                                    <path d="M9 6a1 1 0 1 1 2 0v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6Z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <a href="{{ Storage::url($attachment->file_path) }}" target="_blank"
                                    class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">

                                    <span class="sm:hidden">{{ Str::limit($attachment->file_name, 30, '...') }}</span> <!-- Shorten for mobile -->
                                    <span class="hidden sm:inline">{{ $attachment->file_name }}</span> <!-- Full name for larger screens -->

                                </a>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ number_format($attachment->file_size / 1048576, 2) }} MB
                                    <span class="ml-2">{{ $attachment->file_type }}</span>
                                </p>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">No attachments found</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Payroll Status Card -->
            <div class="mb-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="p-5">
                    <h5 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Payroll Status</h5>
                    <div class="grid gap-1 text-sm text-gray-700 dark:text-gray-300">
                        <div>Status: <span class="font-medium">Processing</span></div>
                        <div>Paid At: <span class="font-medium">June 3 2025</span></div>
                        <div>Actioned by: <span class="font-medium">hr manager</span></div>
                        <div>Remarks: <span class="font-medium">ok na to!</span></div>
                    </div>
                </div>
            </div>

            <!-- Footer Card -->
            <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="flex flex-wrap justify-center gap-3 p-5 border-t border-gray-200 dark:border-gray-700 sm:flex-row sm:justify-between">
                    <div>
                        <a href="{{ route('claims.download-pdf', $claim->id) }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0 0-1.414Z"/>
                                <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('portal.claims.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Back to Lists
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
@endpush
