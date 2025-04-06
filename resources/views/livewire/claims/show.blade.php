<!-- Main Container -->
<div class="max-w-4xl mx-auto">
    <!-- Expense Claim Card -->
    <div class="max-w-4xl mx-auto mb-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
      <!-- Card Header -->
      <div class="flex flex-col p-4 border-b md:flex-row md:justify-between md:items-center dark:border-gray-700">
        <div>
          <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Expense Claim</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Claims #{{ $claim->id }}</p>
        </div>
        <div class="mt-3 md:mt-0">
          <h3 class="mb-1 text-lg font-medium">
            @if ($status == 'approved')
              <span class="px-3 py-1 text-sm text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">Approved</span>
            @elseif ($status == 'pending')
              <span class="px-3 py-1 text-sm text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">Pending</span>
            @elseif ($status == 'submitted')
              <span class="px-3 py-1 text-sm text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Submitted</span>
            @elseif ($status == 'unapproved')
              <span class="px-3 py-1 text-sm text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Unapproved</span>
            @elseif ($status == 'rejected')
              <span class="px-3 py-1 text-sm text-red-800 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-300">Rejected</span>
            @endif
          </h3>

          @if ($status === 'approved' && $approverName)
            <p class="text-sm text-gray-600 dark:text-gray-400">
              Approved by: <span class="font-semibold text-gray-800 dark:text-white">{{ $approverName }}</span>
            </p>
          @elseif ($status === 'rejected' && $rejectedBy)
            <p class="text-sm text-gray-600 dark:text-gray-400">
              Rejected by: <span class="font-semibold text-gray-800 dark:text-white">{{ $rejectedBy }}</span>
            </p>
          @elseif ($status === 'unapproved' && $unapprovedBy)
            <p class="text-sm text-gray-600 dark:text-gray-400">
              Unapproved by: <span class="font-semibold text-gray-800 dark:text-white">{{ $unapprovedBy }}</span>
            </p>
          @endif
        </div>
      </div>

      <!-- Card Body -->
      <div class="p-4 md:p-6">
        <!-- User Information -->
        <div class="flex flex-col justify-between mb-6 md:flex-row md:items-center">
          <div class="flex items-center mb-4 md:mb-0">
            <img src="{{ $claim->user->profile_photo_path ? Storage::url($claim->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                 alt="User Avatar"
                 class="w-12 h-12 mr-4 rounded-full">
            <div>
              <h5 class="text-lg font-medium text-gray-800 dark:text-white">{{ $claim->user->name ?? 'N/A' }}</h5>
              <p class="text-sm text-gray-600 dark:text-gray-400">{{ $claim->user->email ?? 'N/A' }}</p>
              @if($claim->assigned_to_id)
                <p class="text-xs text-gray-500 dark:text-gray-500">Assigned to: {{ $claim->assignedTo->name ?? 'N/A' }}</p>
              @endif
            </div>
          </div>
          <div class="text-sm text-gray-500 dark:text-gray-400">
            Submitted by: {{ $claim->submittedBy->name ?? 'N/A' }}
          </div>
        </div>

        <!-- Currency Selector -->
        <div class="mb-6">
          <label for="currencySelector" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Currency
          </label>
          <select id="currencySelector" disabled
                  class="w-full max-w-xs bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option>{{ $claim->currency }}</option>
          </select>
        </div>

        <!-- Description -->
        <div class="mb-6">
          <label for="inputDescription" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
          <input value="{{ $claim->description }}" id="inputDescription" type="text"
                 class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                 disabled>
        </div>

        <!-- Comments -->
        <div class="mb-6">
          <label for="inputComments" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Comments</label>
          <textarea id="inputComments" rows="4" disabled
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $claim->comments }}</textarea>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
          <div>
            <label for="expenseDate" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Expense Date</label>
            <input value="{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}" type="text" id="expenseDate"
                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   disabled>
          </div>
          <div>
            <label for="submittedDate" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Submitted Date</label>
            <input value="{{ Carbon\Carbon::parse($claim->submitted_date)->format('M d, Y - h:i A') }}" type="text" id="submittedDate"
                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   disabled>
          </div>
          <div>
            <label for="approvedDate" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Approved Date</label>
            <input value="{{ $claim->approved_date ? Carbon\Carbon::parse($claim->approved_date)->format('M d, Y') : 'N/A' }}" type="text" id="approvedDate"
                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   disabled>
          </div>
        </div>

        <!-- Expense Items Table -->
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

    <!-- Action Buttons Card -->
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
      <div class="p-4 md:p-6">
        <div class="flex flex-col justify-between space-y-4 md:flex-row md:space-y-0">
          <div>
            @if (!$isOwner) {{-- Only show if the logged-in user is NOT the owner --}}
              @if($status !== 'rejected')
                <button wire:click="approve"
                        class="{{ $status === 'approved' ? 'text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-300' : 'text-white bg-green-700 hover:bg-green-800 focus:ring-green-300' }} focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 mb-3 dark:focus:ring-green-800">
                  {{ $status === 'approved' ? 'Unapprove' : 'Approve' }}
                </button>
              @endif
              @if($status !== 'approved')
                <button wire:click="reject"
                        class="{{ $status === 'rejected' ? 'text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-300' : 'text-white bg-red-700 hover:bg-red-800 focus:ring-red-300' }} focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-3 dark:focus:ring-red-900">
                  {{ $status === 'rejected' ? 'Unreject' : 'Reject' }}
                </button>
              @endif
            @endif
          </div>
          @php
            $role = Auth::user()->role;
            $redirectRoute = match ($role) {
              'admin' => 'admin.claims.index',
              'hr' => 'hr2.claims.index',
              default => null,
            };
          @endphp
          @if ($redirectRoute)
            <div>
              <a href="{{ route($redirectRoute) }}"
                 class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Cancel
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
