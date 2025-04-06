@extends('layouts.app')
@section('title', 'Helpdesk - Response')
@section('breadcrumbs')
    <flux:breadcrumbs.item href="#">Helpdesk</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#">Response</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#">{{ $ticket->title }}</flux:breadcrumbs.item>
@endsection
@section('back-button')
    <a href="{{ route('admin.helpdesk.index') }}" class="float-right btn btn-space btn-code8 btn-sm">Return to Ticket List</a>
@endsection

@push('styles')
@endpush

@section('content')
    <livewire:helpdesk.respond :ticket="$ticket" />
@endsection

@push('scripts')
@endpush
