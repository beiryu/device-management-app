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
    @forelse ($devices as $device)
    <div class="col-xl-4 col-lg-6 col-md-12 py-5 px-3 card-blog-content">
      <a href="{{ route('device.show', $device) }}"><img src="{{ asset($device->imgPath) }}" alt="" /></a>

      <h4>
        <a href="{{ route('device.show', $device) }}">{{ $device->name }}</a>
      </h4>
      <div class='devices-list'>
        <form action="{{ route('device.hire', $device) }}" method="post">
          @method('put') 
          @csrf
          <input type="submit" value="Hire">
        </form>
        <a href="{{ route('device.show', $device) }}">Read more about this device<span>&#8594;</span></a> 
      </div>
    </div>

    @empty
        <p>Sorry, currently there is no device related to that search!</p>
    @endforelse

    {{ $devices->links('pagination::default') }}
  </section>
</main>
@endsection