@extends('home.layouts.app')


@section('title', 'User Dashboard')


@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <div class="container">
        @include('home.customer.sidebar')
    </div>

    <div class="">
            @yield('form-content')
    </div>





@endsection
