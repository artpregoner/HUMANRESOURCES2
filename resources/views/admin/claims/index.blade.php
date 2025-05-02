@extends('layouts.app')
@section('title', 'Claims - Request')
@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Claims</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Claims List</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Total: {{ $claimsCount }}</flux:breadcrumbs.item>
@endsection

@push('styles')

@endpush

@section('content')
    @include('components.alert.alert')
    @livewire('claims.index')
    <div class="w-full py-4 max-w-3xs sm:max-w-3xs">
        <a wire:navigate href="{{ route('admin.claims.trash')}}">
            <flux:callout icon="trash" color="red" inline>
                <flux:callout.heading>Archived Claims:<flux:badge variant="solid" size="sm" color="red">{{ $archivedClaimsCount }}</flux:badge></flux:callout.heading>
            </flux:callout>
        </a>
    </div>
@endsection

@push('scripts')
@endpush
