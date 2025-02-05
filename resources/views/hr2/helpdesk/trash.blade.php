@extends('layouts.app')
@section('title', 'Helpdesk - My Tickets')
@section('header', 'Helpdesk')
@section('active-header', 'Archived Tickets')

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
                    <div class="email-title">
                        <span class="icon"><i class="fas fa-inbox"></i></span>
                        Recently deleted tickets <span class="new-messages">{{ $tickets->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered first" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="center">Subject</th>
                                    <th style="width: 105px;">Deleted at</th>
                                    <th style="width: 105px;">Deleted by</th>
                                    <th class="right" style="width: 90px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->deleted_at->format('d/m/Y H:i A') }}</td>
                                        <td>
                                            @if ($ticket->deleted_by)
                                                @php
                                                    $deletedUser = \App\Models\User::find($ticket->deleted_by);
                                                @endphp

                                                @if ($deletedUser)
                                                    @if ($deletedUser->role === 'hr')
                                                        {{ $deletedUser->name }} (HR)
                                                    @elseif ($deletedUser->role === 'admin')
                                                        {{ $deletedUser->name }} (Admin)
                                                    @elseif ($deletedUser->role === 'employee')
                                                        {{ $deletedUser->name }} (Employee)
                                                    @elseif ($deletedUser->id === Auth::id())
                                                        You
                                                    @else
                                                        {{ $deletedUser->name }} (Unknown Role)
                                                    @endif
                                                @else
                                                    Unknown User
                                                @endif
                                            @else
                                                No deletion recorded
                                            @endif
                                        </td>

                                        <td class="right">
                                            <div class="btn-group ml-auto">
                                                <!-- Restore Form -->
                                                <form action="{{ route('hr2.helpdesk.restore', $ticket->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-light tooltip-container">
                                                        <i class="far fa-share-square"></i>
                                                        <span class="tooltip-text">Restore</span>
                                                    </button>
                                                </form>
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
    <div class="row">
        <div class="col-xl-12">
            <div class="section-block">
                <a wire:navigate href="{{ route('hr2.helpdesk.index')}}" class="btn btn-outline-dark btn-lg">Return to ickets</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
