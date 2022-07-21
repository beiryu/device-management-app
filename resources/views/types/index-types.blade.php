@extends('layout')

@section('main')
    <div class="types-list">
        <h1>Device Type List</h1>
        @include('includes.flash-message')

        @foreach ($types as $type)
            <div class="item">
                <p>{{ $type->name }}</p>
                <div>
                    <a href="{{ route('types.edit', $type) }}">Edit</a>
                </div>
                <form action="{{route('types.destroy', $type)}}" method="post">
                    @method('delete')
                    @csrf
                    <input type="submit" value="Delete">
                </form>
            </div>
        @endforeach
        <div class="index-types">
            <a href="{{ route('types.create') }}">Create device type<span>&#8594;</span></a>
        </div>
    </div>
@endsection