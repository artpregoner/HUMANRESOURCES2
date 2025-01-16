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
                    <div class="email-title"><span class="icon"><i class="fas fa-inbox"></i></span> My tickets <span
                            class="new-messages">0 all tickets</span> </div>
                    <button type="button" class="btn btn-space btn-code3"
                        onclick="window.location.href='{{ route('portal.helpdesk.create') }}'">new ticket</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered first" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 70px;" class="center">Ticket ID</th>
                                    <th class="center">Subject</th>
                                    <th style="width: 105px;">Created at</th>
                                    <th style="width: 105px;">Updated at</th>
                                    <th style="width: 60px;">Status</th>
                                    <th class="right" style="width: 90px;">Actions</th>
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
                                    <td class="center">T200</td>
                                    <td>Account Information</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    </td>
                                    <td class="right">
                                        <div class="btn-group ml-auto">
                                            {{-- <a href="{{ route('portal.helpdesk.edit') }}" class="btn btn-sm btn-outline-light tooltip-container"><span class="tooltip-text">update this ticket</span>Edit</a> --}}
                                            {{-- <a href="{{ route('helpdesk.edit', $ticket->id) }}" class="btn btn-sm btn-outline-light">Edit</a> --}}
                                            <form action="{{ url('helpdesk.destroy') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-light tooltip-container"
                                                    onclick="return confirm('Are you sure you want to delete this ticket?');"><span
                                                        class="tooltip-text">Archive this ticket</span>
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('portal.helpdesk.response') }}"
                                                class="btn btn-sm btn-outline-light tooltip-container"><i
                                                    class="far fas fa-reply"></i><span
                                                    class="tooltip-text">Reponse</span></a>
                                            {{-- <a href="{{ url('user.helpdesk.show', $ticket->id) }}" class="btn btn-sm btn-outline-light">Reply</a> --}}
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
