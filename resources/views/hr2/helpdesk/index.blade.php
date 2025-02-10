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
                                                <img src="{{ asset('template/assets/images/user1.png') }}" alt="User Avatar" class="user-avatar-lg rounded-circle">
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
    {{-- <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" novalidate="">
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <label for="country">Subject</label>
                                        <input type="text" class="form-control" id="zip" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="state">category</label>
                                        <select class="custom-select d-block w-100" id="state" required="">
                                            <option value="">Choose...</option>
                                            <option>California</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="zip">Response</label>
                                        <input type="text" class="form-control" id="zip" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Zip code required.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="zip">Send to</label>
                                        <select class="js-example-basic-multiple" multiple="multiple">
                                            <option value="Alabama">Alabama</option>
                                            <option value="Alaska" selected="selected">Alaska</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label for="zip">submit</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="section-block">
                <a href="{{ route('hr2.helpdesk.trash')}}" class="btn btn-outline-dark btn-lg">Archived Tickets</a>
            </div>
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
