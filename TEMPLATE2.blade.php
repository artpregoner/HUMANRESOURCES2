@extends('layouts.app')
@section('title', 'Claims&Reimbursement')
@section('header','Claims&Reimbursement') <!--pageheader-->
@section('active-header', 'Request')<!--active pageheader-->

<!-- ============================================================== -->
<!-- STYLES -->
<!-- ============================================================== -->
@prepend('styles')

@endprepend
@push('styles')

@endpush
<!-- ============================================================== -->
<!-- END STYLES -->
<!-- ============================================================== -->



<!-- ============================================================== -->
<!-- CHILD VIEWS -->
<!-- ============================================================== -->
@section('content')

@endsection
<!-- ============================================================== -->
<!-- END CHILD VIEWS -->
<!-- ============================================================== -->



<!-- ============================================================== -->
<!-- SCRIPTS -->
<!-- ============================================================== -->
@push('scripts')

@endpush
@prepend('scripts')

@endprepend
<!-- ============================================================== -->
<!-- END SCRIPTS -->
<!-- ============================================================== -->


{{-- para to sa show.blade para maging clickable si table row na nasa loob ng table body (dapat route syempre) --}}

<tr style="cursor: pointer" onclick="window.location='{{ url('hr2.index')}}'">
