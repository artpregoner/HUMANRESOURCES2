@extends('layouts.portal')
@section('title', 'Helpdesk - Trash')

@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('portal.helpdesk.index')">Helpdesk</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('portal.helpdesk.trash')">Archived List</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('portal.helpdesk.trash')">Total: {{ $deletedTicket }}</flux:breadcrumbs.item>
@endsection
@push('styles')

@endpush

@section('content')
    @include('components.alert.alert')
    @livewire('portal.helpdesk.trash')

    <!-- Claims Index - Show Count of Auth User Claims -->
    <div class="w-full py-4 max-w-3xs sm:max-w-3xs">
        <a wire:navigate href="{{ route('portal.helpdesk.index')}}">
            <flux:callout icon="ticket" color="blue" inline>
                <flux:callout.heading>My Tickets:<flux:badge variant="solid" size="sm" color="blue">{{ $totalTicketCount }}</flux:badge></flux:callout.heading>
            </flux:callout>
        </a>
    </div>

@endsection

@push('scripts')
@endpush
