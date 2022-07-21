@extends('layout')
@section('head')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@endsection
@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us">
            <h1 style="padding-top: 50px;">Edit Device Type!</h1>
            @include('includes.flash-message')

            <!-- Contact Form -->
            <div class="contact-form">
                <form action="{{ route('types.update', $type) }}" method="post" >
                    @method('put')
                    @csrf
                    <!-- name -->
                    <label for="name"><span>Name</span></label>
                    <input type="text" id="name" name="name" value="{{ $type->name }}" />
                    @error('name')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                    @enderror
                
                    <!-- Button -->
                    <input type="submit" value="Submit" />
                </form>
            </div>
            <div class="create-types">
                <a href="{{route('types.index')}}">Types list <span>&#8594;</span></a>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection