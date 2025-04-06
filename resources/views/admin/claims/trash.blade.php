@extends('layouts.app')
@section('title', 'Claims Trash')
@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Claims</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Trash List</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Total: {{ $archivedClaimsCount }}</flux:breadcrumbs.item>
@endsection

@push('styles')
@endpush

@section('content')
    @include('components.alert.alert')
    @livewire('claims.trash')

    <!-- Claims Index - Show Count of Auth User Claims -->
    <div class="w-full py-4 max-w-3xs sm:max-w-3xs">
        <a wire:navigate href="{{ route('admin.claims.index')}}">
            <flux:callout icon="currency-dollar" color="blue" inline>
                <flux:callout.heading>My Claims<flux:badge variant="solid" size="sm" color="blue">{{ $claimsCount }}</flux:badge></flux:callout.heading>
            </flux:callout>
        </a>
    </div>
@endsection

@push('scripts')
@endpush
