@extends('layouts.app')
@section('title', 'index - ')

@section('breadcrumbs')

@endsection
@push('styles')

@endpush

@section('content')

    <x-data-table>

        <x-slot:header>
            <div>
                <a href="">adawa</a>
            </div>
        </x-slot:header>
        <x-slot:head>
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Employee</th>
                <th scope="col" class="px-6 py-3">Subject</th>
                <th scope="col" class="px-6 py-3">Created at</th>
                <th scope="col" class="px-6 py-3">Updated at</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </x-slot:head>

            <tr class="dark:border-zinc-600 hover:bg-zinc-100 dark:bg-zinc-800 dark:hover:bg-zinc-900">
                <td scope="col" class="px-6 py-3">ID</td>
                <td scope="col" class="px-6 py-3">Employee</td>
                <td scope="col" class="px-6 py-3">Subject</td>
                <td scope="col" class="px-6 py-3">Created at</td>
                <td scope="col" class="px-6 py-3">Updated at</td>
                <td scope="col" class="px-6 py-3">Status</td>
                <td scope="col" class="px-6 py-3">Actions</td>
            </tr>

        <x-slot:footer>
ddd
        </x-slot:footer>
    </x-data-table>

@endsection

@push('scripts')
@endpush
