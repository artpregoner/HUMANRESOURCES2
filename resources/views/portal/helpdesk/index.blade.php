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
                                    <td></td>
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
    <div class="row">
        <!-- ============================================================== -->
        <!-- Helpdesk Tcket sorting  -->
        <!-- ============================================================== -->
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block">
                <h5 class="section-title">Archived Table</h5>
            </div>
            <div class="accrodion-regular">
                <div id="accordion3">
                    <!-- Helpdesk Tcket Sorting table History  -->
                    {{-- <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven"
                                    aria-expanded="true" aria-controls="collapseSeven">
                                    <span class="fas mr-3 fa-angle-up"></span>APPROVE CLAIMS HISTORY
                                </button>
                                <div class="float-right">
                                    <h3 class="mb-0"><span class="badge badge-success">APPROVE</span></h3>
                                </div>
                            </h5>
                        </div>
                        <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven"
                            data-parent="#accordion3" style="">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive-sm">
                                            <table class="table table-striped table-bordered first">
                                                <thead>
                                                    <tr>
                                                        <th class="center">Claim ID</th>
                                                        <th>Claim Date</th>
                                                        <th>Description</th>
                                                        <th class="right">Category</th>
                                                        <th class="center">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="center">C200</td>
                                                        <td class="left strong">JUNE 29 2025</td>
                                                        <td class="left">Travel Qc to FAirview</td>
                                                        <td class="right">Fare</td>
                                                        <td class="center">100</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Helpdesk  sorting  -->
                    {{-- <div class="card mb-2">
                        <div class="card-header" id="headingEight">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight"
                                    aria-expanded="false" aria-controls="collapseEight">
                                    <span class="fas fa-angle-down mr-3"></span>REJECTED CLAIMS HISTORY
                                </button>
                                <div class="float-right">
                                    <h3 class="mb-0"><span class="badge badge-code8">REJECTED</span></h3>
                                </div>
                            </h5>
                        </div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion3">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive-sm">
                                            <table class="table table-striped table-bordered first">
                                                <thead>
                                                    <tr>
                                                        <th class="center">Claim ID</th>
                                                        <th>Claim Date</th>
                                                        <th>Description</th>
                                                        <th class="right">Category</th>
                                                        <th class="center">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="center">C200</td>
                                                        <td class="left strong">JUNE 29 2025</td>
                                                        <td class="left">Travel Qc to FAirview</td>
                                                        <td class="right">Fare</td>
                                                        <td class="center">100</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Helpdesk Tcket Delete History  -->
                    <div class="card mb-2">
                        <div class="card-header" id="headingNine">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine"
                                    aria-expanded="false" aria-controls="collapseNine">
                                    <span class="fas fa-angle-down mr-3"></span>DELETED CLAIMS HISTORY
                                </button>
                                <div class="float-right">
                                    <h3 class="mb-0"><span class="badge badge-danger">Archived</span></h3>
                                </div>
                            </h5>
                        </div>
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion3">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive-sm">
                                            <table class="table table-striped table-bordered first">
                                                <thead>
                                                    <tr>
                                                        <th class="center">Ticket ID</th>
                                                        <th>Category</th>
                                                        <th>Subject</th>
                                                        <th class="center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="center">T200</td>
                                                        <td class="left strong">Account Information</td>
                                                        <td class="left">Travel Qc to FAirview</td>
                                                        <td class="right">
                                                            <div class="btn-group ml-auto">
                                                                <form action="{{ url('helpdesk.destroy') }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-light tooltip-container"
                                                                        onclick="return confirm('Are you sure you want to delete this ticket permanently?');"><span
                                                                            class="tooltip-text">Permanently Delete.</span>
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                <a href="{{ route('portal.helpdesk.response') }}" class="btn btn-sm btn-outline-light tooltip-container">
                                                                    <i class="fas fa-archive"></i>
                                                                    <span class="tooltip-text">
                                                                        Unarchived this Ticket.
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
