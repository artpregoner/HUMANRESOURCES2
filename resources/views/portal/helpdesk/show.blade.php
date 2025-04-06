@extends('layouts.portal')
@section('title', 'Helpdesk - My Tickets')

@section('breadcrumbs')
    <flux:breadcrumbs.item href="#">Helpdesk</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#">Response</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#">{{ Str::limit($ticket->title, 50) }}</flux:breadcrumbs.item>
@endsection
@push('styles')
@endpush

@section('content')
    @include('components.alert.alert')
    <livewire:helpdesk.respond :ticket="$ticket" />
@endsection

@push('scripts')
@endpush
