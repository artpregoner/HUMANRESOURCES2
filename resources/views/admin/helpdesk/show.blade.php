@extends('layouts.app')
@section('title', 'Helpdesk - Reply')
@section('header', 'Helpdesk')
@section('active-header', 'Ticket Response')
@section('back-button')
    <a href="{{ route('admin.helpdesk.index') }}" class="btn btn-space btn-code8 btn-sm float-right">Return to Ticket List</a>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/vendor/image-modal/style.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.modal.image-modal')
            <livewire:admin.helpdesk.respond :ticket="$ticket" />
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('asset/vendor/image-modal/scripts.js') }}"></script>
@endpush
