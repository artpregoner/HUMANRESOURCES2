@extends('layouts.app')
@section('title','Human Resources')

@section('content')
    @include('components.alert.alert')

    <div class="gap-4">
        @include('analytics.employee-analytics')

        <div class="border-top"></div>

        <!-- Claims & Reimbursement Section -->
        @include('claims.claims-section')

    </div>

@endsection

@push('scripts')
@endpush
