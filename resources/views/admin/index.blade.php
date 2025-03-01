@extends('layouts.app')
@section('title','Human Resources')
@section('header','Human Resources')
@section('active-header', 'Dashboard')

@section('content')
    @include('components.alert.alert')

    <div class="ecommerce-widget">

        @include('analytics.employee-analytics')

        <div class="border-top"></div>

        <!-- Claims & Reimbursement Section -->
        @include('claims.claims-section')

    </div>

@endsection

@push('scripts')
@endpush
