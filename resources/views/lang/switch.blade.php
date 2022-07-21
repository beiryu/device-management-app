@extends('layout')

@section('main')
    <div class="types-list">
        @include('includes.flash-message')
        <h1>Current Language</h1>
        <div class="index-types">
            <p>{{ Config::get('languages')[App::getLocale()] }}</p>
        </div>

        <h1>Switch To</h1>
        <div class="index-types">
            @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                    <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                @endif
            @endforeach
        </div>
        
    </div>
@endsection