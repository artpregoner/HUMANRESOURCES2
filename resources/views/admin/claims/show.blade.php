@extends('layouts.app')
@section('title', 'Claims')

@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Claims</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.claims.index')">Show: {{ $claim->id }}</flux:breadcrumbs.item>
@endsection

@push('styles')

@endpush

@section('content')
    @livewire('claims.show', ['claim' => $claim])
@endsection

@push('scripts')

@endpush
