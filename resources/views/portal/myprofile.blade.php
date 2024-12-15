@extends('layouts.app')
@section('title','My Profile')
@section('header','Portal')<!--pageheader-->
@section('active-header', 'My Profile')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="email-title">My Profile</h5>
            </div>
            <div class="card-body">
                <div class="user-avatar text-center d-block">
                    <img src="{{asset('template/assets/images/avatar-1.jpg')}}" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                </div>
            </div>
            <div class="card-footer d-flex text-muted">
                Click on the image above, or drag and drop a new one on top, in order to update the profile picture for your account ( 128 x 128px size recommended. Limit 5MB. ).
            </div>
        </div>
    </div>
</div>
@endsection
