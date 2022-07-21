@extends('layout')

@section('head')
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    
@endsection

@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us">
            <h1 style="padding-top: 5px; ">
                Input Device
            </h1>
            @include('includes.flash-message')

            <div class="contact-form">
                <form action="{{ route('device.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <!-- Name -->
                  <label for="name"><span>Name</span></label>
                  <input type="text" id="name" name="name" value="{{ old('name') }}"/>
                  @error('name')
                    <p style="color: red; margin-bottom: 25px; ">{{ $message }}</p>
                  @enderror
                  <!-- Image -->
                  <label for="image"><span>Image</span></label>
                  <input type="file" id="image" name="image" />
                  @error('image')
                    <p style="color: red; margin-bottom: 25px; ">{{ $message }}</p>
                  @enderror

                  <!-- Drop down -->
                  <label for="types"><span>Choose a type:</span></label>
                  <select name="type_id" id="types">
                      <option selected disabled>Select option </option>
                      @foreach ($types as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                      @endforeach
                  </select>
                  @error('type_id')
                      {{-- The $attributeValue field is/must be $validationRule --}}
                      <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                  @enderror

                  <!-- Description -->
                  <label for="description"><span>Description</span></label>
                  <textarea name="description" id="description">{{ old('description') }}</textarea>
                  @error('description')
                    <p style="color: red; margin-bottom: 25px; ">{{ $message }}</p>
                  @enderror

                   <!-- Button -->
                  <input type="submit" value="Submit" />
                </form>
              </div>
        </section>

    </main>
@endsection

@section('scripts')
<script>
  CKEDITOR.replace( 'description' );
</script>
@endsection