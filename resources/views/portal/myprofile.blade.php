@extends('layouts.portal')
@section('title','My Profile')
@section('breadcrumbs')
    <flux:breadcrumbs.item href="#">My Profile</flux:breadcrumbs.item>
@endsection

@section('content')

    <div class="flex flex-col gap-4 item-center">

        @livewire('profile.update-profile-information-form')
        <flux:separator />
        @livewire('profile.update-password-form')

    </div>
@endsection
