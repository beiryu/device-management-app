@extends('layout')

@section('main')
<!-- main -->
<main class="container">
  <h2 class="header-title">All Devices</h2>
  
  @include('includes.flash-message')
  <div id="DeviceSearch"></div>

  <div class="types">
    <ul>
      @foreach ($types as $type)
      <li><a href="{{ route('device.index', ['type' => $type->name]) }}">{{ $type->name }}</a></li>
          
      @endforeach
    </ul>
  </div>
  <section class="row latest-blog">
    <p>{{ _('Sorry, currently there is no device related to that search!') }}</p>
  </section>
</main>
@endsection