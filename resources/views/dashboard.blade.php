@extends('layout')

@section('main')
<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!

                    

                    @include('components.profile')


                    <div class="dashboard">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('device.create') }}">Input Device</a>
                                
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('device.all-devices') }}">All Devices</a>
                                
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('types.create') }}">Create Device Type</a>
                                
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('types.index') }}">Device Type List</a>
                                
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('device.pending') }}">Pending Devices</a>
                                
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('device.tracking') }}">Tracking Devices</a>
                                
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('device.my-devices') }}">My Borrowed Devices</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('device.history') }}">History</a>

                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('lang.index') }}">Switch Language</a>

                            </li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@endsection
