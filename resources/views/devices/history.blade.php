@extends('layout')

@section('main')
    <div class="types-list">
        <h1>History</h1>
        <table class="item-center text-center">
            <tr>
                <th>User Name</th>
                <th>Device Type</th>
                <th>Device Name</th>
                <th>Borrowed Date</th>
            </tr>
            @foreach ($data as $user)
                @foreach ($user->devices as $device)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $device->type->name }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->pivot->created_at}}</td>
                </tr>
                @endforeach                                        
            @endforeach
            
        </table>
    </div>

@endsection