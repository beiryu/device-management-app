@extends('layout')

@section('main')

<!-- main -->
<main class="container">
  <section class="single-blog-post">
    @include('includes.flash-message')
    
    <h1>{{ $device->name }}</h1>

    <div class="single-post-upper">
      <div class="single-blog-post-ContentImage" data-aos="fade-left">
        <a href="{{ asset($device->imgPath) }}"><img src="{{ asset($device->imgPath) }}" alt="" /></a>
      </div>
      <div>
        <h3>
          Type
        </h3>
        <div class="about-text">
          {!! $device->type->name !!}
        </div>
        <br>
        <h3>
          Description
        </h3>
        <div class="about-text">
          {!! $device->description !!}
        </div>
        <div class='show-device'>
          @if ($device->status->name !== 'lent')
            <form action="{{ route('device.hire', $device) }}" method="post">
              @method('put') 
              @csrf
              <input type="submit" value="Hire">
            </form>
          @endif
          @if (Auth::check() && auth()->user()->role->name === 'admin')
            <div>
              <a href="{{ route('device.edit', $device) }}">Edit this device...<span>&#8594;</span></a>
            </div>
            <form action="{{route('device.destroy', $device)}}" method="post">
                @method('delete')
                @csrf
                <input class="red" type="submit" value="Delete">
            </form>
          @endif
        </div>
      </div>
    </div>
  </section>

  @if ($relatedDevices !== null)
  <section class="recommended">
    <p>Related</p>
    <div class="recommended-cards">
     
      @foreach ($relatedDevices as $device)
      <a href="{{ route('device.show', $device) }}">
        <div class="recommended-card">
          <img src="{{ asset($device->imgPath) }}" alt="" loading="lazy" />
          <h4>
            {{ $device->name }}
          </h4>
        </div>
      </a>
      @endforeach
      
      
    </div>
  </section>
  @endif

</main>
    
@endsection