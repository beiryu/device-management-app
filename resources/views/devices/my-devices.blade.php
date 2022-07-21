@extends('layout')

@section('main')
    <div class="types-list">
        <h1>My Borrowed Equipments List</h1>
        @include('includes.flash-message')


        <table class="item-center text-center">
            <tr>
                <th>Device Type</th>
                <th>Device Name</th>
                <th colspan="2">Action</th>
            </tr>
            @forelse ($devices as $device)
                <tr>
                    <td>{{ $device->type->name }}</td>
                    <td>{{ $device->name }}</td>
                    <td>
                        <form action="{{route('device.refund', $device)}}" method="post">
                            @method('put')
                            @csrf
                            <input class="cancel" type="submit" value="Return this device">
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('device.show', $device) }}">Read more about this device...</a>
                    </td>
                </tr>
            @empty
                <p>Sorry, currently you don't borrow any device !</p>
            @endforelse
        </table>
    </div>
@endsection

