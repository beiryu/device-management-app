@extends('layout')

@section('main')
    <div class="types-list">
        <h1>All Devices</h1>
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
                        <a class="edit" href="{{ route('device.edit', $device) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('device.destroy', $device)}}" method="post">
                            @method('delete')
                            @csrf
                            <input class="cancel" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <p>Sorry, currently you don't borrow any device !</p>
            @endforelse
        </table>
    {{ $devices->links('pagination::default') }}

    </div>

@endsection