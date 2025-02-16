@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'Employee Claims Details')

@push('styles')

@endpush

@section('content')
    @livewire('claims.show', ['claim' => $claim])
@endsection

@push('scripts')

@endpush
