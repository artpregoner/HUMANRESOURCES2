@extends('layouts.app')
@section('title', 'Helpdesk - Tickets')

@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('admin.helpdesk.index')">Helpdesk</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.helpdesk.index')">Ticket List</flux:breadcrumbs.item>
@endsection


@push('styles')

@endpush


@section('content')
    @include('components.alert.alert')
    @livewire('helpdesk.stats')
    @livewire('helpdesk.index')
@endsection
@push('scripts')

@endpush
