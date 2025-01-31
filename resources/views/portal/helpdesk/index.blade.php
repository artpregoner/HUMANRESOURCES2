@extends('layouts.app')
@section('title', 'Helpdesk - My Tickets')
@section('header', 'Helpdesk')
@section('active-header', 'My Tickets')
@push('styles')
@endpush

@section('content')
    @include('components.alert.alert')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon"><i class="fas fa-inbox"></i></span> My tickets <span
                            class="new-messages">{{ $tickets->count() }} all tickets</span> </div>
                    <button type="button" class="btn btn-space btn-code3"
                        onclick="window.location.href='{{ route('portal.helpdesk.create') }}'">new ticket</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered first" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="center">Subject</th>
                                    <th style="width: 105px;">Created at</th>
                                    <th style="width: 105px;">Updated at</th>
                                    <th style="width: 60px;">Status</th>
                                    <th class="right" style="width: 90px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->created_at->format('Y/m/d') }}</td>
                                        <td>
                                            @if($ticket->responses->isNotEmpty())
                                                {{ $ticket->responses->first()->created_at->format('d/m/Y H:i') }} <!-- Display the latest response time -->
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($ticket->status) }}</td>
                                        <td class="right">
                                            <div class="btn-group ml-auto">
                                                <form action="{{ route('portal.helpdesk.destroy', $ticket->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-light tooltip-container"
                                                        onclick="return confirm('Are you sure you want to delete this ticket?');">
                                                        <span class="tooltip-text">Archive this ticket</span>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('portal.helpdesk.show', $ticket->id) }}"
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
@endsection

@push('scripts')
@endpush
