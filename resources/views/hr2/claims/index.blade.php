@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'Employee Requests')

@push('styles')

@endpush

@section('content')
    @livewire('claims.index')

    <!-- Claims Trash - Show Count of Deleted Claims -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <a href="{{ route('hr2.claims.trash') }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Archived Claims</h5>
                            <h2 class="mb-0">{{ $archivedClaimsCount }}</h2> <!-- Display deleted claims count -->
                        </div>
                        <div class="float-right mt-1 icon-circle-medium icon-box-lg bg-danger-light">
                            <i class="fas fa-archive fa-sm text-danger"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
