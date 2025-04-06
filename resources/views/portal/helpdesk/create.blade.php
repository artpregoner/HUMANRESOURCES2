@extends('layouts.portal')
@section('title', 'Helpdesk - Create Ticket')

@section('breadcrumbs')
    <flux:breadcrumbs.item href="#">Helpdesk</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#">Submit new Ticket</flux:breadcrumbs.item>
@endsection

@push('styles')
@endpush

@section('content')
    @include('components.alert.alert')
    @livewire('helpdesk.create')
@endsection

@push('scripts')

@endpush
