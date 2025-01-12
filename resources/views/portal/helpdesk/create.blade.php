@extends('layouts.app')
@section('title','Helpdesk - Create Ticket')
@section('header','Helpdesk')
@section('active-header', 'Submit new Ticket')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Submit new Ticket</h5>
                <div class="card-body">
                    <form action="{{ url('helpdesk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="subject" class="col-form-label">Subject</label>
                            <input id="subject" name="subject" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="response">Response</label>
                            <textarea class="form-control" id="response" name="response" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sendTicketTo">Send to</label>
                            <select class="form-control" id="sendTicketTo" name="sendTicketTo" required>
                                <option value="">Send To</option>
                                <option value="Admin">Admin</option>
                                <option value="HR2">HR</option>
                            </select>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0 ml-auto">
                                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                <a href="{{ route('portal.helpdesk.index')}}" class="btn btn-space btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
