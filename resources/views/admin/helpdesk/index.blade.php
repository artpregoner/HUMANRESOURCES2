@extends('layouts.app')
@section('title', 'Helpdesk - Tickets')

@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('admin.helpdesk.index')">Helpdesk</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.helpdesk.index')">Ticket List</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.helpdesk.index')">Total: {{ $totalTicketCount }}</flux:breadcrumbs.item>
@endsection


@push('styles')

@endpush


@section('content')
    @include('components.alert.alert')
    @livewire('helpdesk.index')

    <div class="w-full pt-2 max-w-3xs sm:max-w-3xs">
        <a wire:navigate href="{{ route('admin.helpdesk.trash')}}">
            <flux:callout icon="trash" color="red" inline>
                <flux:callout.heading>Archived Tickets:<flux:badge variant="solid" size="sm" color="red">{{ $archivedTicketCount }}</flux:badge></flux:callout.heading>
            </flux:callout>
        </a>
    </div>


@endsection
@push('scripts')

@endpush
