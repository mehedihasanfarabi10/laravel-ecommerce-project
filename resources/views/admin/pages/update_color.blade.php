@extends('admin.layout.app')

@section('title', 'Color Update')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h3 style="color:crimson" class="div_design">Update Color</h3>
        </div>

        <div class="div_design">
            <form action="{{ url('edit_color',$color->id) }}" method="post">
                @csrf
                <input type="text" name="color" required value="{{$color->color}}">
                <input type="submit" class="btn btn-primary" value="Update Color">
            </form>
        </div>

         
    </div>
@endsection
