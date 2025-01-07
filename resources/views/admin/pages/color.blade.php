@extends('admin.layout.app')

@section('title', 'Color Management')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h3 style="color:crimson" class="div_design">Add Color</h3>
    </div>

    <div class="div_design">
        <form action="{{ url('add_color') }}" method="post">
            @csrf
            <input type="text" name="color" required placeholder="Enter color name">
            <input type="submit" class="btn btn-primary" value="Add Color">
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Color Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->color }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ url('color_update', $color->id) }}">Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_color', $color->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
