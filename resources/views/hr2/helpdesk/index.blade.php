@extends('layouts.app')
@section('title', 'Helpdesk - Tickets')

@section('breadcrumbs')
    <flux:breadcrumbs.item href="#">Helpdesk</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="">Ticket List</flux:breadcrumbs.item>
@endsection

@push('styles')

@endpush

@section('content')
    @include('components.alert.alert')
    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="flex flex-wrap items-center justify-between pb-4 space-y-4 flex-column sm:flex-row sm:space-y-0">
            <div>
                <form method="GET" class="inline-flex items-center">
                    <label for="per_page" class="mr-2 text-sm text-gray-700 dark:text-gray-300">Show</label>
                    <select name="per_page" id="per_page" class="bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        onchange="this.form.submit()">
                        @foreach ([10, 15, 25, 50, 100] as $size)
                            <option value="{{ $size }}" {{ request('per_page') == $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">entries</span>
                </form>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <form method="GET" class="flex items-center">
                    <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none rtl:inset-r-0 rtl:right-0 ps-3">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search tickets..." class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items" />

                    <button type="submit" class="px-3 py-2 ml-2 text-white bg-blue-600 rounded-md">Search</button>

                    <a href="{{ route('hr2.helpdesk.index') }}" class="ml-2 text-red-500 btn">Reset</a>
                </form>
            </div>
        </div>

        <table class="w-full overflow-hidden text-sm text-left text-gray-500 bg-white rounded-lg shadow-lg rtl:text-right dark:text-gray-400">
            <caption class="p-4 text-lg font-semibold text-left text-gray-900 bg-gray-100 rtl:text-right dark:text-white dark:bg-gray-800">
                <div class="flex flex-wrap items-center justify-between gap-4 sm:flex-nowrap">
                    <div class="flex items-center gap-2">
                        <flux:badge color="lime">{{ $filteredTicketCount }}</flux:badge>
                        <span>Filtered Ticket Requests</span>
                    </div>
                    <div class="relative">
                        <span>Total:<flux:badge color="blue">{{ $totalTicketCount }}</flux:badge>tickets</span>
                    </div>
                </div>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Subject
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Updated at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $tickets as $ticket )
                    <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center gap-4">
                                <flux:avatar src="{{ $ticket->user->profile_photo_path ? Storage::url($ticket->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}" />
                                <div>
                                    <flux:heading size="lg">{{ $ticket->user->name ?? 'Unknown User' }}</flux:heading>
                                    <flux:text>{{ $ticket->user->email ?? 'No Email' }}</flux:text>
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ $ticket->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->created_at->format('Y/m/d') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->responses->isNotEmpty())
                                {{ $ticket->responses->first()->created_at->format('d/m/Y H:i') }} <!-- Display the latest response time -->
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($ticket->status == 'open')
                                <flux:badge variant="solid" color="purple">Open</flux:badge>
                            @elseif ($ticket->status == 'in_progress')
                                <flux:badge variant="solid" color="yellow">In Progress</flux:badge>
                            @elseif ($ticket->status == 'resolved')
                                <flux:badge variant="solid" color="green">Resolved</flux:badge>
                            @elseif ($ticket->status == 'closed')
                                <flux:badge variant="solid" color="pink">Closed</flux:badge>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <flux:button.group>
                                <flux:tooltip content="Response">
                                    <flux:button variant="primary" href="{{ route('hr2.helpdesk.show', $ticket->id) }}">Response</flux:button>
                                </flux:tooltip>
                            </flux:button.group>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tickets->links() }}
    </div>


    {{-- <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon">
                            <i class="fas fa-inbox"></i></span> My tickets
                        <span class="new-messages badge badge-info badge-pill">{{ $tickets->count() }}</span>
                        <span class=" new-messages">all tickets</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered first" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 70px;" class="center">Employee</th>
                                    <th class="center">Subject</th>
                                    <th style="width: 50px;">Created at</th>
                                    <th style="width: 105px;">Updated at</th>
                                    <th style="width: 60px;">Status</th>
                                    <th class="right" style="width: 60px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                <tr>
                                    <td class="zero-space">
                                        <a href="#" class="btn-account" role="button">
                                            <span class="user-avatar">
                                                <img src="{{ $ticket->user->profile_photo_path ? Storage::url($ticket->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                                                alt="User Avatar" class="user-avatar-lg rounded-circle">
                                            </span>
                                            <div class="account-summary">
                                                <h5 class="account-name">{{ $ticket->user->name ?? 'Unknown User' }}</h5>
                                                <span class="account-description">{{ $ticket->user->email ?? 'No Email' }}</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->created_at->format('Y/m/d') }}</td>
                                    <td>
                                        @if($ticket->responses->isNotEmpty())
                                            {{ $ticket->responses->first()->created_at->format('d/m/Y H:i') }} <!-- Display the latest response time -->
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ticket->status == 'open')
                                            <span class="badge badge-primary">Open</span>
                                        @elseif ($ticket->status == 'in_progress')
                                            <span class="badge badge-warning">In Progress</span>
                                        @elseif ($ticket->status == 'resolved')
                                            <span class="badge badge-success">Resolved</span>
                                        @elseif ($ticket->status == 'closed')
                                            <span class="badge badge-secondary">Closed</span>
                                        @endif
                                    </td>
                                    <td class="right">
                                        <div class="ml-auto btn-group">
                                            <a href="{{ route('hr2.helpdesk.show', $ticket->id) }}"
                                                class="btn btn-sm btn-outline-light tooltip-container">
                                                <i class="far fas fa-reply"></i>
                                                <span class="tooltip-text">Response</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Claims Trash - Show Count of Deleted Claims -->
    <div class="w-full max-w-3xs sm:max-w-3xs">
        <a href="{{ route('hr2.helpdesk.trash')}}">
            <flux:callout icon="trash" color="red" inline>
                <flux:callout.heading>Archived Tickets:<flux:badge variant="solid" size="sm" color="red">{{ $archivedTicketCount }}</flux:badge></flux:callout.heading>
            </flux:callout>
        </a>
    </div>

    {{-- <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <a href="{{ route('hr2.helpdesk.trash')}}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Archived Tickets</h5>
                            <h2 class="mb-0">{{ $archivedTicketCount }}</h2> <!-- Display deleted claims count -->
                        </div>
                        <div class="float-right mt-1 icon-circle-medium icon-box-lg bg-danger-light">
                            <i class="fas fa-archive fa-sm text-danger"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div> --}}
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({ tags: true });
    });
    </script>
@endpush
