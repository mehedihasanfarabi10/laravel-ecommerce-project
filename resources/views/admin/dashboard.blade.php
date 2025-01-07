@extends('admin.layout.app')

@section('title', 'Dashboard')

  

@section('content')

    {{--  Main Content  --}}

    <div class="d-flex align-items-stretch">

        {{--  Body  --}}

        <div class="d-flex align-items-stretch" style="width: 100%;">
            @include('admin.includes.maindashboard')
        </div>

        {{--  Body End  --}}
    </div>

    @include('admin.includes.footer') 



    {{-- End  Main Content  --}}


@endsection
