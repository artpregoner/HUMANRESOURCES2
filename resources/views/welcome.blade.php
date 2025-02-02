@extends('layouts.app')
@section('title', 'My Profile')
@section('header', 'HR2')
@section('active-header', 'My Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/vendor/image-modal/style.css') }}">
@endpush

@section('content')
    @livewire('auth.login')
@endsection

@push('scripts')
    <script src="{{ asset('asset/vendor/image-modal/scripts.js') }}"></script>
@endpush
