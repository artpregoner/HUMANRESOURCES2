@extends('layouts.app')
@section('title', 'Helpdesk - My Tickets')
@section('header', 'Helpdesk')<!--pageheader-->
@section('active-header', 'My Tickets...') <!--active pageheader-->
@section('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/select.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon"><i class="fas fa-inbox"></i></span> My tickets <span class="new-messages">0 all tickets</span> </div>
                    {{-- <div class="email-title"><span class="icon"><i class="fas fa-inbox"></i></span> My tickets <span class="new-messages">({{ $totalTickets }} all tickets)</span> </div> --}}
                    <button type="button" class="btn btn-space btn-primary" onclick="window.location.href='{{ route('helpdesk.create') }}'">new ticket</button>
                    {{-- <button type="button" class="btn btn-space btn-primary" onclick="window.location.href='{{ route('helpdesk.create') }}'">Submit new Ticket</button> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th style="width: 80px;">Priority</th>
                                    <th style="width: 80px;">Category</th>
                                    <th style="width: 100px;">Created at</th>
                                    <th style="width: 90px;">Actions</th>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="btn-group ml-auto">
                                            <a href="{{ route('helpdesk.update') }}" class="btn btn-sm btn-outline-light tooltip-container"><span class="tooltip-text">update this ticket</span>Edit</a>
                                            {{-- <a href="{{ route('helpdesk.edit', $ticket->id) }}" class="btn btn-sm btn-outline-light">Edit</a> --}}
                                            <form action="{{ url('helpdesk.destroy') }}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-light tooltip-container" onclick="return confirm('Are you sure you want to delete this ticket?');"><span class="tooltip-text">delete this ticket</span>
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <a href="{{ url('portal.helpdesk.response') }}" class="btn btn-sm btn-outline-light tooltip-container"><i class="far fas fa-reply"></i><span class="tooltip-text">reponse</span></a>
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
@section('scripts')
        <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('template/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('template/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
        <script src="{{ asset('template/assets/libs/js/main-js.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('template/assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('template/assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template/assets/vendor/datatables/js/data-table.js') }}"></script>
@endsection



