@extends('layout')

@section('head')
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    
@endsection

@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us">
            <h1 style="padding-top: 5px; ">
                Create New Device Type
            </h1>
            @include('includes.flash-message')

            <div class="contact-form">
                <form action="{{ route('types.store') }}" method="post">
                  @csrf
                  <!-- Name -->
                  <label for="name"><span>Name</span></label>
                  <input type="text" id="name" name="name" value="{{ old('name') }}"/>
                  @error('name')
                    <p style="color: red; margin-bottom: 25px; ">{{ $message }}</p>
                  @enderror
                  
                   <!-- Button -->
                  <input type="submit" value="Submit" />
                </form>
              </div>
              <div class="create-types">
                <a href="{{ route('types.index') }}">Device Type list <span>&#8594;</span></a>
              </div>
        </section>

    </main>
@endsection

@section('scripts')
<script>
  CKEDITOR.replace( 'content' );
</script>
@endsection