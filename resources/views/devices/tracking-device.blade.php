@extends('layout')

@section('main')
    <div class="types-list">
        <h1>Tracking Device List</h1>
        @include('includes.flash-message')

        <table class="item-center text-center">
            <tr>
                <th>User Name</th>
                <th>Device Type</th>
                <th>Device Name</th>
                <th>Action</th>
            </tr>
            @forelse ($trackingDevices as $device)
                <tr>
                    <td>{{ $device->user->name }}</td>
                    <td>{{ $device->type->name }}</td>
                    <td>{{ $device->name }}</td>
                    <td>
                        <form action="{{route('device.refund', $device)}}" method="post">
                            @method('put')
                            @csrf
                            <input class="cancel" type="submit" value="Withdraw">
                        </form>
                    </td>
                </tr>
            @empty
                <p>Sorry, currently there is no tracking device!</p>
            @endforelse
        </table>
    </div>
@endsection