@extends('layouts.portal')
@section('title', 'Claims | My Expenses')

@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('portal.claims.index')">Claims</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('portal.claims.index')">Expenses List</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('portal.claims.index')">Total: {{ $totalClaimsCount }}</flux:breadcrumbs.item>
@endsection

@push('styles')

@endpush

@section('content')
    @include('components.alert.alert')
    @livewire('portal.claims.index')

    <!-- Claims Trash - Show Count of Deleted Claims -->
    <div class="w-full py-4 max-w-3xs sm:max-w-3xs">
        <a wire:navigate href="{{ route('portal.claims.trash')}}">
            <flux:callout icon="trash" color="red" inline>
                <flux:callout.heading>Archived Tickets:<flux:badge variant="solid" size="sm" color="red">{{ $archivedClaimsCount }}</flux:badge></flux:callout.heading>
            </flux:callout>
        </a>
    </div>
@endsection

@push('scripts')

@endpush
