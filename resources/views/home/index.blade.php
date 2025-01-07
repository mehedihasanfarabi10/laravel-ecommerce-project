{{-- Extend the main layout --}}
@extends('home.layouts.app')

{{-- Set the page title --}}
@section('title', 'Home Page')

{{-- Load the Slider Section --}}
@section('slider')
    @include('home.partials.slider')
@endsection

@section('slider-carousel')
    @include('home.partials.carousel')
@endsection

{{-- Main Content Section --}}
@section('content')
    {{-- Product Section --}}
    @include('home.pages.product')

    {{-- Contact Section (optional) --}}
    {{-- @include('home.pages.contact') --}}
@endsection


