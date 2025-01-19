@extends('layouts.app')
@section('title', 'Helpdesk - My Tickets')
@section('header', 'Helpdesk')
@section('active-header', 'My Tickets...')
@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon">
                            <i class="fas fa-inbox"></i></span> My tickets
                        <span class="new-messages">0 all tickets</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered first" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 70px;" class="center">Employee</th>
                                    <th class="center">Subject</th>
                                    <th style="width: 105px;">Created at</th>
                                    <th style="width: 105px;">Updated at</th>
                                    <th style="width: 60px;">Status</th>
                                    <th class="right" style="width: 60px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($tickets as $ticket) --}}
                                <tr>
                                    {{-- <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->department }}</td>
                                    <td>{{ $ticket->priority }}</td>
                                    <td>{{ $ticket->category }}</td>
                                    <td>{{ $ticket->created_at->format('Y/m/d') }}</td> --}}
                                    <td class="zero-space">
                                        <a href="#" class="btn-account" role="button">
                                            <span class="user-avatar">
                                                  <img src="{{ asset('template/assets/images/user1.png')}}" alt="User Avatar" class="user-avatar-lg rounded-circle">
                                            </span>
                                            <div class="account-summary">
                                                <h5 class="account-name">John Abraham ddawdawd</h5>
                                                <span class="account-description">Department</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>Account Information</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="right">
                                        <div class="input-group-append be-addon" style="width: 105px;">
                                            <button type="button" data-toggle="dropdown" class="btn btn-outline-code3 dropdown-toggle">Select</button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('hr2.helpdesk.response') }}" class="dropdown-item text-code3">
                                                    <i class="fas fa-reply"></i> Response
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('hr.helpdesk.delete') }}" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this ticket?');">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
