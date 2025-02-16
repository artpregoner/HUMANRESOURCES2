@extends('layouts.app')
@section('title', 'Helpdesk - My Tickets')
@section('header', 'Helpdesk')
@section('active-header', 'My Tickets...')
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
                                        <div class="btn-group ml-auto">
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
    </div>


    <!-- Claims Trash - Show Count of Deleted Claims -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <a href="{{ route('hr2.helpdesk.trash')}}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Archived Tickets</h5>
                            <h2 class="mb-0">{{ $archivedTicketCount }}</h2> <!-- Display deleted claims count -->
                        </div>
                        <div class="float-right icon-circle-medium icon-box-lg bg-danger-light mt-1">
                            <i class="fas fa-archive fa-sm text-danger"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({ tags: true });
    });
    </script>
@endpush
