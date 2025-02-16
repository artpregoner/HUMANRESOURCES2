@extends('layouts.app')
@section('title', 'Archived Claims')
@section('header', 'Archived Claims')

@push('styles')
<style>
    th, td {
        white-space: nowrap; /* Prevent text wrapping for better spacing */
        text-align: center; /* Center align text */
    }
</style>
@endpush

@section('content')
    @include('components.alert.alert')
    <div class="card">
        <div class="card-header">
            <div class="email-title">
                <span class="icon"><i class="fas fa-archive"></i></span> Archived Claims
                <span class="new-messages badge badge-info badge-pill">{{ $claims->count() }}</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered first">
                    <thead>
                        <tr>
                            <th class="center" style="width: 105px;">Expense Date</th>
                            <th>Submitted By</th>
                            <th>Deleted By</th>
                            <th>Delete Comments</th>
                            <th class="right" style="width: 90px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($claims as $claim)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}</td>
                                <td>{{ $claim->submittedBy->name }}</td>
                                <td>
                                    @if ($claim->deleted_by)
                                        @php
                                            $deletedUser = \App\Models\User::find($claim->deleted_by);
                                        @endphp

                                        @if ($deletedUser)
                                            @if ($deletedUser->id === Auth::id())
                                                You
                                            @else
                                                {{ $deletedUser->name }}
                                                @if ($deletedUser->role === 'hr')
                                                    (HR)
                                                @elseif ($deletedUser->role === 'admin')
                                                    (Admin)
                                                @else
                                                    (Unknown Role)
                                                @endif
                                            @endif
                                        @else
                                            Unknown User
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $claim->delete_comments ?? 'No comments' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('admin.claims.restore', $claim->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to restore this claim?')">
                                                <i class="fas fa-trash-restore"></i> Restore
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.claims.forceDelete', $claim->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('This will permanently delete the claim. Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete Permanently
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Claims Index - Show Count of Auth User Claims -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <a href="{{ route('hr2.claims.index') }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Claims</h5>
                            <h2 class="mb-0">{{ $claimsCount }}</h2> <!-- Display count -->
                        </div>
                        <div class="float-right icon-circle-medium icon-box-lg bg-info-light mt-1">
                            <i class="fas fa-hand-holding-usd fa-sm text-primary"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
