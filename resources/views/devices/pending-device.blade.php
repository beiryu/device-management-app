@extends('layout')

@section('main')
    <div class="types-list">
        <h1>Pending Device List</h1>
        @include('includes.flash-message')

        <table class="item-center text-center">
            <tr>
                <th>User Name</th>
                <th>Device Type</th>
                <th>Device Name</th>
                <th colspan="2">Action</th>
            </tr>
            @forelse ($pendingDevices as $device)
                <tr>
                    <td>{{ $device->user->name }}</td>
                    <td>{{ $device->type->name }}</td>
                    <td>{{ $device->name }}</td>
                    <td>
                        <form action="{{route('device.approve', $device)}}" method="post">
                            @method('put')
                            @csrf
                            <input class="approve" type="submit" value="Approve">
                        </form>
                    </td>
                    <td>
                        <form action="{{route('device.refund', $device)}}" method="post">
                            @method('put')
                            @csrf
                            <input class="cancel" type="submit" value="Cancel">
                        </form>
                    </td>
                </tr>
            @empty
                <p>Sorry, currently there is no pending device!</p>
            @endforelse
            
        </table>
    </div>
@endsection