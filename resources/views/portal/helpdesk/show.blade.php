@extends('layouts.app')
@section('title', 'Helpdesk - My Tickets')
@section('header', 'Helpdesk')
@section('active-header', 'Response')
@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/vendor/image-modal/style.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        @include('components.modal.image-modal')
        <livewire:portal.helpdesk.respond :ticket="$ticket" />
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('asset/vendor/image-modal/scripts.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
