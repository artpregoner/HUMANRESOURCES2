@extends('layouts.app')
@section('title','Helpdesk - Reply')
@section('header','Helpdesk') <!--pageheader-->
@section('active-header', 'View Reply') <!--active pageheader-->

@section('content')
<div class="chat-module">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="email-title">
                        <span class="icon"><i class="fas fa-inbox"></i></span>
                        Ticket Reply for:
                    </div>
                    <button type="button" class="btn btn-primary btn-space" onclick="window.location.href='{{ route('portal.helpdesk.read') }}'">
                        Return to Ticket Lists
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-module-top">
        <div class="chat-module-body">
            {{-- @if ($ticket->replies && count($ticket->replies) > 0) --}}
                {{-- @foreach($ticket->replies->reverse() as $reply) <!-- Reverse the order of replies --> --}}
                    <div class="media chat-item ">
                        <img alt=""
                             src=""
                             class="rounded-circle user-avatar-lg">
                        <div class="media-body">
                            <div class="chat-item-title">
                                <span class="chat-item-author"></span>
                                <span class="text-muted"></span>
                            </div>
                            <div class="chat-item-body">
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                {{-- @endforeach --}}
            {{-- @else --}}
                <p class="text-muted">No replies yet.</p>
            {{-- @endif --}}
        </div>
    </div>

    <div class="email editor">
        <form action="{{ url('ticket.reply.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="reply" rows="6" placeholder="Write your reply!" required></textarea>
            </div>
            <div class="action-send">
                <button class="btn btn-primary btn-space" type="submit">
                    <i class="icon s7-mail"></i> Send
                </button>
                <button type="button" class="btn btn-secondary btn-space" onclick="window.location.href='{{ route('portal.helpdesk.read') }}'">
                    <i class="icon s7-close"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
@endpush
