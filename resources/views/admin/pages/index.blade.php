@extends('admin.layout.app')

@section('content')
    <h1>Welcome to the Admin Dashboard</h1>
     {{--  Header End  --}}
     <div class="d-flex align-items-stretch">
        
        {{--  Body  --}}

        @include('admin.pages.index')

        {{--  Body End  --}}
    </div>
@endsection
