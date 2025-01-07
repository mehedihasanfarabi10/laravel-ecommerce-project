@extends('admin.layout.app')

@section('title', 'Size Update')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h3 style="color:crimson" class="div_design">Update Size</h3>
        </div>

        <div class="div_design">
            <form action="{{ url('edit_size',$size->id) }}" method="post">
                @csrf
                <input type="text" name="sizes" required value="{{$size->size}}">
                <input type="submit" class="btn btn-primary" value="Update Size">
            </form>
        </div>

        {{--  <table class="table">
            <thead>
                <tr>
                    <th>Size Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sss as $s)
                    <tr>
                        @if ($s)
                        <td>{{ $s->size ?? 'N/A' }}</td>
                        @else
                            <td>Invalid size</td>
                        @endif

                        <td>
                            <a class="btn btn-success" href="{{ url('edit_size', $s->id) }}">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" onclick="confirmation(event)"
                                href="{{ url('delete_size', $s->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  --}}
    </div>
@endsection
