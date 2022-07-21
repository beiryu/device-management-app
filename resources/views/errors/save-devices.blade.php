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
            <p>Sorry, do not save successfully!</p>
        </section>

    </main>
@endsection

@section('scripts')
<script>
  CKEDITOR.replace( 'description' );
</script>
@endsection